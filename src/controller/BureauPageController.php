<?php 

// require_once '../src/utils/EmailSender.php';

class BureauPageController {

    public function showBureauPage() {
        require '../src/view/bureauPage.php';
    }

    public function showMentionsLegalesPage() {
        require '../src/view/mentionsLegalesPage.php';
    }
}

?>
