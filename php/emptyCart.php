<?php
session_start();

require_once 'connect.php';

if(isset($_SESSION['user_id']) && isset($_POST['flag'])){
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE from cart WHERE user_id=$user_id";
    $db->query($sql);

} else header('Location: index.php');