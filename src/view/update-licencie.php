<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/update-licencie.css">

</head>


<body>

    <div class="container update-licencie-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'update') echo "Modification du licencié réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_update') echo "Erreur lors de la modification du licencié.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="my-0">Modifier un Licencié</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/update-licencie-process-admin" method="post">
            <input type="hidden" name="id" value="<?php echo $licencie['id']; ?>" />
            <h5 class="titre-section-form">Identité</h5>
            <div class="col-md-4">
                <label for="nom" class="form-label">Nom<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $licencie['nom']; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="prenom" class="form-label">Prénom<span class="champ-obligatoire">*</span></label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $licencie['prenom']; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="date_naissance" class="form-label">Date de naissance<span class="champ-obligatoire">*</span></label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $licencie['date_naissance']; ?>" required>
            </div>

            <h4 class="titre-section-form">Coordonnées</h4>
            <div class="col-md-6">
                <label for="mail" class="form-label">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $licencie['mail']; ?>">
            </div>
            <div class="col-md-6">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $licencie['telephone']; ?>">
            </div>

            <div class="col-md-2">
                <label for="code_postal" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo $licencie['code_postal']; ?>">
            </div>

            <div class="col-md-4">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $licencie['ville']; ?>">
            </div>

            <div class="col-md-6">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $licencie['adresse']; ?>">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="/admin/licencies"><button class="btn btn-danger" type="button">Annuler / Retour</button></a>
            </div>
        </form>
    </div>


</body>