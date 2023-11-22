<?php

require_once '../src/utils/EmailSender.php';

class LicencieController
{
    private $licencieModel;
    private $relationsComptesModel;

    public function __construct($licencieModel, $relationsComptesModel)
    {
        $this->licencieModel = $licencieModel;
        $this->relationsComptesModel = $relationsComptesModel;
    }

    public function showLoginForm()
    {
        require '../src/view/licencieLoginForm.php';
    }

    public function showListeLicencies()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $licencies = $this->licencieModel->getAllLicenciesSortedByLastName();
        require '../src/view/listLicencies.php';
    }

    public function showCreateLicencieForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $licencies = $this->licencieModel->getAllLicenciesSortedByLastName();
        require '../src/view/create-licencie.php';
    }

    // Dans AdminController.php

    public function processCreateLicencie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération des données du formulaire avec validation
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
        $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_SPECIAL_CHARS);
        $code_postal = filter_input(INPUT_POST, 'code_postal', FILTER_SANITIZE_SPECIAL_CHARS);
        $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_SPECIAL_CHARS);
        $niveau = filter_input(INPUT_POST, 'niveau', FILTER_SANITIZE_SPECIAL_CHARS); // Assurez-vous d'avoir un input 'niveau' dans votre formulaire

        // Générer un identifiant unique pour le licencié
        $identifiant = strtolower(str_replace(array(' ', 'á', 'é', 'í', 'ó', 'ú', 'â', 'ê', 'î', 'ô', 'û', 'à', 'è', 'ì', 'ò', 'ù', 'ä', 'ë', 'ï', 'ö', 'ü', 'ÿ', 'ç', 'œ', 'æ'), array('.', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'y', 'c', 'oe', 'ae'), htmlspecialchars($prenom) . '.' . htmlspecialchars($nom)));

        // Générer un mot de passe aléatoire de 10 caractères
        // $password = bin2hex(openssl_random_pseudo_bytes(5));

        // Générer un mot de passe aléatoire de 8 chiffres
        $password = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        // Insertion du licencié avec le modèle Licencie
        $created = $this->licencieModel->addLicencie($nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville, $niveau, $password, $identifiant);

        if ($created) {

            $newLicencieId = $this->licencieModel->getLastInsertId();
            $idParent = filter_input(INPUT_POST, 'id_parent', FILTER_SANITIZE_NUMBER_INT);

            // Vérifiez si un responsable a été sélectionné avant de tenter de créer la relation
            if (!empty($idParent)) {
                // Si un parent est sélectionné, créez la relation
                $this->relationsComptesModel->addRelation($idParent, $newLicencieId);
            }

            // Préparer l'email
            $to = $mail; // Email du licencié
            $subject = "Identifiants CIGOGNES TARBES SKI";
            $message = "Bonjour " . $prenom . ",\n\nVoici vos identifiants pour accéder à votre espace licencié :\nIdentifiant: " . $identifiant . "\nMot de passe: " . $password . "\n\nSelon votre situation, des comptes dits 'enfants' seront rattachés à votre compte.\n\nCordialement,\nL'équipe du Club des Cigognes.";
            $from = "contact@cigognes-tarbes-ski.fr";
            $fromName = "Cigognes Tarbes Ski";
            // Envoyer l'email
            EmailSender::sendMail($to, $subject, $message, $from, $fromName);


            header('Location: /admin/new-licencie?success=create');
        } else {
            header('Location: /admin/new-licencie?error=failed_create');
        }
        // echo $identifiant;
        // echo $password;
    }

    public function deleteLicencie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleted = $this->licencieModel->deleteLicencie($id);

        if ($deleted) {
            header('Location: /admin/licencies?success=delete');
        } else {
            header('Location: /admin/licencies?error=failed_delete');
        }
    }


    public function processLogin()
    {
        $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        // if (empty($username) || empty($password)) {
        //     header('Location: /connexion-licencie?error=missing_fields');
        //     exit();
        // }

        $user = $this->licencieModel->authenticate($identifiant, $password);

        if ($user) {
            $_SESSION['licencie_logged_in'] = true;
            $_SESSION['licencie_id'] = $user['id'];
            header('Location: /licencie');
        } else {
            header('Location: /connexion-licencie?error=invalid_credentials');
        }
    }

    public function logout()
    {
        unset($_SESSION['licencie_logged_in']); // Retirez le licencié de la session.
        header('Location: /connexion-licencie'); // Redirigez-le vers la page de connexion.
    }

    public function showDashboardLicencie()
    {
        if (!isset($_SESSION['licencie_logged_in']) || $_SESSION['licencie_logged_in'] !== true) {
            header("Location: /connexion-licencie");
            exit();
        }
        require '../src/view/licencieDashboard.php';
    }


    public function showUpdateLicencieByAdminForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $licencie = $this->licencieModel->getLicencie($id);
        if (!$licencie) {
            // Gérer l'erreur si le licencié n'existe pas
            header("Location: /admin/licencies?error=not_found");
            exit();
        }
        require '../src/view/update-licencie.php';
    }

    public function updateLicencieByAdmin()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération des données du formulaire avec validation
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
        $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_SPECIAL_CHARS);
        $code_postal = filter_input(INPUT_POST, 'code_postal', FILTER_SANITIZE_SPECIAL_CHARS);
        $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_SPECIAL_CHARS);

        $updated = $this->licencieModel->updateLicencieByAdmin($id, $nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville);

        if ($updated) {
            header('Location: /admin/update-licencie?id=' . $id . '&success=update');
        } else {
            header('Location: /admin/update-licencie?id=' . $id . '&error=failed_update');
        }
    }

    public function showDetailsLicencieByAdmin()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $licencie = $this->licencieModel->getLicencie($id);
        $enfants = $this->relationsComptesModel->getChildrenByParentId($id);
        $parents = $this->relationsComptesModel->getParentsByChildId($id);
        if (!$licencie) {
            // Gérer l'erreur si le licencié n'existe pas
            header("Location: /admin/licencies?error=not_found");
            exit();
        }
        require '../src/view/detail-licencie.php';
    }

    public function showMesInfosLicencie()
    {
        if (!isset($_SESSION['licencie_logged_in']) || $_SESSION['licencie_logged_in'] !== true) {
            header("Location: /connexion-licencie");
            exit();
        }
        $id = $_SESSION['licencie_id'];
        $licencie = $this->licencieModel->getLicencie($id);
        $enfants = $this->relationsComptesModel->getChildrenByParentId($id);
        $parents = $this->relationsComptesModel->getParentsByChildId($id);
        if (!$licencie) {
           // Gérer l'erreur si le licencié n'existe pas
           header("Location: /licencie?error=not_found");
           exit();
        }
        require '../src/view/mesInfosLicencie.php';
    }
}
