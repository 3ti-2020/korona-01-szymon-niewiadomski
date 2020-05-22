<?php
session_start();
require_once 'connect.php';

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $sql = "SELECT products.*, cart_id, cart.count from products, cart WHERE cart.user_id = $id AND products.product_id = cart.product_id";
    $result= $db->query($sql);

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

} else header('Location: ../index.php');

?>