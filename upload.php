<?php
include('_head.php');

if (isset ($_POST['envoyer'])){

    $dossier = 'images/';
    $date = date('Y-m-d H:i:s');
    $fichier = basename($_FILES['photo']['name']);
    $taille_maxi = 1000000000;
    $taille = filesize($_FILES['photo']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG');
    $extension = strrchr($_FILES['photo']['name'], '.'); 
        //Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur =   '
                        <div class="card mx-auto text-white bg-danger w-25 mt-3">
                            <div class="card-header">OoOoups ...</div>
                            <div class="card-body">
                                <h4 class="card-title">Echec de l\'upload !</h4>
                                <p class="card-text">C\'est un formulaire d\'upload de photos, donc des fichiers dont l\'extention est .png, .jpg .gif ou .jpeg ... Merci</p>
                                <a href="uploadPhoto.php" class="btn btn-secondary">Retenter le coup</a>
                            </div>
                        </div>
                        ';
        }
        if($taille>$taille_maxi)
        {
            $erreur =   '
                        <div class="card mx-auto text-white bg-danger w-25 mt-3">
                            <div class="card-header">OoOoups ...</div>
                            <div class="card-body">
                                <h4 class="card-title">Echec de l\'upload !</h4>
                                <p class="card-text">La photo est trop lourde ! Essayez de la passer par la case régime ... (ps: la limite d\'upload est de 1Go)</p>
                                <a href="uploadPhoto.php" class="btn btn-secondary">Retenter le coup</a>
                            </div>
                        </div>
                        ';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = strtr($fichier, 
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné.
            {
                echo '
                    <div class="card mx-auto border-success w-25 mt-3">
                        <div class="card-header">Yeaah !!</div>
                        <div class="card-body">
                            <h4 class="card-title">Upload réussi !</h4>
                            <p class="card-text">Toutes les conditions ont été réuni pour que la photo soit envoyée vers la gallerie ! BRAVO !</p>
                            <a href="uploadPhoto.php" class="btn btn-outline-success">Retour au formulaire</a>
                        </div>
                    </div>
                    ';

                    require_once 'class/connectDB.php';

                    //On récupère les valeurs entrées par l'utilisateur :
                    $sujet = $_POST['sujet'];
                    $sujet2 = $_POST['sujet2'];
                    $photographe = $_POST['photographe'];
                    $photo = $fichier;
                    $theme = $_POST['theme'];
                    $droit = $_POST['droitDiff'];


                    //on entre les données dans la table 'photo'
                    $db = new connectionDb();
                    $req = $db->db->prepare('INSERT INTO photo (nom_PHOTO, date_PHOTO, id_PHOTOGRAPHE, id_Droit) VALUES(?, ?, ?, ?)');
                    $req->execute(array(
                                    $fichier,
                                    $date,
                                    $photographe,
                                    $droit));
                    
                    $id_PHOTO = $db->db->lastInsertId();

                    //on entre la donnée sujet1 dans la table 'sujet'
                    $db = new connectionDb();
                    $req = $db->db->prepare("SELECT nom_SUJET FROM sujet WHERE nom_SUJET = '$sujet'");
                    $req->execute();
                        
                        if(($req->rowCount()) !== 0){
                            var_dump($req);
                        }
                        
                        else { 
                            $req = $db->db->prepare('INSERT INTO sujet (nom_SUJET) VALUES(:nom_SUJET)');
                            $req->execute(array('nom_SUJET' =>$sujet));
                        }

                    $sujet1 = $db->db->lastInsertId();

                    //on entre la donnée sujet2 dans la table 'sujet'
                    $db = new connectionDb();
                    $req = $db->db->prepare('INSERT INTO sujet (nom_SUJET) VALUES (?)');
                    $req->execute(array(
                                        $sujet2));

                    $sujet2 = $db->db->lastInsertId();

                    //on entre les données dans la table de jointure 'appartient'
                    $db = new connectionDb();
                    $req = $db->db->prepare('INSERT INTO appartient (id_PHOTO, id_THEME) VALUES (?,?)');
                    $req->execute(array(
                                    $id_PHOTO,
                                    $theme));
                    
                    //on entre les données dans la table de jointure 'represente'
                    $db = new connectionDb();
                    $req = $db->db->prepare('INSERT INTO represente (id_PHOTO, id_SUJET) VALUES (?,?)');
                    $req->execute(array(
                                    $id_PHOTO,
                                    $sujet1));

                    //on entre les données dans la table de jointure 'represente'
                    // $db = new connectionDb();
                    // $req = $db->db->prepare('INSERT INTO represente (id_PHOTO, id_SUJET) VALUES (?,?)');
                    // $req->execute(array(
                    //                 $id_PHOTO,
                    //                 $sujet2));

                        };

            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo '
                <div class="card mx-auto text-white bg-danger w-25 mt-3">
                    <div class="card-header">Oula ...</div>
                    <div class="card-body">
                        <h4 class="card-title">Echec de l\'upload !</h4>
                        <p class="card-text">Mince, quelque chose s\'est mal passé pendant l\'upload de la photo : Pas la bonne extension, ou alors la photo est trop lourde ...</p>
                        <a href="uploadPhoto.php" class="btn btn-secondary">Retenter le coup</a>
                    </div>
                </div>
                ';

            }
        }
        else
        {
            echo $erreur;
        }

?>