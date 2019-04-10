<?php
// require_once 'class/connectDB.php';

// if (isset($_GET['term'])){
//     $return_arr = array();


//         $db = new connectionDb();

//         $requete = $db->db->prepare('SELECT * FROM sujet WHERE nom_SUJET like :term');
//         $requete->execute(array('term' => '%'.$_GET['term'].'%'));
        
//         while($row = $requete->fetch()) {
//             $return_arr[] =  $row['nom_SUJET'];
//         }

        
//     echo json_encode($array);
// }

define('DB_SERVER', 'localhost');
define('DB_USER', 'Seb');
define('DB_PASSWORD', 'Seb');
define('DB_NAME', 'photon18');


if (isset($_GET['term'])){
    $return_arr = array();

    try {
        $conn = new PDO("mysql:host=".DB_SERVER.";port=8889;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('SELECT nom_SUJET FROM sujet WHERE nom_SUJET LIKE :term');
        $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        
        while($row = $stmt->fetch()) {
            $return_arr[] =  $row['nom_SUJET'];
        }

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}


?>