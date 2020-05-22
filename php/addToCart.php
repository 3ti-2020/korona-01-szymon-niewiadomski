<?php
session_start();
require_once 'connect.php';

function checkProduct($user_id, $product_id){
    global $db;

    $sql = "SELECT * from cart WHERE product_id=$product_id AND user_id=$user_id";
    $result = $db->query($sql);

    if($result->num_rows > 0){
        $data = $result->fetch_array();
        return $data['count'];
    }
    else return false;

}

if(isset($_POST['product_id']) && isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $checked = checkProduct($user_id, $product_id);

    if($checked){
        $count = ++$checked;
        $sql = "UPDATE cart SET count=$count WHERE product_id=$product_id AND user_id=$user_id";
    } else {
        $sql = "INSERT INTO cart VALUES (NULL,$user_id, $product_id, 1)";
    }
    $db->query($sql);
} else header('Location: ../index.php');