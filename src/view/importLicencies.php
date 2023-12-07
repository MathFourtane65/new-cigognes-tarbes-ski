<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/importLicencies.css">

</head>

<body>

    <div class="container import-licencie-form">

        <!-- Messages de confirmation ou d'erreur -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 'import') : ?>
            <div class="alert alert-success alert-dismissible fade show">
                Import des licenciés réussi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?php
                if ($_GET['error'] == 'failed_open_file') {
                    echo "Erreur lors de l'ouverture du fichier.";
                } elseif ($_GET['error'] == 'no_file') {
                    echo "Aucun fichier sélectionné.";
                } elseif ($_GET['error'] == 'invalid_file_type') {
                    echo "Le fichier importé n'est pas au format CSV.";
                } else {
                    echo "Erreur lors de l'importation.";
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/licencies/importes"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Importer des Licenciés</h3>
            <div>
            </div>

        </div>

        <div class="container mt-4">
            <p class="consigne-formulaire">
                Utilisez un fichier CSV pour importer les licenciés. Assurez-vous que le fichier contienne les colonnes suivantes dans cet ordre : <br>Nom, Prénom, Date de Naissance (JJ/MM/AAAA), Mail, Téléphone, Adresse, Code Postal, Ville.
            </p>

            <!-- Formulaire d'importation -->
            <form action="/process-import-licencies" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="csvFile" class="form-label">Fichier CSV</label>
                    <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
                </div>
                <div id="loadingSpinner" class="loading-spinner" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Importer</button>

            </form>
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const submitButton = document.querySelector('button[type="submit"]');

            form.addEventListener('submit', function() {
                loadingSpinner.style.display = 'block'; // Afficher le spinner lors de la soumission du formulaire
                // passer le bouton en disabled avec écrit Import en cours ...
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="bi bi-upload"></i> Import en cours ...';

            });
        });
    </script>

</body>