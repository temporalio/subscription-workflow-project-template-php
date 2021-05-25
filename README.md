# Subscription Workflow Project Template in PHP
<!-- @@@SNIPSTART subscription-php-readme -->
This project template illustrates the design pattern for subscription style business logic.

## Setup

Run the Temporal Server:

```bash
git clone https://github.com/temporalio/docker-compose.git
cd docker-compose
docker-compose up
```

Start the RoadRunner Server:

```bash
composer install
./rr serve
```

## Start

Start the Workflow Execution for a single customer with the Id of "Id-0".

```bash
php app.php subscription
```

## Get billing info

You can Query the Workflow Execution for the customer's billing information.
The current billing period and the charge amount will be returned.

```bash
php app.php querybillinginfo  
```

Run this multiple times to see the billing period number and charge amount change over the course of the Workflow Execution.

## Update billing

You can also send a Signal to the Workflow Execution to update the billing cycle cost to 300.

```bash
php app.php updatecharge
```

## Cancel subscription

You can send a Signal to the Workflow Execution to cancel the subscription.
The Workflow Execution will complete after the current billing period.

```bash
php app.php cancelsubscription
```

After running this, check out the [Temporal Web UI](http://localhost:8088/) to see that the Workflow Execution has a "Completed" status.
<!-- @@@SNIPEND -->
