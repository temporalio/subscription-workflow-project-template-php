<?php

declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;
use Temporal\Samples\Subscription\Model\Customer;

#[ActivityInterface(prefix: 'SubscriptionActivity.')]
interface SubscriptionActivityInterface
{
    #[ActivityMethod(name: "SendWelcomeEmail")]
    public function sendWelcomeEmail(int $customerId) : string;

    #[ActivityMethod(name: "SendCancellationEmailDuringTrialPeriod")]
    public function sendCancellationEmailDuringTrialPeriod(int $customerId) : string;

    #[ActivityMethod(name: "ChargeCustomerForBillingPeriod")]
    public function chargeCustomerForBillingPeriod(int $customerId,
        int $billingPeriodNum) : string;

    #[ActivityMethod(name: "SendCancellationEmailDuringActiveSubscription")]
    public function sendCancellationEmailDuringActiveSubscription(int $customerId) : string;

    #[ActivityMethod(name: "SendSubscriptionOverEmail")]
    public function sendSubscriptionOverEmail(int $customerId) : string;

}