<?php
    declare (strict_types=1);

    require_once(__DIR__."/../bd/Connexion.php");

    class DaoProduit{
        static private $modelProduit = null;
        private $reponse = array();
        private $connexion = null;

        private function __construct(){}

        static function getDaoProduit():DaoProduit{
            if(self::$modelProduit == null){
                self::$modelProduit = new DaoProduit();
            }
            return self::$modelProduit;
        }

        function MdlP_Enregistrer($produit):string{
            $connexion =  Connexion::getConnexion();
            try{
                $requette = "INSERT INTO produits VALUES(0, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $connexion->prepare($requette);
                $stmt->execute($produit);
                $dernierId =  $connexion->lastInsertId();
                $produitInsere=array(
                    "idp" => $dernierId,
                    "pochette"=> $produit[0],
                    "titre" => $produit[1],
                    "categorie" => $produit[2],
                    "description" => $produit[3],
                    "prix" => $produit[4],
                    "quantite" => $produit[5],
                    "date" => $produit[6]
                );
                $this->reponse['OK'] = true;
                $this->reponse['message'] = "Produit ".$produit[1]." a ete enregistre";
                $this->reponse['produitInsere'] = $produitInsere;
            } catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['message'] = $e->getMessage();
            }finally{
                unset($connexion);
                return json_encode($this->reponse);
            }
        }
    
        function MdlP_Lister(){
            $connexion =  Connexion::getConnexion();
            $this->reponse['listeProduits'] = array();
            try{
                $requette = "SELECT * FROM produits ORDER BY idp DESC";
                $stmt = $connexion->prepare($requette);
                $stmt->execute();
                $this->reponse['OK'] = true;
                while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
                    $this->reponse['listeProduits'][] = $ligne;
                }
            }catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['message'] = "Probleme pour lister!";
            }finally{
                unset($connexion);
                return json_encode($this->reponse);
            }
        }
    
        function MdlP_Fiche($id){
            $connexion =  Connexion::getConnexion();
            $this->reponse['unProduit'] = array();
            try{
                $requette = "SELECT * FROM produits WHERE idp=?";
                $stmt = $connexion->prepare($requette);
                $stmt->execute([$id]);
                if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
                    $this->reponse['unProduit'] = $ligne;
                    $this->reponse['OK'] = true;
                }
            }catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['message'] = $e->getMessage();
            }finally{
                unset($connexion);
                return json_encode($this->reponse);
            }
        }
            
        function MdlP_Pochette($id){   
            $connexion = Connexion::getConnexion();
            try{
                $requette="SELECT pochette FROM produits WHERE idp=?";
                $stmt=$connexion->prepare($requette);
                $stmt->execute([$id]);
                $ligne=$stmt->fetch(PDO::FETCH_OBJ);
            } catch(Exception $e){
                
            }finally{
                unset($connexion);
                return $ligne->pochette; 
            }
        }
    
        function MdlP_Modifier($produit){   
            $connexion =  Connexion::getConnexion();
            try{
                $requette = "UPDATE produits SET  pochette=?, titre=?, categorie=?, description=?, prix=?, quantite=?, date=? WHERE idp=?";
                $stmt = $connexion->prepare($requette);
                $stmt->execute($produit);
                $produitModifie=array(
                    "idp" => $produit[7],
                    "pochette"=> $produit[0],
                    "titre" => $produit[1],
                    "categorie" => $produit[2],
                    "description" => $produit[3],
                    "prix" => $produit[4],
                    "quantite" => $produit[5],
                    "date" => $produit[6]
                );
                $this->reponse['OK'] = true;
                $this->reponse['message'] = "Produit ".$produit[1]." a ete modifie";
                $this->reponse['produitModifie'] = $produitModifie;
            } catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['message'] = $e->getMessage();
            }finally{
                unset($connexion);
                return json_encode($this->reponse); 
            }
        }
    
        function MdlP_Enlever($id){
            $connexion =  Connexion::getConnexion();
            try{
                $requette = "DELETE FROM produits WHERE idp=?";
                $stmt = $connexion->prepare($requette);
                $stmt->execute([$id]);
                $this->reponse['OK'] = true;
                $this->reponse['message'] = "Produit ".$id." a ete enleve";
            }catch(Exception $e){
                $this->reponse['OK'] = false;
                $this->reponse['message'] = $e->getMessage();
            }finally{
                unset($connexion); 
                return json_encode($this->reponse);
            }
        }
    }
?>