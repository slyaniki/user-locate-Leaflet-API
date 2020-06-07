<?php 
    include "db/database.php";
    $db = new Database();
    $array = ["success"=>TRUE,"message"=>"Message envoyé avec success"];
    
    if(!empty($_POST)){
        $array["success"] = TRUE;
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $latitude = floatval($_POST["lat"]);
        $longitude = floatval($_POST["long"]);

        if(empty($nom) || empty($email) || empty($password)){
            $array["success"] = FALSE;
            $array["message"]="Veuillez Remplir tout les champs";
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $array["success"] = FALSE;
            $array["message"]="Email Incorrect";
        }else if($db->getClient($email)){
            $array["success"] = FALSE;
            $array["message"]="Email existe deja";
        }

        if($array["success"] === TRUE && $db->insertInfo([$nom,$email,$password,$latitude,$longitude])){
            $array["success"] = false;
            $array["message"] = "Erreur au niveau de la bd";
        }
    }

    echo json_encode($array);


    Database::deconnexion();
?>