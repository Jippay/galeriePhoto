<?php
/* On Récupére le contenu du fichier .json */
		// $contenu_fichier_json = file_get_contents('sql\dbc.json');
/* Les données json sont récupérées sous forme de tableau (true) */
// 		$dbInfos = json_decode($contenu_fichier_json, true);
// 		try{
// 			$bdd = new PDO('mysql:host=' . $dbInfos['hostname'] . ';dbname=' . $dbInfos['dbname'], $dbInfos['dbuser'], $dbInfos['dbpassword']);
// 			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 			$bdd->exec("SET NAMES utf8");
// 			echo '<span class="badge badge-success connectBadge">connecté</span>';
			
// 		}
// 		catch (Exception $e) {
// 			die ('Erreur : <span class="badge badge-pill badge-danger">non connecté</span>' . $e->getMessage());
// 		}

// ?>

<?php
class connectionDb
{
	public $db;
	public function __construct(){
		$this->db = NULL;
		$this->connectDb();
		return $this->db; 
	}
	public function connectDb()
	{
		/* On recupere le contenu du fichier .json */
		$contenu_fichier_json = file_get_contents('sql/dbc.json');
		/* Les données sont récupérées sous forme de tableau (true) */
		$dbInfos = json_decode($contenu_fichier_json, true);
		try{
			$db = new PDO('mysql:host=' . $dbInfos['hostname'] . ';dbname=' . $dbInfos['dbname'], $dbInfos['dbuser'], $dbInfos['dbpassword']);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$db->exec("SET NAMES utf8");
			if (!empty($db))
			{
				$this->db = $db;
				echo '<span class="badge badge-success connectBadge">connecté</span>';
			}
		}
		catch (Exception $e) {
			die ('Erreur : <span class="badge badge-pill badge-danger">non connecté</span>' . $e->getMessage());
		}
		return $this->db;
	}
}
?>