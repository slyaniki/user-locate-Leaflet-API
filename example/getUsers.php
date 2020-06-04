<?php 
    include "db/database.php";
    $db = Database::connexion();

    echo json_encode(getUsers($db));

?>