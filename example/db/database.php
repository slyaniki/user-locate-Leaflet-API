<?php 

    class Database{
        private static $host="db4free.net";
        private static $user="rolls98";
        private static $db = "geolocate";
        private static $password = "testgeolocate";
        private static $connexion = null;

        public static function connexion(){
            self::$connexion = new PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=utf8",self::$user,self::$password);
            return self::$connexion;
        }

        public static function deconnexion(){
            self::$connexion = null;
        }
    }


    function insertInfo($db,$datas){
        $prep = $db->prepare("INSERT INTO clients(nom,email,password,latitude,longitude,created_date) VALUES(?,?,?,?,?,NOW())");
        
        return $prep->execute($datas)?TRUE:FALSE;
    }

    function getClient($db,$email){
        $prep = $db->prepare("SELECT id FROM clients WHERE email = ?");
        $prep->execute([$email]);
        return $prep->fetch()?TRUE:FALSE;
    }

?>