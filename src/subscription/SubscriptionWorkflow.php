<?php
// @@@SNIPSTART subscription-php-workflow-definition-implementation
declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

class SubscriptionWorkflow implements SubscriptionWorkflowInterface
{

    private int $billingPeriodNum = 0;
    private bool $subscriptionCancelled = false;
    private Subscription $subscription;
    private Customer $workflowCustomer;

    private $subscriptionActivity;

    public function __construct()
    {
        $this->subscriptionActivity = Workflow::newActivityStub(
            SubscriptionActivityInterface::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::seconds(5))
                ->withScheduleToCloseTimeout(CarbonInterval::seconds(10))
                ->withTaskQueue("SubscriptionsTaskQueue")
        );

        $this->subscription = new Subscription(
            CarbonInterval::seconds(10),
            CarbonInterval::seconds(10),
            24,
            120
        );
    }

    public function startSubscription(int $cid)
    {
        $this->workflowCustomer = new Customer(
            "First Name" . $cid,
            "Last Name" . $cid,
            "Id-" . $cid,
            "Email" . $cid,
            $this->subscription
        );

        yield $this->subscriptionActivity->sendWelcomeEmail($cid);

        yield Workflow::awaitWithTimeout(
            $this->workflowCustomer->getSubscription()->getTrialPeriod(),
            fn () => $this->subscriptionCancelled == true
        );

        if ($this->subscriptionCancelled) {
            $this->subscriptionActivity->sendCancellationEmailDuringTrialPeriod($cid);
            return;
        }

        while ($this->billingPeriodNum  < $this->workflowCustomer->getSubscription()->getMaxBillingPeriods()) {

            // Charge customer for the billing period
            $this->subscriptionActivity->chargeCustomerForBillingPeriod(
                $cid,
                $this->billingPeriodNum
            );

            // Wait 1 billing period to charge customer or if they cancel subscription
            // whichever comes first
            yield Workflow::awaitWithTimeout(
                $this->workflowCustomer->getSubscription()->getBillingPeriod(),
                fn () => $this->subscriptionCancelled == true
            );

            // If customer cancelled their subscription send notification email
            if ($this->subscriptionCancelled) {
                $this->subscriptionActivity->sendCancellationEmailDuringActiveSubscription($cid);
                // We have completed subscription for this customer.
                // Finishing workflow execution
                break;
            }

            $this->billingPeriodNum++;
        }

        if (!$this->subscriptionCancelled) {
            $this->subscriptionActivity->sendSubscriptionOverEmail($cid);
        }
    }

    public function cancelSubscription(bool $cancel): void
    {
        $this->subscriptionCancelled = $cancel;
    }

    public function updateBillingPeriodChargeAmount(int $billingPeriodCharge): void
    {
        $this->workflowCustomer->getSubscription()->setBillingPeriodCharge($billingPeriodCharge);
    }

    public function getCustomerId(): string
    {
        return $this->workflowCustomer->getId();
    }

    public function getBillingPeriodNumber(): int
    {
        return $this->billingPeriodNum;
    }

    public function getBillingPeriodChargeAmount(): int
    {
        return $this->workflowCustomer->getSubscription()->getBillingPeriodCharge();
    }
}
// @@@SNIPEND
