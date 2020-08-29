<?php
if(!empty($_GET['tid'] && !empty($_GET['product']))) {
$GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

$tid = $GET['tid'];

$product = $GET['product'];
} else {
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success purchase</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="contianer mt-4">
        <h2> Thanks for your purchase! </h2>
        <p><?php echo $product; ?> </p>
        <p>Your transaction ID is: <?php echo $tid; ?> </p>
        <p>Check your mail for more info</p>
        <p><a class="btn btn-primary mt-2" href="index.php">Go Back</a></p>

    </div>

</body>

</html>