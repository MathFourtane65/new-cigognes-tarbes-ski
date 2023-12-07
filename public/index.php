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
include '../src/model/Article.php';
include '../src/model/Image.php';
include '../src/model/AssociationArticlesImages.php';
include '../src/model/ActualitesFlash.php';
include '../src/model/Moniteur.php';
include '../src/model/MembreBureau.php';
include '../src/model/EvenementModel.php';
include '../src/model/LicencieImporte.php';
include '../src/model/Inscription.php';

include '../src/controller/AdminLoginController.php';
include '../src/controller/LicencieController.php';
include '../src/controller/SortieController.php';
include '../src/controller/RelationsComptesController.php';
include '../src/controller/ArticleController.php';
include '../src/controller/ImageController.php';
include '../src/controller/AssociationArticlesImagesController.php';
include '../src/controller/ActualitesFlashController.php';
include '../src/controller/MoniteurController.php';
include '../src/controller/MembreBureauController.php';
include '../src/controller/EvenementController.php';
include '../src/controller/LicencieImporteController.php';
include '../src/controller/InscriptionController.php';

include '../src/controller/HomePageController.php';
include '../src/controller/SiteVitrinePageController.php';

$adminModel = new Administrateur($db);
$licencieModel = new Licencie($db);
$sortieModel = new Sortie($db);
$relationsComptes = new RelationsComptes($db);
$articleModel = new Article($db);
$imageModel = new Image($db);
$associationArticlesImagesModel = new AssociationArticlesImages($db);
$actualitesFlashModel = new ActualitesFlash($db);
$moniteurModel = new Moniteur($db);
$membreBureauModel = new MembreBureau($db);
$evenementModel = new EvenementModel($db);
$licencieImporteModel = new LicencieImporte($db);
$inscriptionModel = new Inscription($db);

$adminLoginController = new AdminLoginController($adminModel);
$licencieController = new LicencieController($licencieModel, $relationsComptes, $sortieModel, $inscriptionModel);
$sortieController = new SortieController($sortieModel);
$relationsComptesController = new RelationsComptesController($relationsComptes, $licencieModel);
$articleController = new ArticleController($articleModel, $imageModel, $associationArticlesImagesModel, $actualitesFlashModel);
$imageController = new ImageController($imageModel);
$associationArticlesImagesController = new AssociationArticlesImagesController($associationArticlesImagesModel);
$actualitesFlashController = new ActualitesFlashController($actualitesFlashModel);
$moniteurController = new MoniteurController($moniteurModel);
$membreBureauController = new MembreBureauController($membreBureauModel);
$evenementController = new EvenementController($evenementModel);
$licencieImporteController = new LicencieImporteController($licencieImporteModel, $licencieModel);
$inscriptionController = new InscriptionController($inscriptionModel, $licencieModel, $relationsComptes, $sortieModel);

$homePageController = new HomePageController($articleModel, $actualitesFlashModel);
$siteVitrinePageController = new SiteVitrinePageController($actualitesFlashModel, $moniteurModel, $membreBureauModel, $evenementModel);

