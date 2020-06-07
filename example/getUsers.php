<?php 
    include "db/database.php";
    $db = new Database();
    echo json_encode($db->getUsers());

?>