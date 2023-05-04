<?php
    require_once("DaoProduit.php");

    class ControleurProduit { 
        static private $instanceCtr = null;
        // static private $instanceDao = null;
        private $reponse;

        private function __construct(){}

        static function getControleurProduit():ControleurProduit{
            if(self::$instanceCtr == null){
                self::$instanceCtr = new ControleurProduit(); 
            }
            return self::$instanceCtr;
        }

        function CtrP_Enregistrer(){
            $titre = $_POST['titre'];
            $categorie = $_POST['categorie'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $quantite = $_POST['quantite'];
            date_default_timezone_set('America/New_York');
            $date = date("Y-m-d H:i:s");
            $repPochettes = __DIR__."/../pochettes/";
            $nouveauNom = "OfficeEssen.jpg";
            if($_FILES['pochette']['tmp_name'] != ""){
                $tmpFic = $_FILES['pochette']['tmp_name'];
                $nomOriginal = $_FILES['pochette']['name'];
                $extension = strrchr($nomOriginal,'.');
                $nouveauNom = sha1($titre.time()).$extension;
                @move_uploaded_file($tmpFic, $repPochettes.$nouveauNom);
            }
            $produit = array($nouveauNom, $titre, $categorie, $description, $prix, $quantite, $date);
            return DaoProduit::getDaoProduit()->MdlP_Enregistrer($produit); 
        }

        function CtrP_Lister(){
            return DaoProduit::getDaoProduit()->MdlP_Lister(); 
        }

        function CtrP_Fiche(){
            $id = $_POST['id'];
            return DaoProduit::getDaoProduit()->MdlP_Fiche($id); 
        }

        function CtrP_Modifier(){
            $id = $_POST['id'];
            $titre = $_POST['titreM'];
            $categorie = $_POST['categorieM'];
            $description = $_POST['descriptionM'];
            $prix = $_POST['prixM'];
            $quantite = $_POST['quantiteM'];
            date_default_timezone_set('America/New_York');
            $date = date("Y-m-d H:i:s");
            $repPochettes =  __DIR__."/../pochettes/";
            $pochette = DaoProduit::getDaoProduit()->MdlP_Pochette($id);
            if($_FILES['pochetteM']['tmp_name'] != ""){
                if($pochette !== "OfficeEssen.jpg"){
                    $rmPoc=$repPochettes.$pochette;
                    $tabFichiers = glob($repPochettes."*");
                    foreach($tabFichiers as $fichier){
                    if(is_file($fichier) && $fichier==trim($rmPoc)) {
                        unlink($fichier);
                        break;
                        }
                    }
                }
                $tmpFic = $_FILES['pochetteM']['tmp_name'];
                $nomOriginal = $_FILES['pochetteM']['name'];
                $extension = strrchr($nomOriginal,'.');
                $pochette = sha1($titre.time()).$extension;
                @move_uploaded_file($tmpFic, $repPochettes.$pochette);
            }
            $produit = array($pochette, $titre, $categorie, $description, $prix, $quantite, $date, $id);
            return DaoProduit::getDaoProduit()->MdlP_Modifier($produit); 
        }

        function CtrP_Enlever(){
            $id = $_POST['id'];
            $repPochettes =  __DIR__."/../pochettes/";
            $pochette = DaoProduit::getDaoProduit()->MdlP_Pochette($id);
            if($pochette !== "OfficeEssen.jpg"){
                $rmPoc=$repPochettes.$pochette;
                $tabFichiers = glob($repPochettes."*");
                foreach($tabFichiers as $fichier){
                    if(is_file($fichier) && $fichier==trim($rmPoc)) {
                        unlink($fichier);
                        break;
                    }
                }
            }     
            return DaoProduit::getDaoProduit()->MdlP_Enlever($id); 
        }

        function CtrP_Actions(){
            $action = $_POST['action'];
            switch($action){
                case 'enregistrer' :
                    return $this->CtrP_Enregistrer();
                case 'lister' :
                    return $this->CtrP_Lister();
                case 'fiche' :
                    return $this->CtrP_Fiche();
                case 'modifier' :
                    return $this->CtrP_Modifier();
                case 'enlever' :
                    return $this->CtrP_Enlever();
            }
        }
    }
?>