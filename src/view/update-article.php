<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/update-article.css">

</head>


<body>

    <div class="container update-article-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'update') echo "Modification de l'article réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_update') echo "Erreur lors de la modification de l'article.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/articles"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Modifier un article</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/process-update-article" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>" />

            <h4 class="titre-section-form">Infos</h5>
                <div class="col-md-8">
                    <label for="titre" class="form-label">Titre<span class="champ-obligatoire">*</span></label>
                    <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $article['titre']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date<span class="champ-obligatoire">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" required value="<?php echo $article['date']; ?>">
                </div>

                <h4 class="titre-section-form">Contenu</h4>
                <div class="col-md-12">
                    <label for="contenu" class="form-label">Texte<span class="champ-obligatoire">*</span></label>
                    <textarea rows="8" class="form-control" id="contenu" name="contenu" required><?php echo html_entity_decode($article['contenu']); ?></textarea>
                </div>

                <div class="col-12">
                    <button type="submit" id="submitBtn" class="btn btn-success">Mettre à jour</button>
                    <a href="/admin/articles"><button class="btn btn-danger" type="button">Annuler</button></a>
                </div>

        </form>
    </div>


</body>