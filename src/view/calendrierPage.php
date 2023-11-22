<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/calendrierPage.css">


</head>

<h1>CALENDRIER</h1>


<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Vérifiez si la liste des évènements est vide -->
            <?php if (empty($evenements)) : ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        LE CALENDRIER DES ÉVÉNEMENTS EST BIENTÔT DISPONIBLE.
                    </div>
                </div>
            <?php else : ?>
                <!-- Boucle sur les événements existants -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Évènement</th>
                                <th>Lieu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($evenements as $evenement) : ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($evenement['date'])) ?></td>
                                    <td><?= htmlspecialchars($evenement['nom']) ?></td>
                                    <td><?= htmlspecialchars($evenement['lieu']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>


<?php require_once('components/footer.php'); ?>