<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cigognes Tarbes Ski</title>

  <!-- Inclusion de Bootstrap et autres styles/scripts ici -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="/images/logo.png" />

  <!-- CSS de base d'initialisation -->
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/components/navbar.css">

  <link rel="stylesheet" href="/css/components/header.css">

</head>

<body>

  <div>
    <img src="/images/logo.png" class="img-fluid logo-header" alt="Club Logo" />
    <h2 class="nom-section-logo">SECTION SKI</h2>

    <?php
    // Supposons que $actualitesFlashModel est votre instance de la classe ActualitesFlash
    // $lastActualiteFlash = $actualitesFlashModel->getLashActualitesFlash();

    // Vérifiez si vous avez obtenu un résultat et si l'actualité n'est pas cachée
    if ($lastActualitesFlash && $lastActualitesFlash['cache'] == 0) {
      // Affichez la div avec le flash info
    ?>
      <div class="marquee-rtl">
        <div>
          <?= htmlspecialchars($lastActualitesFlash['contenu']) ?>
        </div>
      </div>
    <?php
    }
    ?>
    <!-- <div class="marquee-rtl">
      <div>
      FLASH INFO : Le site internet est actuellement en train d'être mis à jour pour la saison à venir.
      </div> -->
  </div>

  </div>