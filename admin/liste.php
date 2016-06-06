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
?>

<html>
<head>
    <meta charset="utf-8">
    <title>AJOUTER</title>
    <style type="text/css">
        #slug, #title {
            display: block;
            margin: 50px 0;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <h1>AJOUTER</h1>
    <form action="../model/PageRepository.php" method="post">
        <input type="text" name="slug" id="slug" placeholder="NAVBAR"></input>
        <input type="text" name="title" id="title" placeholder="TITRE"></input>
            <button>VALIDER</button>
    </form>
</body>
</html>