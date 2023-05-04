<?php
    $SERVEUR = "localhost";
    $USAGER = "root";
    $PASS = "";
    $BD = "bdboutique";
    
    try {
        $dns = "mysql:host=$SERVEUR;dbname=$BD";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $connexion = new PDO( $dns, $USAGER, $PASS, $options );
    } catch ( Exception $e ) {
        //echo $e->getMessage();
        echo "Probleme de connexion au serveur de bd";
        exit();
    }
?>