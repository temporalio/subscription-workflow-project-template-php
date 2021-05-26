<?php
// @@@SNIPSTART subscription-php-workflow-definition-interface
declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Temporal\Workflow\SignalMethod;
use Temporal\Workflow\QueryMethod;

#[WorkflowInterface]
interface SubscriptionWorkflowInterface
{
    #[WorkflowMethod(name: "SubscriptionWorkflow")]
    public function startSubscription(
        int $cid
    );

    #[SignalMethod]
    public function cancelSubscription(
        bool $cancel
    ): void;

    #[SignalMethod]
    public function updateBillingPeriodChargeAmount(
        int $billingPeriodCharge
    ): void;

    #[QueryMethod]
    public function getCustomerId(): string;

    #[QueryMethod]
    public function getBillingPeriodNumber(): int;

    #[QueryMethod]
    public function getBillingPeriodChargeAmount(): int;
}
// @@@SNIPEND
