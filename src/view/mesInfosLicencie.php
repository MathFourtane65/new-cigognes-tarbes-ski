<?php require_once('components/header-licencie.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/mesInfosLicencie.css">

</head>


<body>

    <div class="container mes-infos-licencie-form">

        <!-- Barre d'outils -->
        <div class="row mb-3">
            <div class="col-md-4 d-flex justify-content-start">
                <a title="Retour à l'accueil de l'espace Licencié" href="/licencie" class="btn btn-dark"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <h3>MON PROFIL</h3>
            </div>
        </div>
        
        <form class="row g-3 needs-validation" action="/update-licencie-process-admin" method="post">
            <input disabled type="hidden" name="id" value="<?php echo $licencie['id']; ?>" />
            <h5 class="titre-section-form">Identité</h5>
            <div class="col-md-4">
                <label for="nom" class="form-label">Nom<!--<span class="champ-obligatoire">*</span>--></label>
                <input disabled type="text" class="form-control" id="nom" name="nom" value="<?php echo $licencie['nom']; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="prenom" class="form-label">Prénom<!--<span class="champ-obligatoire">*</span>--></label>
                <input disabled type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $licencie['prenom']; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="date_naissance" class="form-label">Date de naissance<!--<span class="champ-obligatoire">*</span>--></label>
                <input disabled type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $licencie['date_naissance']; ?>" required>
            </div>

            <h4 class="titre-section-form">Coordonnées</h4>
            <div class="col-md-6">
                <label for="mail" class="form-label">Mail</label>
                <input disabled type="email" class="form-control" id="mail" name="mail" value="<?php echo $licencie['mail']; ?>">
            </div>
            <div class="col-md-6">
                <label for="telephone" class="form-label">Téléphone</label>
                <input disabled type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $licencie['telephone']; ?>">
            </div>

            <div class="col-md-2">
                <label for="code_postal" class="form-label">Code Postal</label>
                <input disabled type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo $licencie['code_postal']; ?>">
            </div>

            <div class="col-md-4">
                <label for="ville" class="form-label">Ville</label>
                <input disabled type="text" class="form-control" id="ville" name="ville" value="<?php echo $licencie['ville']; ?>">
            </div>

            <div class="col-md-6">
                <label for="adresse" class="form-label">Adresse</label>
                <input disabled type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $licencie['adresse']; ?>">
            </div>

            <div class="p-1 bg-dark w-100"></div>

            <h4 class="titre-section-form">Relations Comptes</h4>

            <div class="col-md-6">
                <h5>Comptes Enfants Associés</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <!-- Autres en-têtes si nécessaire -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enfants as $enfant) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($enfant['nom_enfant']) ?></td>
                                    <td><?= htmlspecialchars($enfant['prenom_enfant']) ?></td>
                                    <!-- Autres colonnes si nécessaire -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <h5>Comptes Parents Associés</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <!-- Autres en-têtes si nécessaire -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($parents as $parent) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($parent['nom_parent']) ?></td>
                                    <td><?= htmlspecialchars($parent['prenom_parent']) ?></td>
                                    <!-- Autres colonnes si nécessaire -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>


</body>

<?php require_once('components/footer.php'); ?>