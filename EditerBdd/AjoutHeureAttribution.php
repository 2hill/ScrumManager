<?php

/*Connection to the db and insert data collected
from the "form" (located in "attribution of hours page") */

        require_once '../config/boot.php';


        $req = $pdo->prepare('INSERT INTO attribution (heure, id_Sprint, id_Employe, id_Projet) VALUES(?, ?, ?, ?)');
        $req->execute(array($_POST['nbheure'], $_POST['numerosprint'], $_POST['employeid'], $_POST['projetid']));

        /* Refresh the page*/

        header('Location: ../page2.php');
    ?>
