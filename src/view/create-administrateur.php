<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/create-administrateur.css">

</head>

<body>

    <div class="container create-administrateur-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'create') echo "Création de l'administrateur réussie. Le mail renseigné vient de recevoir les identifiants de connexion.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_create') echo "Erreur lors de la création de l'administrateur.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/administrateurs"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Enregistrer un Administrateur</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/create-administrateur-process" method="post">
            <div class="col-md-8">
                <label for="username" class="form-label">Identifiant<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="col-md-8">
                <label for="mail_associe" class="form-label">Mail associé (recevra les identifiants)<span class="champ-obligatoire">*</span></label>
                <input type="email" class="form-control" id="mail_associe" name="mail_associe" required>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="/admin/administrateurs"><button class="btn btn-danger" type="button">Annuler</button></a>
            </div>
        </form>
    </div>
</body>