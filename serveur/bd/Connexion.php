<?php
declare (strict_types=1);

require_once("env.inc.php");

class Connexion{
	private static $connexion=null;
	
	private function __construct(){}

	static function getConnexion():PDO {
		if(self::$connexion == null){
			self::connecter();
		}
		return self::$connexion;
	}

	private static function connecter():void {
		global $SERVEUR, $BD, $USAGER, $PASS; 
		try {
			$dns = "mysql:host=$SERVEUR;dbname=$BD";
			$options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			self::$connexion = new PDO( $dns, $USAGER, $PASS, $options );
			} catch ( Exception $e ) {
				echo $e->getMessage();
				echo "Probleme de connexion au serveur de bd";
				exit();
			}
	}
}
?>