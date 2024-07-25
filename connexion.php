<?php

class connect extends PDO{

    const HOST="localhost";
    const USER="root";
    const PSW="";
    const DB="gestioncommandes";


    public function __construct(){
        try{
            parent::__construct("mysql:dbname=".self::DB.";host=".self::HOST,self::USER,self::PSW);
            // echo"okk";
        } catch(PDOException $e) {
            echo "Erreur lors de l'exécution de la requête: " . $e->getMessage();

        }

    }
}

?>