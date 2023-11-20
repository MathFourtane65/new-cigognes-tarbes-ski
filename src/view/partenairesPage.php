<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/partenairesPage.css">


</head>

<h1>LES PARTENAIRES</h1>


<body>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php for ($i = 0; $i < 4; $i++) : // Remplacer 4 par le nombre réel de partenaires 
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="/images/user.png" class="card-img-top" alt="Nom PARTENAIRE">
                        <div class="card-body">
                            <h5 class="card-title">Nom PARTENAIRE</h5>
                            <p class="card-text">Site Internet</p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</body>


<?php require_once('components/footer.php'); ?>