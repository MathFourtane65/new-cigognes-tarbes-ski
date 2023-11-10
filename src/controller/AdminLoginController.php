<?php 
class AdminLoginController {
    private $adminModel;

    public function __construct($adminModel) {
        $this->adminModel = $adminModel;
    }

    public function showLoginForm() {
        require '../src/view/adminLoginForm.php';
    }
    
    public function processLogin() {
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

    public function showDashboardAdmin(){
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/adminDashboard.php';
    }

    public function logout() {
        unset($_SESSION['admin_logged_in']); // Retirez l'administrateur de la session.
        header('Location: /connexion-admin'); // Redirigez-le vers la page de connexion.
    }



}
?>
