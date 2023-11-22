<?php

class MoniteurController
{
    private $moniteurModel;

    public function __construct($moniteurModel)
    {
        $this->moniteurModel = $moniteurModel;
    }

    public function showListeMoniteurs()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $moniteurs = $this->moniteurModel->getAllMoniteursSortByNom();
        require '../src/view/listMoniteurs.php';
    }

    public function showCreateMoniteurForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/create-moniteur.php';
    }

    public function deleteMoniteur()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $moniteurToDelete = $this->moniteurModel->getOneMoniteur($id);

        $deleted = $this->moniteurModel->deleteOneMoniteur($id);

        $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $moniteurToDelete['photo'];
        if (file_exists($absolutePath)) {
            unlink($absolutePath);
        }

        if ($deleted) {
            header('Location: /admin/moniteurs?success=delete');
        } else {
            header('Location: /admin/moniteurs?error=failed_delete');
        }
    }

    public function processCreateMoniteur()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $niveau = filter_input(INPUT_POST, 'niveau', FILTER_SANITIZE_SPECIAL_CHARS);

        // pour l'instant vide car pas dans le formulaire de création
        $mail = "";
        $telephone = "";

        // Initialisez la variable $relative_upload_path avec une image par défaut ou vide
        //$relative_upload_path = "/images/uploads/moniteurs/entraineur.png"; // Chemin vers une image par défaut
        $relative_upload_path = ""; // Chemin vers une image par défaut

        // Vérifiez si un fichier photo a été téléchargé
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['photo'];
            $basename = bin2hex(random_bytes(8));
            $upload_name = $basename . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

            // Chemin relatif à partir du dossier public où les images seront stockées
            $relative_upload_path = "/images/uploads/moniteurs/" . $upload_name;

            // Chemin absolu sur le serveur pour enregistrer le fichier
            $absolute_upload_path = $_SERVER['DOCUMENT_ROOT'] . $relative_upload_path;

            if (!move_uploaded_file($photo['tmp_name'], $absolute_upload_path)) {
                // Gérer l'erreur de téléchargement du fichier
                header('Location: /admin/moniteurs/new?error=failed_upload');
                exit();
            }
        }

        // Créez le moniteur avec le chemin de la photo ou l'image par défaut
        $this->moniteurModel->createOneMoniteur($nom, $prenom, $mail, $telephone, $relative_upload_path, $niveau);
        header('Location: /admin/moniteurs/new?success=create');
        exit();
    }
}
