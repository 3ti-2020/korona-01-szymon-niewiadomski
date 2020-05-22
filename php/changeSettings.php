<?php

session_start();
require_once 'connect.php';
$user_id = $_SESSION['user_id'];

if(isset($_POST['new_password'])){
    $old_password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $re_password = $_POST['re_password'];
    $flag=true;
    
    $sql = "SELECT password from users WHERE user_id=$user_id";
    $result = $db->query($sql);
    $data = $result->fetch_array();

    if(!password_verify($old_password, $data['password'])){
        $flag = false;
        $_SESSION['e_password'] = 'Nieprawidłowe hasło';
    }

    if(strlen($new_password) < 8 || strlen($new_password) > 18){
        $flag=false;
        $_SESSION['e_newpassword'] = 'Hasło powinno mieć mieć pomiędzy 8 a 18 znaków';
    }

    if($new_password != $re_password){
        $flag=false;
        $_SESSION['e_repassword'] = 'Hasła nie są takie same';
    }

    if($flag){
        $hash = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$hash' WHERE user_id=$user_id";
        if($db->query($sql)){
            $_SESSION['changed_password'] = true;
        }
    } 

    header('Location: ../settings.php');
}

if(isset($_POST['city'])){
    $flag = true;

    //City
    $city = trim($_POST['city']);

    if(empty($city)){
        $flag = false;
        $_SESSION['e_city'] = 'Miasto jest wymagane'; 
    }

    //Post code
    $pattern = "/[0-9]{2}\-[0-9]{3}/";
    $post_code = htmlentities($_POST['post_code']);

    if(!preg_match($pattern, $post_code)){
        $flag = false;
        $_SESSION['e_postcode'] = 'Nieprawidłowy kod pocztowy'; 
    }

    if(empty($post_code)){
        $flag = false;
        $_SESSION['e_postcode'] = 'Kod pocztowy jest wymagany'; 
    }
    //Address
    $address = htmlentities($_POST['address']);

    if(empty($address)){
        $flag = false;
        $_SESSION['e_address'] = 'Adres jest wymagany'; 
    }

    if($flag){
        $sql = "UPDATE users SET city='$city', post_code='$post_code', address='$address' WHERE user_id=$user_id";
        if($db->query($sql)){
            $_SESSION['changed_address'] = true;
            $_SESSION['address'] = $address;
            $_SESSION['city'] = $city;
            $_SESSION['post_code'] = $post_code;
        }
    }

    header('Location: ../settings.php');
}