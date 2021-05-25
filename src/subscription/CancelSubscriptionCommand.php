<?php
// @@@SNIPSTART subscription-php-cancel-subscription-signal
declare(strict_types=1);

namespace Temporal\Samples\Subscription;

use Carbon\CarbonInterval;
use Google\Protobuf\Internal\GPBJsonWire;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Temporal\Client\WorkflowOptions;
use Temporal\Common\IdReusePolicy;
use Temporal\SampleUtils\Command;

class CancelSubscriptionCommand extends Command
{
    protected const NAME = 'cancelsubscription';
    protected const DESCRIPTION = 'Signal subscription\SubscriptionWorkflow';

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $workflow = $this->workflowClient->newUntypedRunningWorkflowStub(
            "SubscriptionsWorkflowId-0"
        );

        $workflow->signal("cancelSubscription", true);

        return self::SUCCESS;
    }
}
// @@@SNIPEND
