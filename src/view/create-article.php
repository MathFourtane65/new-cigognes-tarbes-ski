<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/create-article.css">

</head>


<body>

    <div class="container create-article-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'create') echo "Création de l'article réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_create') echo "Erreur lors de la création de l'article'.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="my-0">Enregistrer un Article</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/process-create-article" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <h4 class="titre-section-form">Infos</h5>
                <div class="col-md-8">
                    <label for="titre" class="form-label">Titre<span class="champ-obligatoire">*</span></label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date<span class="champ-obligatoire">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" required value="<?php echo date('Y-m-d'); ?>">
                </div>

                <h4 class="titre-section-form">Contenu</h4>
                <div class="col-md-12">
                    <label for="contenu" class="form-label">Texte<span class="champ-obligatoire">*</span></label>
                    <textarea class="form-control" id="contenu" name="contenu" required></textarea>
                </div>
                <div class="col-md-12">
                    <label for="images" class="form-label">Images<span class="champ-obligatoire"> ( 15 fichiers maximum et taille total inférieur à 10MB)</span></label>
                    <input type="file" class="form-control-file" id="images" name="images[]" accept="image/png, image/jpeg" multiple>
                </div>

                <div class="col-12">
                    <button type="submit" id="submitBtn" class="btn btn-success">Enregistrer l'article</button>
                    <a href="/admin/articles"><button class="btn btn-danger" type="button">Annuler / Retour</button></a>
                </div>

        </form>
    </div>

    <script>
        function checkFileCount() {
            var files = document.getElementById('images').files;
            var maxFiles = 15; // Nombre maximum de fichiers autorisés

            if (files.length > maxFiles) {
                alert("Vous ne pouvez télécharger que " + maxFiles + " fichiers au maximum.");
                return false;
            }

            return true;
        }

        function checkTotalFileSize() {
            var files = document.getElementById('images').files;
            var maxSize = 10 * 1024 * 1024; // Taille maximale en octets (10 MB dans cet exemple)
            var totalSize = 0;

            for (var i = 0; i < files.length; i++) {
                totalSize += files[i].size;
            }

            if (totalSize > maxSize) {
                alert("La taille totale des fichiers ne doit pas dépasser " + (maxSize / 1024 / 1024) + " MB.");
                return false;
            }

            return true;
        }


        function validateForm() {
            // Exécuter les deux validations
            return checkFileCount() && checkTotalFileSize();
        }
    </script>
</body>