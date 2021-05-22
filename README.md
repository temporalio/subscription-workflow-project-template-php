# Temporal Subscription Workflow Template - PHP

Temporal customer subscription Workflow example. 

### Setup

### Run Temporal server

```bash
git clone https://github.com/temporalio/docker-compose.git
cd docker-compose
docker-compose up
```

### Start the example

Start RoadRunner server:

```text
composer install
./rr serve
```

Start the Workflow executions.
This will start the Subscription Workflow for 1 customers with id "Id-0"

```text
php app.php subscription
```

### Querying billing information:

You can query billing information for the customer after the workflows have started with:

```text
php app.php querybillinginfo  
```

This will return the current Billing Period and the current Billing Period Charge amount for the customers.

You can run this multiple times to see the billing period number increase during 
workflow execution

### Update billing cycle cost:

You can also update the billing cycle cost for all customers while the workflow is running:

```text
php app.php updatecharge 
```

This will update the billing charge amount for the customers for their next billing cycle to 300.

You can use 

```text
php app.php querybillinginfo  
``` 

again to see the billing charge update to 300 for the next billing period

### Cancel subscription

You can cancel subscriptions for the customers, which completes 
workflow execution after the currently executing billing period:

```text
php app.php cancelsubscription
```

After running this, check out the Temporal Web UI and see that the 
subscription workflow is in the "Completed" status.