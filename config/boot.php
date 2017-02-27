<?php

   require_once 'config/safe.php';

   $pdo = new PDO('mysql:host='.db_host.';dbname='.db_name.';charset=utf8;', db_user, db_password);
