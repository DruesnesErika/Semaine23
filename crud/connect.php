<?php
try{
    // On se connecte à la base
    $db = new PDO('mysql:host=localhost;dbname=jarditou', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur: '. $e->getMessage();
    die();
}