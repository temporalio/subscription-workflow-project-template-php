<?php

declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Carbon\CarbonInterval;

class Subscription
{
  private Carboninterval $trialPeriod;
  private Carboninterval $billingPeriod;
  private int $maxBillingPeriods;
  private int $billingPeriodCharge;

    public function __construct(Carboninterval $trialPeriod,
        Carboninterval $billingPeriod,
        int $maxBillingPeriods, int $billingPeriodCharge)
    {
        $this->trialPeriod = $trialPeriod;
        $this->billingPeriod = $billingPeriod;
        $this->maxBillingPeriods = $maxBillingPeriods;
        $this->billingPeriodCharge = $billingPeriodCharge;
    }

    public function getTrialPeriod() {
        return $this->trialPeriod;
    }

    public function getBillingPeriod() {
        return $this->billingPeriod;
    }

    public function getMaxBillingPeriods() {
        return $this->maxBillingPeriods;
    }

    public function getBillingPeriodCharge() {
        return $this->billingPeriodCharge;
    }

    public function setTrialPeriod(Carboninterval $trialPeriod) {
        $this->trialPeriod = $trialPeriod;
    }

    public function setBillingPeriod(Carboninterval $billingPeriod) {
        $this->billingPeriod = $billingPeriod;
    }

    public function setMaxBillingPeriods(int $maxBillingPeriods) {
        $this->maxBillingPeriods = $maxBillingPeriods;
    }

    public function setBillingPeriodCharge(int $billingPeriodCharge) {
        $this->billingPeriodCharge = $billingPeriodCharge;
    }
}