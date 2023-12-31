<?php

// require_once '../src/utils/EmailSender.php';

class SiteVitrinePageController
{
    private $actualitesFlashModel;
    private $moniteurModel;
    private $membreBureauModel;
    private $evenementModel;

    public function __construct($actualitesFlashModel, $moniteurModel, $membreBureauModel, $evenementModel)
    {
        $this->actualitesFlashModel = $actualitesFlashModel;
        $this->moniteurModel = $moniteurModel;
        $this->membreBureauModel = $membreBureauModel;
        $this->evenementModel = $evenementModel;
    }

    public function showBureauPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();
        $membresBureau = $this->membreBureauModel->getAllMembresBureauSortByNom();
        require '../src/view/bureauPage.php';
    }

    public function showMentionsLegalesPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/mentionsLegalesPage.php';
    }

    public function showDossierInscriptionPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/dossierInscriptionPage.php';
    }

    public function showContactPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/contactPage.php';
    }

    public function showPhototequePage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/phototequePage.php';
    }

    //public function showActualitesPage()
    //{
    //    require '../src/view/actualitesPage.php';
    //}

    public function showCalendrierPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();
        $evenements = $this->evenementModel->getAllEvenementsSortByDate();
        require '../src/view/calendrierPage.php';
    }

    public function showMoniteursPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();
        $moniteurs = $this->moniteurModel->getAllMoniteursSortByNom();

        require '../src/view/moniteursPage.php';
    }

    public function showPartenairesPage()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/partenairesPage.php';
    }

    public function show404Page()
    {
        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/404Page.php';
    }
}
