<?php

declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Carbon\CarbonInterval;
use Google\Protobuf\Internal\GPBJsonWire;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Temporal\Client\WorkflowOptions;
use Temporal\Common\IdReusePolicy;
use Temporal\SampleUtils\Command;

class QueryBillingInfoCommand extends Command
{
    protected const NAME = 'querybillinginfo';
    protected const DESCRIPTION = 'Query subscription\SubscriptionWorkflow';

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $workflow = $this->workflowClient->newUntypedRunningWorkflowStub(
            "SubscriptionsWorkflowId-0"
        );

        $customerId = $workflow->query("getCustomerId");
        $billingPeriodNumber = $workflow->query("getBillingPeriodNumber");
        $chargeAmount = $workflow->query("getBillingPeriodChargeAmount");

        $output->writeln(
            sprintf(
                'Billing Info: Customer=<fg=magenta>%s</fg=magenta>, Period Number=<fg=magenta>%s</fg=magenta>, Charge Amount=<fg=magenta>%s</fg=magenta>',
                $customerId->getValue(0),
                $billingPeriodNumber->getValue(0),
                $chargeAmount->getValue(0),
            )
        );


        return self::SUCCESS;
    }
}
