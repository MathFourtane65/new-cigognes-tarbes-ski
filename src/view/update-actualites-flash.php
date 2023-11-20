<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/update-actualites-flash.css">

</head>


<body>

    <div class="container update-actualites-flash-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'update') echo "Modification de l'actualité FLASH réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_update') echo "Erreur lors de la modification de l'actualité FLASH.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="my-0">Modifier l'actualité FLASH</h3>
            <!-- <div>
                <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>
            </div> -->
        </div>
        <form class="row g-3 needs-validation" action="/update-actualites-flash-process" method="post">
            <input type="hidden" name="id" value="<?php echo $actualiteFlash['id']; ?>" />
            <div class="col-md-12">
                <label for="contenu" class="form-label">Contenu<span class="champ-obligatoire">*</span></label>
                <textarea class="form-control" id="contenu" name="contenu"><?php echo htmlspecialchars($actualiteFlash['contenu']); ?></textarea>
            </div>
            <div class="col-md-4">
                <label for="cache" class="form-label">Masquer l'actualité FLASH ?<span class="champ-obligatoire">*</span></label>
                <select class="form-select" id="cache" name="cache">
                    <option value="1" <?php echo $actualiteFlash['cache'] == 1 ? 'selected' : ''; ?>>Oui</option>
                    <option value="0" <?php echo $actualiteFlash['cache'] == 0 ? 'selected' : ''; ?>>Non</option>
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="/admin/actualites-flash"><button class="btn btn-danger" type="button">Annuler / Retour</button></a>
            </div>
        </form>
    </div>


</body>