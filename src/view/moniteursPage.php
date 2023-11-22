<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/moniteursPage.css">


</head>

<h1>LES MONITEURS</h1>


<body>

    <div class="container mt-4">
        <div class="row">
            <!-- Vérifiez si la liste des moniteurs est vide -->
            <?php if (empty($moniteurs)) : ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        LA LISTE DES MONITEURS DU CLUB EST BIENTÔT DISPONIBLE.
                    </div>
                </div>
            <?php else : ?>
                <!-- Boucle sur les moniteurs existants -->
                <?php foreach ($moniteurs as $moniteur) : ?>
                    <div class="col-md-4 mb-3">
                        <div class="card moniteur-card">
                            <img src="<?= !empty($moniteur['photo']) ? $moniteur['photo'] : '/images/uploads/moniteurs/entraineur.png' ?>" class="card-img-top" alt="Photo de <?= htmlspecialchars($moniteur['prenom'] . ' ' . $moniteur['nom']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($moniteur['prenom']) . ' ' . htmlspecialchars($moniteur['nom']) ?></h5>
                                <?php if (!empty($moniteur['niveau'])) : ?>
                                    <p class="card-text">Niveau: <?= htmlspecialchars($moniteur['niveau']) ?></p>
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