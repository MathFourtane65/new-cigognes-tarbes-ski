<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/detail-licencie.css">

</head>


<body>

    <div class="container detail-licencie-form">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'update') echo "Modification du licencié réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_update') echo "Erreur lors de la modification du licencié.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="row mb-3">
            <div class="col-md-4 d-flex justify-content-start">
                <a title="Retour à la liste des licenciés" href="/admin/licencies" class="btn btn-dark"><i class="bi bi-arrow-left"></i></a>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <h3>Détails Licencié</h3>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <?php if (!empty($licencie['mail'])) : ?>
                    <button title="Envoyer nouveaux identifiants par mail" class="btn btn-dark" disabled><i class="bi bi-envelope-arrow-up"></i></button>
                <?php else : ?>
                    <button title="Impossible d'envoyer un mail à ce licencié" class="btn btn-dark" disabled><i class="bi bi-envelope-slash"></i></button>
                <?php endif; ?>
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


            <!-- <div class="col-12">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="/admin/licencies"><button class="btn btn-danger" type="button">Annuler / Retour</button></a>
            </div> -->
        </form>
    </div>


</body>

<?php require_once('components/footer.php'); ?>