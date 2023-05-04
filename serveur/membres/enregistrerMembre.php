<?php
    require_once('../includes/dbcon.inc.php');

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $motdepass = $_POST['motdepass'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['daten'];

    $dossier="photos/";
    $photo="avatar.jpg";
    if($_FILES['photo']['tmp_name']!==""){
        $nomPhoto=sha1($nom.time());
        //Upload de la photo
        $tmp = $_FILES['photo']['tmp_name'];
        $fichier= $_FILES['photo']['name'];
        $extension=strrchr($fichier,'.');
        @move_uploaded_file($tmp,$dossier.$nomPhoto.$extension);
        // Enlever le fichier temporaire chargé
        @unlink($tmp); //effacer le fichier temporaire
        $photo=$nomPhoto.$extension;
    }

    $stmt = $connexion->prepare("SELECT courriel FROM membres WHERE courriel=?");
    $stmt->execute([$courriel]);
	if($ligne = $stmt->fetch(PDO::FETCH_OBJ)){
        unset($connexion);
        $msg = "Courriel $courriel exist";
        header('Location: ../../index.php?msg='.$msg);
        exit;
    }
    else{
        $stmt = $connexion->prepare("INSERT INTO membres VALUES (0, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $courriel, $sexe, $daten, $photo]);
        $idm = $connexion->lastInsertId();

        $stmt = $connexion->prepare("INSERT INTO connexion VALUES (?, ?, ?, 'M', 'A')");
        $stmt->execute([$idm, $courriel, $motdepass]);
        unset($connexion);
        $msg = "Vous êtes bien enregistré";
        header('Location: ../../index.php?msg='.$msg);
        exit; 
    }
?>
