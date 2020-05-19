<?php
    require_once "connect.php";
    function createTable($id){
        global $db;
        
        switch($id){
            case 1:
                $columns = ['product_id', 'name', 'description', 'category', 'price', 'img'];
                $sql = "SELECT * FROM products";
            break;
            case 2:
                $columns = ['user_id', 'login', 'password', 'email', 'name', 'lastname', 'address'];
                $sql = "SELECT * FROM users";

            break;
            case 3:
                $columns = ['cart_id', 'product_name', 'user_name'];
                $sql = "SELECT cart_id, products.name, users.name FROM products, cart, users WHERE cart.user_id = users.user_id AND cart.product_id = products.product_id";

            break;
        }

        $result = $db->query($sql);

        echo "<table>";
        echo "<tr>";
        foreach ($columns as $column){
            echo "<th>".$column."</th>";
        }
        echo "</tr>";
        while($row = $result->fetch_array(MYSQLI_NUM)){
            echo "<tr>";
                foreach ($row as $rekord){
                    echo  "<td>".$rekord."</td>";
                }
            echo "</tr>";
        }
        
        echo "</table>";
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dane.css">
    <title>Document</title>
</head>
<body>
    <?php
        createTable(1);
        createTable(2);
        createTable(3);
    ?>
</body>
</html>