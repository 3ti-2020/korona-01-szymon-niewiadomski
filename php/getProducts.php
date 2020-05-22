<?php
    require_once "connect.php";
    if(isset($_GET['category'])){
        $category = $_GET['category'];
        if($category=="all") $sql = "SELECT * FROM products";
        else $sql = "SELECT * FROM products WHERE category='$category'";
        
        $result = $db->query($sql);
    
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    
    }
    
?>