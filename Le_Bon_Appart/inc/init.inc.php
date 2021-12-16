<?php

// connexion a la bdd
$host = 'mysql:host=localhost;dbname=wf3_php_intermediaire_bilel';
$login = 'root';
$password = '';

$option = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

$pdo = new PDO($host, $login, $password, $option);

// creation de la variable de msg utilisisateur
$msg = '';

// constante pour l'url
define('URL', 'http://localhost/PHP/LE_Bon_Appart/');