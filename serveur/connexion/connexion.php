<?php
    session_start();
    require_once('../includes/dbcon.inc.php');

    function obtenirPhotoMembre($idm){
        global $connexion;
        $stmt = $connexion->prepare("SELECT photo FROM membres WHERE idm = ?");
        $stmt->execute([$idm]);
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        return $ligne->photo;
    }

    function obtenirNom($idm){
        global $connexion;
        $stmt = $connexion->prepare("SELECT prenom, nom FROM membres WHERE idm = ?");
        $stmt->execute([$idm]);
        $ligne = $stmt->fetch(PDO::FETCH_OBJ);
        return $ligne->prenom." ".$ligne->nom;
    }

    $courriel = $_POST['courrielcon'];
    $motdepass = $_POST['motdepasscon'];

    $stmt = $connexion->prepare("SELECT * FROM connexion WHERE courriel=?");
    $stmt->execute([$courriel]);
	if(!$ligne = $stmt->fetch(PDO::FETCH_OBJ)){//Si pas trouvé
        unset($connexion);
        $msg = "Courriel $courriel ne exist pas";
        header('Location: ../../index.php?msg='.$msg);
        exit;
    }
    else if ($ligne->motdepass == $motdepass) {
        $idm = $ligne->idm;
        if($ligne->statut == "A"){
            $_SESSION['courriel'] = $courriel;
            $_SESSION['role'] = $ligne->role;
            if($ligne->role == "M"){
                $photo = obtenirPhotoMembre($idm);
                $_SESSION['photo'] = $photo;
                $_SESSION['nom'] = obtenirNom($idm);
                $_SESSION['id'] = $idm;
                header("Location: ../membres/membre.php");
                exit;
            }
            else if($ligne->role == "A"){
                header("Location: ../admin/admin.php");
                exit;
            }
        }
        else{
            $msg="Membre est inactivé. Veuillez contacter administrateur.";
            header('Location: ../../index.php?msg='.$msg);
            exit;
        }
    }
    else{
        $msg = "Mot de pass ne est pas correct";
        header('Location: ../../index.php?msg='.$msg);
        exit; // Obligatoire
    }
    unset($connexion);
?>
