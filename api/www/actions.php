<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

$app->get('/action/getChart/{numero}', function ($numero) use ($app) {
    $qb = $app['db']->createQueryBuilder('');

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=scrum;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    if ($numero <= 0)
    {
        $sql = "SELECT $numero as sprint, burndownhour as value, date as heure , (SELECT sum(interference.heure) FROM interference where interference.id_Sprint = ( SELECT max(sprint.id) FROM sprint )) as interferances FROM `vburndown`where id_Sprint = (SELECT  max(sprint.id) FROM sprint ) order by Date";
    
    }
    else
    {
        $sql = "SELECT $numero as sprint, burndownhour as value, date as heure , (SELECT sum(interference.heure)  FROM interference where interference.id_Sprint = ( SELECT sprint.id FROM sprint WHERE sprint.numero = $numero )) as interferances FROM `vburndown`where id_Sprint = (SELECT sprint.id FROM sprint WHERE sprint.numero = $numero) order by Date";
    }
    $tmpQuery = $bdd->prepare($sql);
    $tmpQuery->execute();

    $result = $tmpQuery->fetchAll();

    $values = [];
    $hours = [];
    $interferences = [];
    $sprintou = [];

    foreach ($result as $row) {
       $values[] = $row['value'];
       $hours[] = $row['heure'];
       $interferences[] = $row['interferances'];
       $sprintou[] = $row['sprint'];
    }
    if (!$values && !$hours && !$interferences && !$sprintou ){
         $app->abort(404, "Le Sprint n°$numero manque de données pour afficher le tableau" );
    }
    
    $toReturn[] = $values;
    $toReturn[] = $hours;
    $toReturn[] = $interferences;
    $toReturn[] = $sprintou;
    return $app->json($toReturn);
})->bind('get_action');


$app->get('/action/gethourdown/{numero}', function ($numero) use ($app) {
    $qb = $app['db']->createQueryBuilder('');

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=scrum;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    $sql = "select $numero as Sprint, attribution.heure as NbHeure, projet.nom as projet, employe.prenom as employe FROM attribution inner JOIN employe ON employe.id = attribution.id_Employe INNER JOIN projet ON projet.id = attribution.id_Projet INNER JOIN sprint ON sprint.id = attribution.id_Sprint where id_sprint=$numero ORDER BY attribution.id DESC ";
    
    $tmpQuery = $bdd->prepare($sql);
    $tmpQuery->execute();

    $result = $tmpQuery->fetchAll();

    $nbheure = [];
    $employe = [];
    $projet = [];

    foreach ($result as $row) {
       $nbheure[] = $row['NbHeure'];
       $employe[] = $row['employe'];
       $projet[] = $row['projet'];
    }
    if (!$nbheure && !$employe && !$projet ){
         $app->abort(404, "Le Sprint n°$numero manque de données pour afficher le tableau" );
    }
    
    $toReturn[] = $employe;
    $toReturn[] = $projet;
    $toReturn[] = $nbheure;
    
    return $app->json($toReturn);
})->bind('get_hdown');


$app->get('/action/gettothourdown/{numero}', function ($numero) use ($app) {
    $qb = $app['db']->createQueryBuilder('');

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=scrum;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    $sql = "select sum(attribution.heure) as totHeure FROM attribution INNER JOIN sprint on sprint.id = attribution.id_Sprint where id_sprint=$numero GROUP BY sprint.id";
    
    $tmpQuery = $bdd->prepare($sql);
    $tmpQuery->execute();

    $result = $tmpQuery->fetchAll();

    $totheure = [];

    foreach ($result as $row) {
       $totheure[] = $row['totHeure'];
    }
    if (!$totheure ){
         $app->abort(404, "Le Sprint n°$numero manque de données pour afficher le tableau" );
    }
    
    $toReturn[] = $totheure;
    
    return $app->json($toReturn);
})->bind('get_tothdown');


$app->get('/action/sprintExist/{numero}', function ($numero) use ($app) {
    $qb = $app['db']->createQueryBuilder('');

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=scrum;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    if ($numero != 0)
    {
        $sql = "SELECT $numero as sprint, burndownhour as value, date as heure , (SELECT sum(interference.heure)  FROM interference where interference.id_Sprint = ( SELECT sprint.id FROM sprint WHERE sprint.numero = $numero )) as interferances FROM `vburndown`where id_Sprint = (SELECT sprint.id FROM sprint WHERE sprint.numero = $numero) order by Date";
    
    }
    else
    {
        return $app->json("envois pas des conneries toi");
    }
    $tmpQuery = $bdd->prepare($sql);
    $tmpQuery->execute();

    $result = $tmpQuery->fetchAll();
    if(count($result) > 0){
        return $app->json(true);
    }else{
        return $app->json(false);
    }
})->bind('get_sprintExist');