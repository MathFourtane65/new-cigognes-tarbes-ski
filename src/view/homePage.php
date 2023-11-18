<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/homePage.css">


</head>

<h2>Nous mettons actuellement à jour notre site pour la saison à venir ...</h2>

<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Colonne pour le carousel -->
            <div class="col-md-8 carousel-page-accueil mb-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false">
                    <!-- <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div> -->
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="/images/carousel/image1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="/images/carousel/image2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="/images/carousel/image3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button> -->
                </div>
            </div>

            <!-- Colonne pour l'article en vedette -->
            <div class="col-md-4">

                <!-- <div class="row"> -->
                <div class="card mb-3">
                    <img src="/images/carousel/image1.jpg" class="card-img" alt="Dernier Article">
                    <div class="card-img-overlay img-article-page-accueil"> <!-- Ajout d'un fond noir semi-transparent -->
                        <h5 class="card-title text-white">Titre de l'article en vedette</h5>
                        <p class="card-text text-white">Ceci est un résumé ou une accroche pour l'article. Cela donne envie au lecteur de cliquer pour lire plus.</p>
                        <a href="#" class="btn btn-primary">Lire plus</a>
                    </div>
                </div>

                <!-- </div> -->

                <!-- <div class="row"> -->
                <div class="card mb-3">
                    <img src="/images/image_cigogne_ski_ia.png" class="card-img" alt="Dernier Article">
                </div>
                <!-- </div> -->


            </div>
        </div>


        <div class="card text-center">
            <div class="card-header">
            Bienvenue au Club "Les Cigognes" - Section Ski
            </div>
            <div class="card-body">
                <h5 class="card-title"> Fondée en 1945, l’association "Les Cigognes" s'est donnée pour mission de partager les joies du ski avec les enfants et adultes de notre région. Nichés au cœur des Pyrénées, nous profitons d'un cadre exceptionnel pour pratiquer ce sport hivernal tant en loisir qu'en compétition.</h5>
                <p class="card-text">  Encadrés par des moniteurs passionnés et expérimentés, nos membres, de 5 à 80 ans, peuvent compter sur un accompagnement de qualité adapté à leur niveau, qu'ils soient novices ou confirmés.</p>
            </div>
        </div>


    </div>
</body>

<?php require_once('components/footer.php'); ?>