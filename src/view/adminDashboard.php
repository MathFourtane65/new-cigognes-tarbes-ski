<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/view/adminDashboard.css">
    <title>Espace Administrateur</title>

</head>


<body>
    <div class="container mt-5">
        <h3 class="mb-4 text-start fw-bold fst-italic">APPLICATION WEB</h3> <!-- Titre de la section Application Web -->
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/crowd-of-users.png" class="card-img-top img-dashboard-admin" alt="Licenciés">
                    <div class="card-body">
                        <h5 class="card-title">LICENCIÉS</h5>
                        <p class="card-text">Gestion des licenciés et des relations "parent/enfant" entre les comptes.</p>
                        <a href="/admin/licencies" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/calendar.png" class="card-img-top img-dashboard-admin" alt="Sorties">
                    <div class="card-body">
                        <h5 class="card-title">SORTIES</h5>
                        <p class="card-text">Gestion des sorties et des inscriptions aux sorties.</p>
                        <a href="/admin/sorties" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/icon-admin.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">ADMINISTRATEURS</h5>
                        <p class="card-text">Gestion des comptes administrateurs du site internet.</p>
                        <a href="/admin/administrateurs" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

        </div>

        <h3 class="mb-4 text-start fw-bold fst-italic">SITE INTERNET</h3> <!-- Titre de la section Application Web -->

        <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/article.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">ARTICLES</h5>
                        <p class="card-text">Gestion des articles publiés sur le site internet.</p>
                        <a href="/admin/articles" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/info.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">ACTUALITES FLASH</h5>
                        <p class="card-text">Gestion du contenu de la barre de flash (Flash info).</p>
                        <a href="/admin/actualites-flash" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/entraineur.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">MONITEURS</h5>
                        <p class="card-text">Gestion des moniteurs à afficher sur le site internet.</p>
                        <a href="/admin/moniteurs" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/team.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">MEMBRES BUREAU</h5>
                        <p class="card-text">Gestion des membres du bureau à afficher sur le site internet.</p>
                        <a href="/admin/bureau" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/calendar2.png" class="card-img-top img-dashboard-admin" alt="Mise à Jour Site">
                    <div class="card-body">
                        <h5 class="card-title">EVENEMENTS</h5>
                        <p class="card-text">Gestion des évènements à afficher sur le calendrier sur le site internet.</p>
                        <a href="/admin/evenements" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>




        </div>
    </div>
</body>