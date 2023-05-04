<?php
    require_once('../includes/dbcon.inc.php');
    $reponse = array();

    function listerProfil(){
        $id = $_POST['id'];
        global $connexion, $reponse;
        // $reponse['listeProfil'] = array();
        try{
            $requette = "SELECT * FROM membres WHERE idm=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$id]);
            $ligne=$stmt->fetch(PDO::FETCH_OBJ);
            $reponse['profil'] = $ligne; 
            $reponse['OK'] = true;
        }catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = $e->getMessage();
        }finally{
            unset($connexion); //Detruire la connexion	
        }
    }

    function modifierProfil(){
        global $connexion, $reponse;
        $id = $_POST['id'];
        $prenom = $_POST['prenomP'];
        $nom = $_POST['nomP'];
        $courriel = $_POST['courrielP'];
        $sexe = $_POST['sexeP'];
        $daten = $_POST['datenP'];
        $repPhotos = "photos/";
        try{
            $requette="SELECT photo FROM membres WHERE idm=?";
			$stmt=$connexion->prepare($requette);
            $stmt->execute([$id]);
			$ligne=$stmt->fetch(PDO::FETCH_OBJ);
			$photo=$ligne->photo;
            if($_FILES['photoP']['tmp_name'] != ""){
                if($photo !== "avatar.jpg"){
                    $rmPoc=$repPhotos.$photo;
                    $tabFichiers = glob($repPhotos."*");
                    foreach($tabFichiers as $fichier){
                    if(is_file($fichier) && $fichier==trim($rmPoc)) {
                        unlink($fichier);
                        break;
			            }
			        }
                }
                $tmpFic = $_FILES['photoP']['tmp_name'];
                $nomOriginal = $_FILES['photoP']['name'];
                $extension = strrchr($nomOriginal,'.');
                $photo = sha1($prenom.time()).$extension;
                @move_uploaded_file($tmpFic, $repPhotos.$photo);
            }
            $requette = "UPDATE membres SET prenom=?, nom=?, sexe=?, datedenaissance=?, photo=? WHERE idm=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$prenom, $nom, $sexe, $daten, $photo, $id]);
            $profilModifie=array(
                "idm" => $id,
                "prenom"=> $prenom,
                "nom" => $nom,
                "courriel" => $courriel,
                "sexe" => $sexe,
                "datedenaissance" => $daten,
                "photo" => $photo,
            );
            $reponse['OK'] = true;
            $reponse['message'] = "Votre profil a ete modifie";
            $reponse['profilModifie'] = $profilModifie;
        } catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = $e->getMessage();
        }finally{
            unset($connexion); 
        }
    }

    function modifierMotdepass(){
        $id = $_POST['id'];
        $motdepass = $_POST['motdepass'];
        global $connexion, $reponse;
        try{
            $requette = "UPDATE connexion SET motdepass=? WHERE idm=?";
            $stmt = $connexion->prepare($requette);
            $stmt->execute([$motdepass, $id]);
            $reponse['OK'] = true;
            $reponse['message'] = "Mot de pass est bien modifie";
        }catch(Exception $e){
            $reponse['OK'] = false;
            $reponse['message'] = $e->getMessage();
        }finally{
            unset($connexion); //Detruire la connexion	
        }
    }


    $action = $_POST['action'];

    switch($action){
        case 'lister' :
            listerProfil();
            break;
        case 'modifier' :
            modifierProfil();
            break;
        case 'modMotdepass' :
            modifierMotdepass();
            break;
    }

    header("Content-Type: application/json");
    echo json_encode($reponse);
?>