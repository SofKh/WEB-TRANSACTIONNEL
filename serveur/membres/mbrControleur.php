<?php
    require_once('../includes/dbcon.inc.php');
    $reponse = array();

    function lister(){
        global $connexion, $reponse;
        $reponse['listeMbr'] = array();
        try{
            $requette = "SELECT membres.*, statut FROM membres, connexion WHERE membres.idm=connexion.idm";
            $stmt = $connexion->prepare($requette);
            $stmt->execute();
            $reponse['OK'] = true;
            while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
                $reponse['listeMbr'][] = $ligne;
            }
        }catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = "Probleme pour lister!";
        }finally{
            unset($connexion); //Detruire la connexion	
        }
    }

    function activer(){
        global $connexion, $reponse;
        $id = $_POST['id'];
        try{
            $requette = "UPDATE connexion SET statut='A' WHERE idm=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$id]);
            $reponse['OK'] = true;
            $reponse['message'] = "Membre est bien active!";
        }catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = "Probleme pour activer!";
        }finally{
            unset($connexion); //Detruire la connexion	
        }
    }


    function desactiver(){
        global $connexion, $reponse;
        $id = $_POST['id'];
        try{
            $requette = "UPDATE connexion SET statut='I' WHERE idm=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$id]);
            $reponse['OK'] = true;
            $reponse['message'] = "Membre est desactive!";

        }catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = "Probleme pour desactiver!";
        }finally{
            unset($connexion); //Detruire la connexion	
        }
    }

    $action = $_POST['action'];
    switch($action){
        case 'lister' :
            lister();
            break;
        case 'activer' :
            activer();
            break;
        case 'desactiver' :
            desactiver();
            break;
    }

    header("Content-Type: application/json");
    echo json_encode($reponse);
    exit();
?>