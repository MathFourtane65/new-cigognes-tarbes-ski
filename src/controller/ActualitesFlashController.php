<?php
class ActualitesFlashController
{
    private $actualitesFlashModel;

    public function __construct($actualitesFlashModel)
    {
        $this->actualitesFlashModel = $actualitesFlashModel;
    }


    public function showListeActualitesFlash()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $actualitesFlash = $this->actualitesFlashModel->getAllActualitesFlash();
        require '../src/view/listActualitesFlash.php';
    }

    public function showUpdateActualitesFlash()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $actualiteFlash = $this->actualitesFlashModel->getOneActualitesFlash($id);

        if (!$actualiteFlash) {
            // Gérer l'erreur si le licencié n'existe pas
            header("Location: /admin/actualites-flash?error=not_found");
            exit();
        }
        require '../src/view/update-actualites-flash.php';
    }

    public function updateActualitesFlash()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);
        $cache = filter_input(INPUT_POST, 'cache', FILTER_SANITIZE_NUMBER_INT);

        // if (!$id || !$contenu || !$cache) {
        //     // Gérer l'erreur si un champ obligatoire n'est pas rempli
        //     header("Location: /admin/actualites-flash/update?id=$id&error=empty_fields");
        //     exit();
        // }

        // $actualiteFlash = $this->actualitesFlashModel->getOneActualitesFlash($id);

        // if (!$actualiteFlash) {
        //     // Gérer l'erreur si le licencié n'existe pas
        //     header("Location: /admin/actualites-flash?error=not_found");
        //     exit();
        // }

        $result = $this->actualitesFlashModel->updateActualitesFlash($id, $contenu, $cache);

        if ($result) {
            header('Location: /admin/actualites-flash/update?id=' . $id . '&success=update');
        } else {
            header('Location: /admin/actualites-flash/update?id=' . $id . '&error=failed_update');
        }
    }
}
