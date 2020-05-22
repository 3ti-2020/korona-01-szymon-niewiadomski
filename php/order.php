<?php
require_once 'connect.php';

if(isset($_POST['products'])){
    $user_id=$_POST['user_id'];
    $products = $_POST['products'];
    $cost = $_POST['cost'];

    $sql = "INSERT INTO orders VALUES (NULL, $user_id, 'Opłacone', now(), $cost, '$products')";

    if($db->query($sql)){
        echo json_encode('true');
    } else{
        echo json_encode('false');
    }
} else header('Location: ../cart.php');