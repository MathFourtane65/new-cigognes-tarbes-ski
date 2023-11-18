<?php 

// require_once '../src/utils/EmailSender.php';

class SiteVitrinePageController {

    public function showBureauPage() {
        require '../src/view/bureauPage.php';
    }

    public function showMentionsLegalesPage() {
        require '../src/view/mentionsLegalesPage.php';
    }

    public function showDossierInscriptionPage() {
        require '../src/view/dossierInscriptionPage.php';
    }

    public function showContactPage() {
        require '../src/view/contactPage.php';
    }

    public function showPhototequePage() {
        require '../src/view/phototequePage.php';
    }
}

?>
