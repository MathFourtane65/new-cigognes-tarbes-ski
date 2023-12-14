<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/admin-inscription-sortie-p1.css">

</head>


<body>

    <div class="container admin-inscription-p1-form">

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'not_found') echo "Erreur lors de la récupération du licencié.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>



        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">

            <a title="Retour à la liste des inscrits de la sortie" href="/admin/sorties" class="btn btn-dark"><i class="bi bi-arrow-left"></i></a>

            <h3>INSCRIRE UN LICENCIE A UNE SORTIE</h3>
            <div>
            </div>
        </div>
        <form id="licencieSelectionForm" class="row g-3 needs-validation" action="/admin/inscription-sortie/details" method="post">
            <div class="col-md-6">
                <label for="sortieSelect" class="form-label">Sortie concernée</label>
                <select id="sortieSelect" name="id_sortie_selectionnee" class="form-select">
                    <option value="">--- Choisir une sortie ---</option>
                    <?php foreach ($sortiesDisponibles as $sortieDispo) : ?>
                        <option value="<?= $sortieDispo['id'] ?>"><?= htmlspecialchars($sortieDispo['nom']), " du ", date('d/m/Y', strtotime($sortieDispo['date'])) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="licencieSelect" class="form-label">Licencié à inscrire</label>
                <select id="licencieSelect" name="id_licencie_selectionnee" class="form-select">
                    <option value="">--- Choisir un licencié ---</option>
                    <?php foreach ($licencies as $licencie) : ?>
                        <option value="<?= $licencie['id'] ?>"><?= htmlspecialchars($licencie['nom']), " ", htmlspecialchars($licencie['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <button type="submit" id="showSortieDetails" class="btn btn-primary mt-2" disabled>Suivant</button>
        </form>
    </div>

    <script>
        function updateSubmitButtonState() {
            var sortieSelected = document.getElementById("sortieSelect").value;
            var licencieSelected = document.getElementById("licencieSelect").value;
            var btn = document.getElementById("showSortieDetails");
            btn.disabled = !(sortieSelected && licencieSelected);
        }

        document.getElementById("sortieSelect").addEventListener("change", updateSubmitButtonState);
        document.getElementById("licencieSelect").addEventListener("change", updateSubmitButtonState);
    </script>

</body>