//Système de routage
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request_uri) {

        // ---------------------------- SITE VITRINE ----------------------------
    case '/':
        $homePageController->showHomePage();
        break;

    case '/bureau':
        $siteVitrinePageController->showBureauPage();
        break;

    case '/contact':
        $siteVitrinePageController->showContactPage();
        break;

    case '/mentions-legales':
        $siteVitrinePageController->showMentionsLegalesPage();
        break;

    case '/dossier-inscription':
        $siteVitrinePageController->showDossierInscriptionPage();
        break;

    case '/phototeque':
        $siteVitrinePageController->showPhototequePage();
        break;

    case '/actualites':
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articleController->showArticlesWithPagination($page);
        break;

    case (preg_match('/\/actualites\/details\/(\d+)/', $request_uri, $matches) ? true : false):
        $articleId = $matches[1];
        $articleController->showArticleDetails($articleId);
        break;

    case '/calendrier':
        $siteVitrinePageController->showCalendrierPage();
        break;

    case '/moniteurs':
        $siteVitrinePageController->showMoniteursPage();
        break;

        // case '/partenaires':
        //     $siteVitrinePageController->showPartenairesPage();
        //     break;



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

    case '/licencie/mes-infos':
        $licencieController->showMesInfosLicencie();
        break;

    case '/licencie/inscription-sortie':
        $licencieController->showInscriptionSortieLicencie();
        break;

    case '/licencie/inscription-sortie/details':
        $licencieController->showInscriptionsSortieLicencieDetails();
        break;

    case '/process-inscription-sortie-licencie':
        $inscriptionController->processInscriptionForm();
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

    case '/admin/licencies/import':
        $licencieImporteController->showImportLicenciesForm();
        break;

    case '/process-import-licencies':
        $licencieImporteController->processImportLicencies();
        break;

    case '/admin/licencies/importes':
        $licencieImporteController->showListeLicenciesImportes();
        break;

    case '/valider-import-licencie-process':
        $licencieImporteController->validerImportLicencies();
        break;

    case '/reset-creditentials-process':
        $licencieController->resetAndSendCreditentialsByAdmin();
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

    case '/admin/sorties/inscriptions':
        $inscriptionController->showListInscriptionsBySortie();
        break;

    case '/create-sortie-process':
        $sortieController->processCreateSortie();
        break;


    case '/admin/articles':
        $articleController->showListeArticles();
        break;

    case '/admin/articles/new':
        $articleController->showCreateArticleForm();
        break;

    case '/process-create-article':
        $articleController->processCreateArticle();
        break;

    case '/delete-article-process':
        $articleController->deleteArticle();
        break;


    case '/admin/actualites-flash':
        $actualitesFlashController->showListeActualitesFlash();
        break;

    case '/admin/actualites-flash/update':
        $actualitesFlashController->showUpdateActualitesFlash();
        break;

    case '/update-actualites-flash-process':
        $actualitesFlashController->updateActualitesFlash();
        break;

    case '/admin/moniteurs':
        $moniteurController->showListeMoniteurs();
        break;

    case '/admin/moniteurs/new':
        $moniteurController->showCreateMoniteurForm();
        break;

    case '/create-moniteur-process':
        $moniteurController->processCreateMoniteur();
        break;

    case '/delete-moniteur-process':
        $moniteurController->deleteMoniteur();
        break;

    case '/admin/bureau':
        $membreBureauController->showListeMembresBureaux();
        break;

    case '/admin/bureau/new':
        $membreBureauController->showCreateMembreBureauForm();
        break;

    case '/create-membre-bureau-process':
        $membreBureauController->processCreateMembreBureau();
        break;

    case '/delete-membre-bureau-process':
        $membreBureauController->deleteMembreBureau();
        break;

    case '/admin/evenements':
        $evenementController->showListeEvenements();
        break;

    case '/admin/evenements/new':
        $evenementController->showCreateEvenementForm();
        break;

    case '/create-evenement-process':
        $evenementController->processCreateEvenement();
        break;

    case '/delete-evenement-process':
        $evenementController->deleteEvenement();
        break;

    case '/admin/administrateurs':
        $adminLoginController->showAllAdministateurs();
        break;

    case '/admin/administrateurs/new':
        $adminLoginController->showCreateAdministateurForm();
        break;

    case '/create-administrateur-process':
        $adminLoginController->processCreateAdministateur();
        break;

    case '/delete-administrateur-process':
        $adminLoginController->deleteAdministrateur();
        break;









    case '/logout-admin':
        $adminLoginController->logout();
        break;















    default:
        header('HTTP/1.0 404 Not Found');
        $siteVitrinePageController->show404Page();
        //echo "404 Not Found";
        break;
}
