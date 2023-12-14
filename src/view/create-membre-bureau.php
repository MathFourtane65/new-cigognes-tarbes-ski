<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/create-membre-bureau.css">

</head>


<body>

    <div class="container create-membre-bureau-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'create') echo "Création du moniteur réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_create') echo "Erreur lors de la création du moniteur.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/bureau"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Enregistrer un membre du bureau (à afficher sur le site internet)</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/create-membre-bureau-process" method="post" enctype="multipart/form-data">
            
        <div class="alert alert-primary" role="alert">
                Seuls les informations renseignées apparaîtront sur le site internet.
            </div>

            <h5 class="titre-section-form">Infos</h5>

            <div class="col-md-5">
                <label for="nom" class="form-label">Nom<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="col-md-5">
                <label for="prenom" class="form-label">Prénom<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="col-md-5">
                <label for="mail" class="form-label">Mail</label>
                <input type="mail" class="form-control" id="mail" name="mail">
            </div>
            <div class="col-md-5">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone">
            </div>

            <div class="col-md-6">
                <label for="role" class="form-label">Rôle</label>
                <input type="text" class="form-control" id="role" name="role">
            </div>

            <div class="col-md-6">
                <label for="photo" class="form-label">Photo <span class="consigne-formulaire">(image par défaut si aucune photo est choisie)</span></label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="/admin/bureau"><button class="btn btn-danger" type="button">Annuler</button></a>
            </div>
        </form>
    </div>


</body>