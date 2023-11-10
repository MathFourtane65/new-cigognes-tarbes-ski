<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

// Configuration et Connexion à la base de données
include '../config/database.php';
include '../src/model/Administrateur.php';
include '../src/model/Licencie.php';
include '../src/controller/AdminLoginController.php';
include '../src/controller/LicencieController.php';
include '../src/controller/HomePageController.php';

$adminModel = new Administrateur($db);
$licencieModel = new Licencie($db);
$adminLoginController = new AdminLoginController($adminModel);
$licencieController = new LicencieController($licencieModel);
$homePageController = new HomePageController();

//Système de routage
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request_uri) {
    case '/':
        $homePageController->showHomePage();
        break;

    case '/contact':
        echo "Page de contact";
        break;

    case '/connexion-licencie':
        $licencieController->showLoginForm();
        break;

    case '/connexion-admin':
        $adminLoginController->showLoginForm();
        break;

    case '/login-admin-process':
        $adminLoginController->processLogin();
        break;

    case '/admin':
        $adminLoginController->showDashboardAdmin();
        break;

    case '/admin/licencies':
        $licencieController->showListeLicencies();
        break;

    case '/admin/new-licencie':
        $licencieController->showCreateLicencieForm();
        break;

    case '/create-licencie-process':
        $licencieController->processCreateLicencie();
        break;

    case '/delete-licencie-process':
        $licencieController->deleteLicencie();
        break;

    case '/admin/update-licencie':
        $licencieController->showUpdateLicencieByAdminForm();
        break;

    case '/update-licencie-process-admin':
        $licencieController->updateLicencieByAdmin();
        break;

    case '/logout-admin':
        $adminLoginController->logout();
        break;


    case '/licencie':
        $licencieController->showDashboardLicencie();
        break;

    case '/login-licencie-process':
        $licencieController->processLogin();
        break;

    case '/logout-licencie':
        $licencieController->logout();
        break;


    default:
        header('HTTP/1.0 404 Not Found');
        echo "404 Not Found";
        break;
}
