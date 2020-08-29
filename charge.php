<?php
require_once('vendor/autoload.php'); 
require_once ('config/config.php');
require_once ('lib/pdo_database.php');
require_once ('models/Customer.php');
require_once ('models/Transaction.php');

\Stripe\Stripe::setApiKey('sk_test_51HKHrBDyTwT776FN8nlkBQfJ6m4GQSrpjw2KZLKSk1O53I7Qtp40DQG8N7fPSoVp5vsJNGzOWnaoNUG3EUQJqleH005uQUCWMt');

session_start();

//Secuire the input values from being harmful
$POST = filter_var_array($_POST, FILTER_SANITIZE_URL);


$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];



//Create Join data
$_SESSION["userJoin"] = $token;

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
));

// Charge Customer
//5000 = 50$ there is no decimal point
//$charge is an array that include all the details about the transaction so we will be able to reach each field with $charge->XX , if we want to save data to the db
$charge = \Stripe\Charge::create(array(
    "amount" => 5000,
    "currency" => "usd",
    "description" => "Intro To React Course",
    "customer" => $customer->id
));


//Customer Data
$customerData = [
    'id' => $charge->customer, //customer equal to stripe tokem who represenst the customer
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
];


//instentiate Customer 
$customer = new Customer();

//addCustomer method
$customer->addCustomer($customerData);

//Redirect to success purchase
//both of transaction id and the product will get pass with the url 
header('Location: success.php?tid=' . $charge->id . '&product=' .$charge->description);




// Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
];

// Instantiate Transaction
$transaction = new Transaction();

// Add Transaction To DB
$transaction->addTransaction($transactionData);

// Redirect to success
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);
