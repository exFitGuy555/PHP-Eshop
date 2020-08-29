<?php
require_once('../config/config.php');
require_once('../lib/pdo_database.php');
require_once('../models/User.php');

         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $POST = filter_var_array($_POST, FILTER_SANITIZE_URL);


            $first_name = $POST['first_name'];
            $last_name = $POST['last_name'];
            $email = $POST['email'];

    // Put post vars in regular vars
    $firstname =  trim($_POST['first_name']);
    $lastname = trim($_POST['last_name']);
    $email = trim($_POST['email']);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];


    $user = new User();


          //Validate Email empty input + allready exists
            if (empty($data['first_name'])) {
                die('please Enter Email');
            } else {
                //check if exists
                if ($user->findUserByEmail($data['email'])) {
            $data['email_err'] = 'Email allready Exists';
            die('email exist');
                  }
            } 



            $user->addUser($data);



    }
         
        



    

