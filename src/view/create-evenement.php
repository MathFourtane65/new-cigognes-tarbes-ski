<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/create-evenement.css">

</head>


<body>

    <div class="container create-evenement-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'create') echo "Création de l'évènement réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_create') echo "Erreur lors de la création de l'évènement.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/evenements"><button title="Retour à la liste des évènements" class="btn btn-dark my-0" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3 class="my-0">Enregistrer un évènement (à afficher sur le site internet)</h3>
            <div>
                <p class="consigne-formulaire my-0">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/create-evenement-process" method="post" enctype="multipart/form-data">
            <h5 class="titre-section-form">Infos</h5>
            <div class="col-md-3">
                <label for="date" class="form-label">Date<span class="champ-obligatoire">*</span></label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="col-md-4">
                <label for="nom" class="form-label">Nom de l'évènement<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="col-md-4">
                <label for="lieu" class="form-label">Lieu<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="/admin/evenements"><button class="btn btn-danger" type="button">Annuler</button></a>
            </div>
        </form>
    </div>


</body>