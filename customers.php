<?php

require_once('config/config.php');
require_once('lib/pdo_database.php');
require_once('models/Customer.php');

//Instantiate Customer
$customer = new Customer();

$customers = $customer->getCustomers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="contianer mt-4">
            <div class="btn-gruop ml-2" role="group">
                <a href="customers.php" class="btn btn-primary">Customers</a>
                <a href="transactions.php" class="btn btn-secondary">Transactions</a>
            <h2>Customers</h2>

        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) : ?>

                    <tr>
                        <td><?php echo $customer->id ?></td>
                        <td><?php echo $customer->first_name . ' ' .  $customer->last_name; ?></td>
                        <td><?php echo $customer->email; ?></td>
                        <td><?php echo $customer->created_at; ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <p> <a class="btn btn-primary ml-4" href="index.php">Back</a>
        </p>
    </div>

</body>

</html>