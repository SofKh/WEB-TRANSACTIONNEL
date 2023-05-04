<?php
    // Au début de PHP: Déclarer les types dans les paramétres des fonctions
    declare (strict_types=1);

    require_once(__DIR__."/serveur/produits/produitsControleur.php");
   
    $instanceCtr = ControleurProduit::getControleurProduit();
    echo $instanceCtr->CtrP_Actions();
?>