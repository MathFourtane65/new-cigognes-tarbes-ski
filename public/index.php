<?php

// A commenter lors de mise en production
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

// Configuration et Connexion à la base de données
include '../config/database.php';
include '../src/model/Administrateur.php';
include '../src/model/Licencie.php';
include '../src/model/Sortie.php';
include '../src/model/RelationsComptes.php';
include '../src/controller/AdminLoginController.php';
include '../src/controller/LicencieController.php';
include '../src/controller/SortieController.php';
include '../src/controller/RelationsComptesController.php';
include '../src/controller/HomePageController.php';
include '../src/controller/BureauPageController.php';

$adminModel = new Administrateur($db);
$licencieModel = new Licencie($db);
$sortieModel = new Sortie($db);
$relationsComptes = new RelationsComptes($db);
$adminLoginController = new AdminLoginController($adminModel);
$licencieController = new LicencieController($licencieModel, $relationsComptes);
$sortieController = new SortieController($sortieModel);
$relationsComptesController = new RelationsComptesController($relationsComptes, $licencieModel);
$homePageController = new HomePageController();
$bureauPageController = new BureauPageController();

//Système de routage
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request_uri) {

        // ---------------------------- SITE VITRINE ----------------------------
    case '/':
        $homePageController->showHomePage();
        break;

    case '/bureau':
        $bureauPageController->showBureauPage();
        break;

    case '/contact':
        echo "Page de contact";
        break;

    case '/mentions-legales':
        $bureauPageController->showMentionsLegalesPage();
        break;


        // ---------------------------- ESPACE LICENCIE ----------------------------
    case '/connexion-licencie':
        $licencieController->showLoginForm();
        break;

    case '/login-licencie-process':
        $licencieController->processLogin();
        break;

    case '/logout-licencie':
        $licencieController->logout();
        break;

    case '/licencie':
        $licencieController->showDashboardLicencie();
        break;


        // ---------------------------- ESPACE ADMIN -------------------------------
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

    case '/admin/licencies/details':
        $licencieController->showDetailsLicencieByAdmin();
        break;


    case '/admin/relations-comptes':
        $relationsComptesController->showListeRelations();
        break;

    case '/admin/relations-comptes/new':
        $relationsComptesController->showCreateRelationForm();
        break;

    case '/create-relations-comptes-process':
        $relationsComptesController->processAddRelations();
        break;

    case '/delete-relations-comptes-process':
        $relationsComptesController->deleteRelation();
        break;



    case '/admin/sorties':
        $sortieController->showListeSorties();
        break;

    case '/admin/new-sortie':
        $sortieController->showCreateSortieForm();
        break;

    case '/create-sortie-process':
        $sortieController->processCreateSortie();
        break;





    case '/logout-admin':
        $adminLoginController->logout();
        break;
















    default:
        header('HTTP/1.0 404 Not Found');
        echo "404 Not Found";
        break;
}
