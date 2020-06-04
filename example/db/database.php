<?php 

    class Database{
        private static $host="localhost";
        private static $user="root";
        private static $db = "geolocate";
        private static $password = "02491383Ro";
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
        $prep->execute($datas); 
        return $prep    ;
    }

?>