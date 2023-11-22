<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/bureauPage.css">


</head>

<h1>LE BUREAU</h1>


<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Vérifiez si la liste des memebres du bureau est vide -->
            <?php if (empty($membresBureau)) : ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        LA LISTE DES MEMBRES DU BUREAU DU CLUB EST BIENTÔT DISPONIBLE.
                    </div>
                </div>
            <?php else : ?>
                <!-- Boucle sur les membres du bureau existants -->
                <?php foreach ($membresBureau as $membre) : ?>
                    <div class="col-md-4 mb-3">
                        <div class="card membre-card">
                            <img src="<?= !empty($membre['photo']) ? $membre['photo'] : '/images/uploads/bureau/assistant.png' ?>" class="card-img-top" alt="Photo de <?= htmlspecialchars($membre['prenom'] . ' ' . $membre['nom']) ?>">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($membre['prenom']) . ' ' . htmlspecialchars($membre['nom']) ?></h5>
                                <?php if (!empty($membre['role'])) : ?>
                                    <p class="card-text fst-italic"><?= htmlspecialchars($membre['role']) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($membre['mail'])) : ?>
                                    <p class="card-text text-decoration-underline"><?= htmlspecialchars($membre['mail']) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($membre['telephone'])) : ?>
                                    <p class="card-text text-decoration-underline"><?= htmlspecialchars($membre['telephone']) ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>


<?php require_once('components/footer.php'); ?>