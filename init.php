<?php
// inclusion de l'autoload composer qui permet
// de ne pas faire les inclusions de classes a la main
require_once __DIR__."/vendor/autoload.php";
// connexion a la base de donnees
try{
    $pdo = new \PDO("mysql:host=localhost;dbname=kandt","root","root");
    $pdo->query("SET NAMES 'UTF8';");
}catch(PDOException $e){
    die($e->getMessage());
}

function isActive($val1, $val2)
{
    if($val1 == $val2){
        return " active ";
    } else {
        return '';
    }
}

function isChecked($val1, $val2)
{
    if($val1 == $val2){
        return ' checked="checked"';
    } else {
        return '';
    }
}
