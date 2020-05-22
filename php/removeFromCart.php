<?php
session_start();
require_once 'connect.php';

if(isset($_SESSION['user_id']) && isset($_POST['product_id'])){
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $sql = "DELETE from cart WHERE user_id=$user_id AND product_id=$product_id";
    $db->query($sql);
} else header('Location: ../index.php');