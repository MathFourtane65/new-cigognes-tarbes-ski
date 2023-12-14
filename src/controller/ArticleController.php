<?php
class ArticleController
{
    private $articleModel;
    private $imageModel;
    private $associationArticlesImagesModel;
    private $actualitesFlashModel;

    public function __construct($articleModel, $imageModel, $associationArticlesImagesModel, $actualitesFlashModel)
    {
        $this->articleModel = $articleModel;
        $this->imageModel = $imageModel;
        $this->associationArticlesImagesModel = $associationArticlesImagesModel;
        $this->actualitesFlashModel = $actualitesFlashModel;
    }

    public function showListeArticles()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $articles = $this->articleModel->getAllArticles();
        foreach ($articles as $article) {
            $imageCount = $this->associationArticlesImagesModel->getAllAssociationsByArticle($article['id']);
            // Afficher le $imageCount avec les autres détails de l'article
        }
        require '../src/view/listArticles.php';
    }

    public function showCreateArticleForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        require '../src/view/create-article.php';
    }

    public function processCreateArticle()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération et validation des données de l'article
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);

        // Création de l'article
        $created = $this->articleModel->createOneArticle($titre, $date, $contenu);
        if ($created) {
            $articleId = $this->articleModel->getLastInsertId();

            // Vérifiez si les fichiers sont correctement téléchargés avant de les enregistrer
            if (isset($_FILES['images']) && $_FILES['images']['error'][0] != UPLOAD_ERR_NO_FILE) {
                foreach ($_FILES['images']['error'] as $error) {
                    if ($error != UPLOAD_ERR_OK) {
                        // Gérer l'erreur ici
                        header('Location: /admin/articles/new?error=failed_upload');
                        exit();
                    }
                }
            }

            // Gestion de l'upload des images
            if (isset($_FILES['images'])) {
                $images = $_FILES['images'];
                $uploadedImages = [];
                for ($i = 0; $i < count($images['name']); $i++) {
                    if ($images['error'][$i] === UPLOAD_ERR_OK) {
                        $tmp_name = $images['tmp_name'][$i];
                        // Création d'un nom unique pour l'image pour éviter les conflits
                        $basename = bin2hex(random_bytes(8));
                        $upload_name = $basename . '.' . pathinfo($images['name'][$i], PATHINFO_EXTENSION);
                        // $upload_path = '/path/to/your/uploads/directory/' . $upload_name;
                        // if (move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $upload_path)) {
                        //     // Enregistrement de l'image dans la base de données
                        //     $this->imageModel->createOneImage($upload_path);
                        //     $uploadedImages[] = $this->imageModel->getLastInsertId();
                        // }

                        // Chemin relatif à partir du dossier public où les images seront stockées
                        $relative_upload_path = "/images/uploads/articles/" . $upload_name;

                        // Chemin absolu sur le serveur pour enregistrer le fichier
                        $absolute_upload_path = $_SERVER['DOCUMENT_ROOT'] . $relative_upload_path;

                        if (move_uploaded_file($tmp_name, $absolute_upload_path)) {
                            // Enregistrement de l'image dans la base de données avec le chemin relatif
                            $this->imageModel->createOneImage($relative_upload_path);
                            $uploadedImages[] = $this->imageModel->getLastInsertId();
                        }
                    }
                }

                // Création des associations entre l'article et les images
                // $articleId = $this->articleModel->getLastInsertId();
                foreach ($uploadedImages as $imageId) {
                    $this->associationArticlesImagesModel->createOneAssociation($articleId, $imageId);
                }
            }

            header('Location: /admin/articles?success=create');
        } else {
            header('Location: /admin/articles/new?error=failed_create');
        }
    }


    public function deleteArticle()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Appeler la méthode du modèle pour supprimer l'article et obtenir les chemins des images
        $imagePaths = $this->articleModel->deleteArticleWithImages($id);

        // Supprimer les fichiers images du serveur
        foreach ($imagePaths as $path) {
            $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $path;
            if (file_exists($absolutePath)) {
                unlink($absolutePath);
            }
        }

        // Rediriger avec un message de succès
        header('Location: /admin/articles?success=delete');
    }

    // Dans ArticleController.php

    // Remplacez la méthode existante ou ajoutez celle-ci si elle n'existe pas
    public function showArticlesWithPagination($page)
    {
        $limit = 6; // Le nombre d'articles par page
        $offset = ($page - 1) * $limit;
        $totalArticles = count($this->articleModel->getAllArticles());
        $totalPages = ceil($totalArticles / $limit);

        $articles = $this->articleModel->getArticlesWithPagination($limit, $offset);
        // Ajoutez ici la logique pour obtenir l'image principale de chaque article si nécessaire

        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();

        require '../src/view/actualitesPage.php'; // Assurez-vous que le chemin est correct
    }

    public function showArticleDetails($articleId)
    {
        $article = $this->articleModel->getArticleByIdWithImages($articleId);

        if (!$article) {
            // Gérer l'erreur si l'article n'existe pas
            header('HTTP/1.0 404 Not Found');
            echo "Article non trouvé";
            return;
        }

        $lastActualitesFlash = $this->actualitesFlashModel->getLashActualitesFlash();


        require '../src/view/actualitesDetailsPage.php';
    }

    public function showUpdateArticleForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $article = $this->articleModel->getArticleByIdWithImages($id);

        if (!$article) {
            // Gérer l'erreur si l'article n'existe pas
            return;
        }

        require '../src/view/update-article.php';
    }

    public function processUpdateArticle()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        // Récupération des données du formulaire avec validation
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_SPECIAL_CHARS);

        $updated = $this->articleModel->updateOne($id, $titre, $date, $contenu);

        if ($updated) {
            header('Location: /admin/articles/update?id=' . $id . '&success=update');
        } else {
            header('Location: /admin/articles/update?id=' . $id . '&error=failed_update');
        }
    }


}
