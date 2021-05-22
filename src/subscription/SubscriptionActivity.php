<?php

declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Psr\Log\LoggerInterface;
use Temporal\SampleUtils\Logger;

class SubscriptionActivity implements SubscriptionActivityInterface
{

    private LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function sendWelcomeEmail(int $customerId) : string 
    {
        $this->logger->info("sending welcome email to: " . $customerId);
        return "sending welcome email to: " . $customerId;
    }

    public function sendCancellationEmailDuringTrialPeriod(int $customerId) : string
    {
        $this->logger->info("sending cancellation email during trial period to: " . $customerId);
        return "sending cancellation email during trial period to: " . $customerId;
    }

    public function chargeCustomerForBillingPeriod(int $customerId,
        int $billingPeriodNum) : string {
            $this->logger->info("charge customer: " . $customerId .
                " for billing period: " . $billingPeriodNum);
            return "charge customer: " . $customerId .
            " for billing period: " . $billingPeriodNum;
        }

    public function sendCancellationEmailDuringActiveSubscription(int $customerId) : string
    {
        $this->logger->info("sending cancellation email during active subscription to: " . $customerId);
        return "sending cancellation email during active subscription to: " . $customerId;
    }

    public function sendSubscriptionOverEmail(int $customerId) : string {
        $this->logger->info("sending subscription over email to: " . $customerId);
        return "sending subscription over email to: " . $customerId;  
    }

}