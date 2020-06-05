<?php 

    include "db/database.php";
    $db = Database::connexion();

    if($_POST["mail"]){
        
        if(getClient($db,$_POST["mail"]) && update($db,[$_POST["lat"],$_POST["long"],$_POST["mail"]])){
            echo json_encode("Base de donnée mise a jour");
        }else{
            echo json_encode("Erreur au niveau de la bd");
        }
    }else{
        echo json_encode("mail inexistant");
    }

?>