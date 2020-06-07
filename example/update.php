<?php 

    include "db/database.php";
    $db = new Database();

    if($_POST["mail"]){
        
        if($db->getClient($_POST["mail"]) && $db->update([$_POST["lat"],$_POST["long"],$_POST["mail"]])){
            echo json_encode("Base de donnée mise a jour");
        }else{
            echo json_encode("Erreur au niveau de la bd");
        }
    }else{
        echo json_encode("mail inexistant");
    }

?>