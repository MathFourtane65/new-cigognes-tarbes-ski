<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/update-sortie.css">

</head>


<body>

    <div class="container update-sortie-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'update') echo "Mise à jour de la sortie réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_update') echo "Erreur lors de la mise à jour de la sortie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/sorties"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Modifier une Sortie</h3>
            <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div>
        </div>

        <form class="row g-3 needs-validation" action="/update-sortie-process" method="post">
        <input type="hidden" name="id" value="<?php echo $sortie['id']; ?>" />
    
        <h5 class="titre-section-form">Infos</h5>
            <div class="col-md-5">
                <label for="nom" class="form-label">Nom<span class="champ-obligatoire">*</span></label>
                <input type="text" placeholder="Sortie GAVARNIE" class="form-control" id="nom" name="nom" value="<?php echo $sortie['nom']; ?>" required>
            </div>
            <div class="col-md-5">
                <label for="lieu" class="form-label">Lieu<span class="champ-obligatoire">*</span></label>
                <input type="text" placeholder="Gavarnie-Gèdre" class="form-control" id="lieu" name="lieu" value="<?php echo $sortie['lieu']; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="date" class="form-label">Date de la sortie<span class="champ-obligatoire">*</span></label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $sortie['date']; ?>" required>
            </div>

            <h4 class="titre-section-form">Inscriptions</h4>
            <div class="col-md-12">
                <label for="date_fin_inscriptions" class="form-label">Date de fin d'inscriptions</label>
                <input type="datetime-local" class="form-control" id="date_fin_inscriptions" name="date_fin_inscriptions" value="<?php echo $sortie['date_fin_inscriptions']; ?>">
            </div>
            <div class="col-md-4">
                <label for="places_bus" class="form-label">Nombres de places dans le bus</label>
                <input type="number" class="form-control" id="places_bus" name="places_bus" value="<?php echo $sortie['places_bus']; ?>" >


            </div>
            <div class="col-md-4">
                <label for="heure_depart_bus" class="form-label">Heure de départ du bus</label>
                <input type="time" class="form-control" id="heure_depart_bus" name="heure_depart_bus" value="<?php echo $sortie['heure_depart_bus']; ?>">
            </div>

            <div class="col-md-8">
                <input class="form-check-input" type="checkbox" id="unlimited_places" name="unlimited_places" <?php echo is_null($sortie['places_bus']) ? 'checked' : ''; ?>>
                <label class="form-check-label fw-bold" for="unlimited_places">
                    <= Cocher si pas de limite de places </label>

            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="/admin/sorties"><button class="btn btn-danger" type="button">Annuler</button></a>
            </div>
        </form>
    </div>


</body>