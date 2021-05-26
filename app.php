<?php
// @@@SNIPSTART subscription-php-app
declare(strict_types=1);

use Temporal\SampleUtils\DeclarationLocator;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Symfony\Component\Console\Application;
use Temporal\SampleUtils\Command;

require __DIR__ . '/vendor/autoload.php';

// finds all available workflows, activity types and commands in a given directory
$declarations = DeclarationLocator::create(__DIR__ . '/src/subscription');

$host = getenv('TEMPORAL_CLI_ADDRESS');
if (empty($host)) {
    $host = 'localhost:7233';
}

$workflowClient = WorkflowClient::create(ServiceClient::create($host));

$app = new Application('Temporal Subscription Example');

foreach ($declarations->getCommands() as $command) {
    $app->add(Command::create($command, $workflowClient));
}

$app->run();
// @@@SNIPEND
