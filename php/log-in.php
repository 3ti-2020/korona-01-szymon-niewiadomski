<?php
session_start();
require_once "connect.php";

if(isset($_POST['password'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    $resultUsername = $db->query("SELECT * from users WHERE login='$username'");

    if($resultUsername->num_rows > 0){
        $data = $resultUsername->fetch_array();

        if(password_verify($password, $data['password'])){
            $_SESSION['logged'] = true;
            $_SESSION['address'] = $data['address'];
            $_SESSION['city'] = $data['city'];
            $_SESSION['post_code'] = $data['post_code'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['lastname'] = $data['lastname'];
            $_SESSION['user_id'] = $data['user_id'];
            header('Location: ../index.php');
        } else {
            $_SESSION['error_password'] = "Nieprawidłowe hasło";
            header('Location: ../login.php');
        }
    } else {
        $_SESSION['error_username'] = "Nieprawidłowy login";
        header('Location: ../login.php');
        
    }
} else {
    header('Location: ../index.php');
}

?>