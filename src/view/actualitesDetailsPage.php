<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>


<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/actualitesDetailsPage.css">


</head>

<body>

<!-- Affichage de l'article -->
<div class="container mt-4">
    <h2 class="titre-article"><?= htmlspecialchars($article['titre']) ?></h1>
    <!-- Conversion des entités HTML et gestion des retours à la ligne -->
    <p class="contenu-article"><?= nl2br(html_entity_decode($article['contenu'])) ?></p>
    <!-- Affichage des images associées -->
    <div class="row">
        
        <?php if (!empty($article['image_paths'][0])) : ?>
            <?php foreach ($article['image_paths'] as $path) : ?>
                <div class="col-md-4 mb-3">
                    <img src="<?= htmlspecialchars($path) ?>" class="img-fluid" alt="Image">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>

        </div>

        </body>

        <?php require_once('components/footer.php'); ?>
