<?php
require_once "init.php";
// demarre notre application
$page = new \Controller\PageController($pdo);
// afficher la page demandee
$page->displayAction();
