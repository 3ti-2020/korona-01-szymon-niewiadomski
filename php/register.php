<?php
session_start();
require_once 'connect.php';

function checkExist($sql){
    global $db;
    
    $result = $db->query($sql);
    if($result->num_rows > 0) return true;
    else return false; 
}

if(isset($_POST['username'])){
    $flag = true;

    //Username
    $username = $_POST['username'];
    if(strlen($username) < 5 || strlen($username) > 16 && !ctype_alnum($username)){
        $flag = false;
        $_SESSION['e_username'] = 'Nazwa użytkownika powinna mieć między 5 a 16 znaków alfanumerycznych';
    }
    $sql = "SELECT * from users WHERE login='$username'";

    if(checkExist($sql)){
        $flag = false;
        $_SESSION['e_username'] = 'Ta nazwa użytkownika jest zajęta';
    }

    //Email
    $email = $_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $flag = false;
        $_SESSION['e_email'] = 'Nieprawidłowy format maila';
    }
    $sql = "SELECT * from users WHERE email='$email'";

    if(checkExist($sql)){
        $flag = false;
        $_SESSION['e_email'] = 'Ten adres email już jest zarejestrowany';
    }

    //Password
    $password = htmlentities($_POST['password']);
    $re_password = htmlentities($_POST['re_password']);

    if(strlen($password) < 8 || strlen($password) > 18){
        $flag=false;
        $_SESSION['e_password'] = 'Hasło powinno mieć między 8 a 18 znaków';
    }

    if($password != $re_password){
        $flag=false;
        $_SESSION['e_repassword'] = 'Hasła nie są takie same';
    }

    //Rules
    if(!isset($_POST['rules'])){
        $flag = false;
        $_SESSION['e_rules'] = 'Nie zaakceptowano regulaminu';
    }

    //Name
    $name = trim($_POST['name']);

    if(empty($name)){
        $flag = false;
        $_SESSION['e_name'] = 'Imię jest wymagane'; 
    }

    //Lastame
    $lastname = trim($_POST['lastname']);

    if(empty($lastname)){
        $flag = false;
        $_SESSION['e_lastname'] = 'Nazwisko jest wymagane'; 
    }

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

    //All right
    if($flag){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users VALUES (NULL, '$username', '$hash', '$email', '$name', '$lastname', '$city', '$post_code', '$address')";
        $_SESSION['registered'] = $name;
        if($db->query($sql)) header('Location: ../login.php');
        exit();
    } else {
        $_SESSION['r_username'] = $username;
        $_SESSION['r_email'] = $email;
        $_SESSION['r_name'] = $name;
        $_SESSION['r_lastname'] = $lastname;
        $_SESSION['r_city'] = $city;
        $_SESSION['r_postcode'] = $post_code;
        $_SESSION['r_address'] = $address;
    }
} 
header('Location: ../registration.php');