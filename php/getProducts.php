<?php
    require_once "connect.php";

    $sql = "SELECT * FROM products";
    $result = $db->query($sql);

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

?>