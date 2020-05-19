<?php
    $db = new mysqli("localhost", "root", "", "3ti");

    if($db->connect_error){
        die('Connection failed: '. $db->connect_error);
    }
?>