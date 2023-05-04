<?php
    require_once('../includes/dbcon.inc.php');
   $reponse = array();

   function listerCateg(){
    global $connexion, $reponse;
   $reponse['listeProduits'] = array();
   $categorie = $_POST['categorie'];
    try{
        if($categorie==""){
            $requette = "SELECT * FROM produits";
            $stmt = $connexion->prepare($requette);
            $stmt->execute();
        }
        else{
            $requette = "SELECT * FROM produits WHERE categorie=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$categorie]);
        }
        $reponse['OK'] = true;
        while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
            $reponse['listeProduits'][] = $ligne;
        }
    }catch(Exception $e){
        $reponse['OK'] = false;
        $reponse['message'] = $e->getMessage();
    }finally{
         unset($connexion); //Detruire la connexion	
    }
}


function listerPop(){
    global $connexion, $reponse;
   $reponse['listeProduits'] = array();
    try{
        $requette = "SELECT * FROM produits LIMIT 8";
        $stmt = $connexion->prepare($requette);
        $stmt->execute();
        $reponse['OK'] = true;
        while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
            $reponse['listeProduits'][] = $ligne;
        }
    }catch(Exception $e){
        $reponse['OK'] = false;
        $reponse['message'] = $e->getMessage();
    }finally{
         unset($connexion); //Detruire la connexion	
    }
}


   // Contrôleur
   $action = $_POST['action'];
   switch($action){
    case 'listerCateg' :
        listerCateg();
        break;
    case 'listerPop':
        listerPop();
        break;
   }
    header("Content-Type: application/json");
    echo json_encode($reponse);
    exit();
?>