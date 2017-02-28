<?php

/*Connection to the db and insert data collected
from the "form" (located in "attribution of hours page") */

         require_once '../config/boot.php';


$req = $pdo->prepare('INSERT INTO sprint (numero, dateDebut, dateFin) VALUES(?, ?, ?)');
$req->execute(array($_POST['numero'], $_POST['dateDebut'], $_POST['dateFin']));

  /* Refresh the page*/

header('Location: ../php/page2.php');
?>
