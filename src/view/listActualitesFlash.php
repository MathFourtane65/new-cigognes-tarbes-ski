<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listActualitesFlash.css">


</head>


<body>
    <div class="container tableau-actualites-flash">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') echo "Suppression de la sortie réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>
    
        <h3>Actualites Flash</h3>
            <div>
                <!-- <a href="/admin/new-sortie"><button title="Enregistrer une sortie" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a> -->
                <!-- <button disabled title="Exporter en .csv" class="btn btn-dark" type="button"><i class="bi bi-file-earmark-excel"></i></button> -->
            </div>
        </div>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Contenu</th>
                    <th>Masqué</th>
                    <!-- <th>Date</th>
            <th>Date fin inscriptions</th>
            <th>Inscrits</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actualitesFlash as $actualiteFlash) : ?>
                    <tr>
                        <td><?= htmlspecialchars($actualiteFlash['contenu']) ?></td>
                        <td><?= $actualiteFlash['cache'] ? 'OUI' : 'NON' ?></td>
                        <td class="buttons-actions">
                            <a href="/admin/actualites-flash/update?id=<?= $actualiteFlash['id'] ?>" class="btn btn-warning me-2" title="Mettre à jour l'actualité flash"><i class="bi bi-pencil"></i></a>
                            <!-- <button title="Supprimer le licencié" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $licencie['id'] ?>"> <i class="bi bi-trash"></i></button> -->
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>





</body>