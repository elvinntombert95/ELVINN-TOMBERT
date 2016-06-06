<?php
namespace Controller;

use Model\PageRepository;

/**
 * Class PageController
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Controller
 */
class PageController
{
    /**
     * PageController constructor.
     * @param \PDO $PDO
     */
    public function __construct(\PDO $PDO)
    {
        $this->repository = new PageRepository($PDO);
    }

    /**
     *
     */
    public function ajoutAction()
    {
        if(count($_POST) === 0){
            // affiche la form
            require 'view/admin/new.php';
        } else {
            // traite la form
            $data = $this->repository->ajouter($_POST);
            header( 'Location:index.php' );
        }
    }

    /**
     *
     */
    public function supprimerAction()
    {
        if(!isset($_GET['id'])){
            throw new \Exception('Widi Wouloukou');
        }
        $id = $_GET['id'];
        $this->repository->supprimer($id);
        header("Location:index.php");
    }

    /**
     *
     */
    public function modifierAction()
    {
        if(!isset($_GET['id'])){
            throw new \Exception('Widi Wouloukou');
        }
        $id = $_GET['id'];
        if (count($_POST) === 0) {
            $details = $this->repository->getById($id);
            if ($details === false) {
                include "view/404.php";
            } else {
                include "view/admin/update.php";
            }
        } else {
            $data = $_POST;
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars($data[$key]);
            }
            $this->repository->modifier($data, $id);
            $details = $this->repository->getById($id);
            $data = $this->repository->findAll();
            include "view/admin/liste.php";
        }
    }

    /**
     *
     */
    public function detailsAction()
    {
        if(!isset($_GET['id'])){
            throw new \Exception('mdr le truc');
        }
        // recuperation de donnees
        $data = $this->repository->getById($_GET['id']);
        // affichage des donnees
        require "view/admin/pageDetails.php";
    }

    /**
     *
     */
    public function listeAction()
    {
        // recuperer les donnees
        $data = $this->repository->findAll();
        // afficher les donnees
        require "view/admin/pageList.php";
    }

    /**
     *
     */
    public function displayAction()
    {
        // definition d'un slug par defaut (en cas d'appel sans parametre dans l'url)
        $slug = 'teletubbies';
        // recuperation du slug du parametre d'url si present
        if (isset($_GET['p'])) {
            $slug = $_GET['p'];
        }
        // en PHP 7
        // $slug = $_GET['p'] ?? $_POST['p'] ?? 'teletubbies';
        // recuperation les donnees de la page qui correspond au slug
        $page = $this->repository->getBySlug($slug);
        // si il n'y a pas de donnees, erreur 404
        if ($page === false) {
            // 404
            include "view/404.php";

            return;
        }
        // je dois avoir la nav initialisee pour que la vue la montre
        $nav = $this->genererLaNav($slug);
        // j'ai des donnees, je le affiche
        include "view/page-display.php";
    }

    private function genererLaNav($slug)
    {
        ob_start();
        $data = $this->repository->findAll();
        include "view/nav.php";
        // generer la nav
        $nav = ob_get_clean();

        return $nav;
    }
}