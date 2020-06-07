<?php 

    class Database{
        private static $host="db4free.net";
        private static $user="rolls98";
        private static $db = "geolocate";
        private static $password = "testgeolocate";
        private static $connexion = null;

        // private static $host="localhost";
        // private static $user="root";
        // private static $db = "geolocate";
        // private static $password = "";
        // private static $connexion = null;

        public function __construct(){
            self::$connexion = self::connexion();
        }


        public static function connexion(){
            self::$connexion = new PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=utf8",self::$user,self::$password);
            return self::$connexion;
        }

        public static function deconnexion(){
            self::$connexion = null;
        }


        public function insertInfo($datas){
            $prep = self::$connexion->prepare("INSERT INTO clients(nom,email,password,latitude,longitude,created_date) VALUES(?,?,?,?,?,NOW())");
            return $prep->execute($datas)?TRUE:FALSE;
        }

        public function getClient($email){
            $prep = self::$connexion->prepare("SELECT id FROM clients WHERE email = ?");
            $prep->execute([$email]);
            return $prep->fetch()?TRUE:FALSE;
        }

        public function getUsers(){
            $q = self::$connexion->query("SELECT nom,latitude,longitude FROM clients");
            return $q->fetchAll();
        }

        public function update($data){
            $q = self::$connexion->prepare("UPDATE clients SET latitude=?,longitude=? WHERE email = ?");
            return $q->execute($data)?true:false;
        }

    }



    

    

    

    

?>