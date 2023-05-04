<?php
    require_once('../includes/dbcon.inc.php');

    $reponse = array();
    $data = json_decode(file_get_contents('php://input'), true);
    try{
        $stmt = $connexion->prepare("SELECT * FROM paniers WHERE idm=?");
        $stmt->execute([$data['idMbr']]);
        while($lignePanier = $stmt->fetch(PDO::FETCH_OBJ)) {
            $stmt2 = $connexion->prepare("SELECT * FROM produits WHERE idp=?");
            $stmt2->execute([$lignePanier->idp]);
            $ligneProduit = $stmt2->fetch(PDO::FETCH_OBJ);
            $reponse['panierliste']['produit'][] = $ligneProduit;
            $reponse['panierliste']['quantite'][] = $lignePanier->quantiteChoisie;
        }
        $reponse['OK'] = true;
    } catch(Exception $e) {
        $reponse['OK'] = false;
        $reponse['message'] = $e->getMessage();
        http_response_code(500);
    } finally {
        unset($connexion); //Detruire la connexion	
    }

    header("Content-Type: application/json");
    echo json_encode($reponse);
    exit();
?>