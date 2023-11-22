<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/dossierInscriptionPage.css">


</head>

<h1>DOSSIER D'INSCRIPTION</h1>


<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col text-center">
                <p class="lead mb-5">Nous vous invitons à télécharger les formulaires requis pour l'inscription à la prochaine saison. Les documents sont mis à jour et disponibles au téléchargement ci-dessous.</p> <!-- <a href="/fichiers/dossier-inscription-2023-2024.pdf" class="btn btn-primary btn-lg" download>Télécharger le Dossier</a> -->
                <p><a href="/fichiers/cerfa_15699_01_quastionnaire_de_sante.pdf" class="btn btn-primary btn-lg" download>Questionnaire de santé (pdf)</a></p>
                <p><a href="/fichiers/cm_attestation_fsgt_23_24.pdf" class="btn btn-primary btn-lg" download>Attestation FSGT (pdf)</a></p>
                <p><a href="/fichiers/formulaire_inscription_23_24.doc" class="btn btn-primary btn-lg" download>Formulaire Inscription CIGOGNES 23/24 (word)</a></p>
                <p><a href="/fichiers/infos_adherents_23_24.docx" class="btn btn-primary btn-lg" download>Infos Adhérents 23/24 (word)</a></p>

            </div>
        </div>
    </div>
</body>


<?php require_once('components/footer.php'); ?>