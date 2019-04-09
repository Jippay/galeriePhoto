<?php 
require_once 'class/connectDB.php';

	// on affiche les themes déjà entrer dans la base de données, dans notre select
	function getThemes(){
		try {
			//selection de la table où l'ont recupere les informations
			$db = new connectionDb();
            $reponse = $db->db->prepare('SELECT id_THEME, nom_THEME FROM Theme ORDER BY id_THEME');
            $reponse->execute();

			//boucle pour afficher les resultats
			foreach ($reponse as $row) {
				echo '<option value="'.$row["id_THEME"].'">'.$row["nom_THEME"].'</option>';
			}	//on ajoute comme value au select l'id, et on affiche le nom associé
		}
        catch (Exception $e) {
			print("Erreur : " . $e->getMessage());
        }
	}

?>
<?php

	//on affiche les photographes déjà entrés dans la base de donneés, dans notre select
	function getPhotographe(){
		try {
			$db = new connectionDb();
			$reponse = $db->db->prepare('SELECT id_PHOTOGRAPHE, nom_PHOTOGRAPHE FROM photographe ORDER BY id_PHOTOGRAPHE');
			$reponse->execute();
			
			foreach ($reponse as $row) {
				echo '<option value="'.$row["id_PHOTOGRAPHE"].'">'.$row["nom_PHOTOGRAPHE"].'</option>';
			}
		}
		catch (Exception $e) {
			print("Erreur : " . $e->getMessage());
		}
	}

	//on affiche les droit de diffusions déjà entrés dans la base de donneés, dans notre select
	function getDiffusion(){
		try {

			$db = new connectionDb();
			$reponse = $db->db->prepare('SELECT id_Droit, nom_Droit FROM droitdiffusion ORDER BY id_Droit');
			$reponse->execute();
			
			foreach ($reponse as $row) {
				echo '<option value="'.$row["id_Droit"].'">'.$row["nom_Droit"].'</option>';
			}
		}
		catch (Exception $e) {
			print("Erreur : " . $e->getMessage());
		}
	}

?>
