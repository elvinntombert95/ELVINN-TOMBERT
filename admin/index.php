<?php
chdir($appRoot = dirname(__DIR__));
require_once "init.php";
// demarre notre application
$page = new \Controller\PageController($pdo);
// afficher la page demandee
$action = '';
// recuperation du slug du parametre d'url si present
if (isset($_GET['a'])) {
    $action = $_GET['a'];
}
//$action = $_GET['a'] ?? ''; // < en PHP 7
switch($action){
    case 'ajouter':
            $page->ajoutAction();
        break;
    
    case 'modifier':
            $page->modifierAction();
        break;
    
    case 'supprimer':
            $page->supprimerAction();
        break;
    
    case 'details':
            $page->detailsAction();
        break;
    
    case 'lister':
    default:
        $page->listeAction();
        break;
}
