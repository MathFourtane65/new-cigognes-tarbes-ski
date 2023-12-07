<?php

require_once '../src/utils/EmailSender.php';

class AdminLoginController
{
    private $adminModel;

    public function __construct($adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function showLoginForm()
    {
        require '../src/view/adminLoginForm.php';
    }

    public function processLogin()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (empty($username) || empty($password)) {
            header('Location: /connexion-admin?error=missing_fields');
            exit();
        }

        $authenticated = $this->adminModel->authenticate($username, $password);

        if ($authenticated) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: /admin');
        } else {
            header('Location: /connexion-admin?error=invalid_credentials');
        }
    }

    public function showDashboardAdmin()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/adminDashboard.php';
    }

    public function logout()
    {
        unset($_SESSION['admin_logged_in']); // Retirez l'administrateur de la session.
        header('Location: /connexion-admin'); // Redirigez-le vers la page de connexion.
    }

    public function showAllAdministateurs()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $administrateurs = $this->adminModel->getAllAdministrateurs();
        require '../src/view/listAdministrateurs.php';
    }

    public function showCreateAdministateurForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/create-administrateur.php';
    }

    public function processCreateAdministateur()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $mail_associe = filter_input(INPUT_POST, 'mail_associe', FILTER_SANITIZE_SPECIAL_CHARS);

        // Générer un mot de passe aléatoire de 10 chiffres
        $password = str_pad(mt_rand(0, 99999999), 10, '0', STR_PAD_LEFT);


        $created = $this->adminModel->addAdministrateur($username, $password, $mail_associe);

        if ($created) {

            // Préparer l'email
            $to = $mail_associe; // Email du licencié
            $subject = "Identifiants ADMIN CIGOGNES TARBES SKI";
            $message = "Bonjour " . $username . ",\n\nVoici vos identifiants pour accéder à votre espace ADMINISTRATEUR :\nIdentifiant: " . $username . "\nMot de passe: " . $password . "\n\nCordialement,\nL'équipe du Club des Cigognes.";
            $from = "contact@cigognes-tarbes-ski.fr";
            $fromName = "Cigognes Tarbes Ski";
            // Envoyer l'email
            EmailSender::sendMail($to, $subject, $message, $from, $fromName);


            header('Location: /admin/administrateurs/new?success=create');
        } else {
            header('Location: /admin/administrateurs/new?error=failed_create');
        }
    }

    public function deleteAdministrateur()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleted = $this->adminModel->deleteAdministrateur($id);

        if ($deleted) {
            header('Location: /admin/administrateurs?success=delete');
        } else {
            header('Location: /admin/administrateurs?error=failed_delete');
        }
    }
}
