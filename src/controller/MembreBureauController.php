<?php

class MembreBureauController
{
    private $membreBureauModel;

    public function __construct($membreBureauModel)
    {
        $this->membreBureauModel = $membreBureauModel;
    }

    public function showListeMembresBureaux()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $membresBureau = $this->membreBureauModel->getAllMembresBureauSortByNom();
        require '../src/view/listMembresBureau.php';
    }

    public function showCreateMembreBureauForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/create-membre-bureau.php';
    }

    public function deleteMembreBureau()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $moniteurToDelete = $this->membreBureauModel->getOneMembreBureau($id);

        $deleted = $this->membreBureauModel->deleteOneMembreBureau($id);

        $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $moniteurToDelete['photo'];
        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }

        if ($deleted) {
            header('Location: /admin/bureau?success=delete');
        } else {
            header('Location: /admin/bureau?error=failed_delete');
        }
    }

    public function processCreateMembreBureau()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

        // pour l'instant vide car pas dans le formulaire de création
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_SPECIAL_CHARS);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);

        // Initialisez la variable $relative_upload_path avec une image par défaut ou vide
        //$relative_upload_path = "/images/uploads/moniteurs/entraineur.png"; // Chemin vers une image par défaut
        $relative_upload_path = ""; // Chemin vers une image par défaut

        // Vérifiez si un fichier photo a été téléchargé
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['photo'];
            $basename = bin2hex(random_bytes(8));
            $upload_name = $basename . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

            // Chemin relatif à partir du dossier public où les images seront stockées
            $relative_upload_path = "/images/uploads/bureau/" . $upload_name;

            // Chemin absolu sur le serveur pour enregistrer le fichier
            $absolute_upload_path = $_SERVER['DOCUMENT_ROOT'] . $relative_upload_path;

            if (!move_uploaded_file($photo['tmp_name'], $absolute_upload_path)) {
                // Gérer l'erreur de téléchargement du fichier
                header('Location: /admin/moniteurs/new?error=failed_upload');
                exit();
            }
        }

        // Créez le moniteur avec le chemin de la photo ou l'image par défaut
        $this->membreBureauModel->createOneMembreBureau($nom, $prenom, $mail, $telephone, $relative_upload_path, $role);
        header('Location: /admin/bureau/new?success=create');
        exit();
    }
}
