<?php
session_start();

require_once 'connect.php';

if(isset($_SESSION['user_id']) && isset($_POST['product_id']) && isset($_POST['count'])){
    $count = $_POST['count'];
    $product_id =$_POST['product_id'];
    $user_id =$_SESSION['user_id'];

    $sql = "UPDATE cart SET count=$count WHERE product_id=$product_id AND user_id=$user_id";
    $db->query($sql);

} else header('Location: ../index.php');

