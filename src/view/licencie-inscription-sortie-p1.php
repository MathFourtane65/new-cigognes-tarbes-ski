<?php require_once('components/header-licencie.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Licencié</title>
    <link rel="stylesheet" href="/css/view/licencie-inscription-sortie-p1.css">

</head>


<body>

    <div class="container licencie-inscription-p1-form">

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'not_found') echo "Erreur lors de la récupération de la sortie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>



        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a title="Retour à l'accueil de l'espace Licencié" href="/licencie" class="btn btn-dark"><i class="bi bi-arrow-left"></i></a>
            <h3>INSCRIPTION A UNE SORTIE</h3>
            <div>
            </div>
        </div>
        Sélectionner la sortie à laquelle vous souhaitez vous inscrire :
        <form id="sortieSelectionForm" class="row g-3 needs-validation" action="/licencie/inscription-sortie/details" method="post">
            <select id="sortieSelect" name="id_sortie_selectionnee" class="form-select">
                <option value="">--- Choisir une sortie ---</option>
                <?php foreach ($sortiesOuvertes as $sortie) : ?>
                    <option value="<?= $sortie['id'] ?>"><?= htmlspecialchars($sortie['nom']), " du ", date('d/m/Y', strtotime($sortie['date'])) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="showSortieDetails" class="btn btn-primary mt-2" disabled>Suivant</button>
        </form>
    </div>

    <script>
        document.getElementById("sortieSelect").addEventListener("change", function() {
            var sortieId = this.value;
            var btn = document.getElementById("showSortieDetails");
            if (sortieId) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        });
    </script>

</body>

<?php require_once('components/footer.php'); ?>