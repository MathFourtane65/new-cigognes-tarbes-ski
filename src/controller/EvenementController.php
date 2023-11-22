<?php

class EvenementController
{
    private $evenementModel;

    public function __construct($evenementModel)
    {
        $this->evenementModel = $evenementModel;
    }

    public function showListeEvenements()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $evenements = $this->evenementModel->getAllEvenementsSortByDate();
        require '../src/view/listEvenements.php';
    }

    public function showCreateEvenementForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        require '../src/view/create-evenement.php';
    }

    public function processCreateEvenement()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        if (isset($_POST['date']) && isset($_POST['nom']) && isset($_POST['lieu'])) {
            $date = $_POST['date'];
            $nom = $_POST['nom'];
            $lieu = $_POST['lieu'];

            $this->evenementModel->createOneEvenement($date, $nom, $lieu);
            header("Location: /admin/evenements/new?success=create");
            exit();
        } else {
            header("Location: /admin/evenements/new?error=missing-info");
            exit();
        }
    }

    public function deleteEvenement()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleted = $this->evenementModel->deleteOneEvenement($id);

        if ($deleted) {
            header('Location: /admin/evenements?success=delete');
        } else {
            header('Location: /admin/evenements?error=failed_delete');
        }
    }
}
