<?php 


//DB params
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "payapp");



// App Root = double dirname , will take to the main project directory/
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root
//than we can access the app root from any file ! and can pass on the retype each time
define('URLROOT', 'http://localhost/stripe');

// Site Name
//Page title 
define('SITENAME', 'Stripe');

