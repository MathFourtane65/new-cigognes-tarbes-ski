<?php 

// require_once '../src/utils/EmailSender.php';

class HomePageController {

    private $articleModel;
    private $actualitesFlashModel;

    public function __construct($articleModel, $actualitesFlashModel) {
        $this->articleModel = $articleModel;
        $this->actualitesFlashModel = $actualitesFlashModel;
    }

    public function showHomePage() {

        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();
        $lastArticle = $this->articleModel->getLastArticleWithImages();
        require '../src/view/homePage.php';
    }


}

?>
