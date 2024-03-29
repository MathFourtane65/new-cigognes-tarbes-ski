<?php
class SortieController
{
    private $sortieModel;

    public function __construct($sortieModel)
    {
        $this->sortieModel = $sortieModel;
    }


    public function showListeSorties()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $sorties = $this->sortieModel->getAllSorties();
        require '../src/view/listSorties.php';
    }

    public function showCreateSortieForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/create-sortie.php';
    }


    public function processCreateSortie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération des données du formulaire avec validation
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $date_fin_inscriptions = filter_input(INPUT_POST, 'date_fin_inscriptions', FILTER_SANITIZE_SPECIAL_CHARS);

        $unlimitedPlaces = isset($_POST['unlimited_places']);
        $places_bus = $unlimitedPlaces ? null : filter_input(INPUT_POST, 'places_bus', FILTER_SANITIZE_NUMBER_INT);
        //$places_bus = filter_input(INPUT_POST, 'places_bus', FILTER_SANITIZE_NUMBER_INT);
        $heure_depart_bus = filter_input(INPUT_POST, 'heure_depart_bus', FILTER_SANITIZE_SPECIAL_CHARS);
        $arrets_bus = filter_input(INPUT_POST, 'arrets_bus', FILTER_SANITIZE_SPECIAL_CHARS);

        $created = $this->sortieModel->createSortie($nom, $lieu, $date, $date_fin_inscriptions, $places_bus, $heure_depart_bus, $arrets_bus);

        if ($created) {
            header('Location: /admin/new-sortie?success=create');
        } else {
            header('Location: /admin/new-sortie?error=failed_create');
        }
    }

    public function deleteSortie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleted = $this->sortieModel->deleteSortie($id);

        if ($deleted) {
            header('Location: /admin/sorties?success=delete');
        } else {
            header('Location: /admin/sorties?error=failed_delete');
        }
    }

    public function showUpdateSortieForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $sortie = $this->sortieModel->getSortie($id);

        if (!$sortie) {
            // Gérer l'erreur si l'article n'existe pas
            return;
        }

        require '../src/view/update-sortie.php';
    }

    public function processUpdateSortie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération et validation des données du formulaire
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $date_fin_inscriptions = filter_input(INPUT_POST, 'date_fin_inscriptions', FILTER_SANITIZE_SPECIAL_CHARS);
        $heure_depart_bus = filter_input(INPUT_POST, 'heure_depart_bus', FILTER_SANITIZE_SPECIAL_CHARS);
        $arrets_bus = filter_input(INPUT_POST, 'arrets_bus', FILTER_SANITIZE_SPECIAL_CHARS);

        $unlimitedPlaces = isset($_POST['unlimited_places']);
        $places_bus = $unlimitedPlaces ? null : filter_input(INPUT_POST, 'places_bus', FILTER_SANITIZE_NUMBER_INT);

        // Mise à jour de la sortie avec le modèle SortieModel
        $updated = $this->sortieModel->updateSortie($id, $nom, $lieu, $date, $date_fin_inscriptions, $places_bus, $heure_depart_bus, $arrets_bus);

        if ($updated) {
            header('Location: /admin/sorties/update?id=' . $id . '&success=update');
        } else {
            header('Location: /admin/sorties/update?id=' . $id . '&error=failed_update');
        }
    }
}
