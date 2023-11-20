<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/actualitesPage.css">


</head>

<h1>ACTUALITES</h1>


<body>

    <div class="container mt-4">
        <div class="row">
            <!-- Boucle sur les articles -->
            <?php foreach ($articles as $article) : ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card">
                        <img src="<?= htmlspecialchars($article['image_paths']) ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['titre']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?= htmlspecialchars($article['date']) ?></h6>
                            
                            <p class="card-text"><?= nl2br(html_entity_decode($article['excerpt'])) ?>...</p>
                            <a href="/actualites/details/<?= $article['id'] ?>" class="btn btn-primary">Voir Plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item<?= $i == $page ? ' active' : '' ?>"><a class="page-link" href="/actualites?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>


</body>


<?php require_once('components/footer.php'); ?>