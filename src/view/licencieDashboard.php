<?php require_once('components/header-licencie.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/view/licencieDashboard.css">
    <title>Espace Licencié</title>

</head>


<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/user-infos.png" class="card-img-top img-dashboard-licencie" alt="Licenciés">
                    <div class="card-body">
                        <h5 class="card-title">MON PROFIL</h5>
                        <p class="card-text">Visualisez vos informations en détail. Vous pouvez également consulter les comptes associés à votre profil.</p>
                        <a href="/licencie/mes-infos" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="/images/calendar.png" class="card-img-top img-dashboard-licencie" alt="Sorties">
                    <div class="card-body">
                        <h5 class="card-title">INSCRIPTION AUX SORTIES</h5>
                        <p class="card-text">Inscrivez-vous facilement à nos prochaines sorties et ajoutez les membres de votre famille ou vos comptes associés.</p>
                        <a href="/licencie/inscription-sortie" class="btn btn-primary disabled">BIENTOT DISPONIBLE</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>