<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/create-relations-comptes.css">

</head>


<body>

    <div class="container create-relations-comptes-form">
    
    <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'create') echo "Création de(s) relation(s) réussie(s).";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

            <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_create') echo "Erreur lors de la création de(s) relation(s).";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


            <!-- Barre d'outils -->
            <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/relations-comptes"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3 class=>Enregistrer une Relation "Parent-Enfant"</h3>
            <div>
            <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/create-relations-comptes-process" method="post">
            <h5 class="titre-section-form">Relations Comptes</h5>
            <div class="col-md-6">
                <label for="parentSelect" class="form-label">Choisir un Parent<span class="champ-obligatoire">*</span></label>
                <select class="form-select" id="parentSelect" name="parent_id">
                    <option value="">----Sélectionner un Parent----</option>
                    <?php foreach ($licencies as $licencie) : ?>
                        <option value="<?= $licencie['id'] ?>"><?= htmlspecialchars($licencie['nom'] . ' ' . $licencie['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="childrenSelect" class="form-label">Choisir le(s) Enfant(s)<span class="champ-obligatoire">*</span></label>
                <select multiple class="form-select" id="childrenSelect" name="children_ids[]">
                    <?php foreach ($licencies as $licencie) : ?>
                        <option value="<?= $licencie['id'] ?>"><?= htmlspecialchars($licencie['nom'] . ' ' . $licencie['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Maintenez CTRL pour sélectionner plusieurs enfants.</small>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Enregistrer relation(s)</button>
                <a href="/admin/relations-comptes"><button class="btn btn-danger" type="button">Annuler</button></a>
            </div>
        </form>
    </div>


</body>