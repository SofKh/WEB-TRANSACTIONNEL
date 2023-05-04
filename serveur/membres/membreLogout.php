<?php
    require_once('../includes/dbcon.inc.php');

    $reponse = array();
    $data = json_decode(file_get_contents('php://input'), true);

    $stmt = $connexion->prepare("SELECT * FROM paniers WHERE idm=?");
    $stmt->execute([$data['idMbr']]);
    $result = $stmt->fetchAll();
    if($result!=null){
        $stmt = $connexion->prepare("DELETE FROM paniers WHERE idm=?");
        $stmt->execute([$data['idMbr']]);
    }
    if($data['panierliste']!=[]){
        try{
            foreach($data['panierliste'] as $item) {
                $stmt = $connexion->prepare("INSERT INTO paniers VALUES(?,?,?)");
                $stmt->execute(array($data['idMbr'], $item['produit']['idp'],$item['quantite']));
            }
            $reponse['OK'] = true;
        } catch(Exception $e) {
            $reponse['OK'] = false;
            $reponse['message'] = $e->getMessage();
        } finally {
            unset($connexion); //Detruire la connexion	
        }
    }

    header("Content-Type: application/json");
    echo json_encode($reponse);
?>