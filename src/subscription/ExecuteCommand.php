<?php
// @@@SNIPSTART subscription-php-workflow-execution-starter
declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Carbon\CarbonInterval;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Temporal\Client\WorkflowOptions;
use Temporal\Common\IdReusePolicy;
use Temporal\SampleUtils\Command;

class ExecuteCommand extends Command
{
    protected const NAME = 'subscription';
    protected const DESCRIPTION = 'Execute subscription\SubscriptionWorkflow';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $WORKFLOW_ID_BASE = "SubscriptionsWorkflow";


        $workflow = $this->workflowClient->newWorkflowStub(
            SubscriptionWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minutes(10))
                ->withWorkflowId($WORKFLOW_ID_BASE . "Id-0")
                ->withTaskQueue("SubscriptionsTaskQueue")
                ->withWorkflowIdReusePolicy(IdReusePolicy::POLICY_ALLOW_DUPLICATE)
        );

        $output->writeln("Starting <comment>SubscriptionWorkflow</comment>... ");
        $run = $this->workflowClient->start($workflow, 0);

        $output->writeln(
            sprintf(
                'Started: WorkflowID=<fg=magenta>%s</fg=magenta>, RunID=<fg=magenta>%s</fg=magenta>',
                $run->getExecution()->getID(),
                $run->getExecution()->getRunID(),
            )
        );

        return self::SUCCESS;
    }
}
// @@@SNIPEND
