<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css\dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="css\style.css"/>
    <link rel="stylesheet" href="css\bootstrap.css"/>

    <title>Sprint</title>
  </head>

  <body>

        <!-- Navbar Twitter Bootstrap -->

    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="index">Créer Sprint</a></li>
        <li><a href="page2">Attribution Heures</a></li>
        <li><a href="page3">Heures Descendues</a></li>
        <li><a href="page4">Burndownchart</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Editer <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Sprint</a></li>
                <li><a href="#">Heures Attribuées</a></li>
                <li><a href="#">Heures Descendues</a></li>
            </ul>
        </li>
    </ul>

      <!-- Link to db PDO connect -->

 <?php
  include("config/boot.php");
    ?>

  <!-- Links to  scripts -->

    <script src="js\jquery-3.1.1.min.js"></script>
    <script src="js\jquery.dataTables.min.js"></script>
    <script src="js\bootstrap-datetimepicker.js"></script>
    <script src="js\bootstrap.min.js"></script>
    <script src="js\dataTables.bootstrap.min.js"></script>
    <script src="js\highcharts.js"></script>
    <script src="js\exporting.js"></script>
    <script src="js\index.js"></script>


  </body>
</html>
