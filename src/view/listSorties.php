<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listSorties.css">


</head>


<body>
    <div class="container tableau-sorties">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') {
                    echo "Suppression de la sortie réussie.";
                } 
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_delete') {
                    echo "Erreur lors de la suppression de la sortie.";
                } 
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>








        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des sorties</h3>
            <div>
                <a href="/admin/new-sortie"><button title="Enregistrer une sortie" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
                <a href="/admin/sorties/inscriptions/new"><button title="Enregistrer une inscription" class="btn btn-dark me-2" type="button"><i class="bi bi-ui-checks"></i></button></a>

                <button disabled title="Exporter en .csv" class="btn btn-dark" type="button"><i class="bi bi-file-earmark-excel"></i></button>
            </div>
        </div>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Lieu</th>
                    <th>Date</th>
                    <th>Date fin inscriptions</th>
                    <!-- <th>Inscrits</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sorties as $sortie) : ?>
                    <tr>
                        <!-- <td><?= htmlspecialchars($sortie['id']) ?></td> -->
                        <td><?= htmlspecialchars($sortie['nom']) ?></td>
                        <td><?= htmlspecialchars($sortie['lieu']) ?></td>
                        <td><?= date('d/m/Y', strtotime($sortie['date'])) ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($sortie['date_fin_inscriptions'])) ?></td>
                        <!-- <td></td> -->
                        <td class="buttons-actions">
                            <a href="/admin/sorties/inscriptions?id=<?= $sortie['id'] ?>" class="btn btn-info me-1" title="Liste des inscrits"><i class="bi bi-eye"></i></a>
                            <a href="/admin/sorties/update?id=<?= $sortie['id'] ?>" class="btn btn-warning me-2" title="Mettre à jour la sortie"><i class="bi bi-pencil"></i></a>
                            <button title="Supprimer la sortie" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteSortieModal" data-id="<?= $sortie['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteSortieModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette sortie ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-sortie-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="sortieIdToDelete" value="">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS gestion Modal de confirmation de suppression -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Lorsqu'un bouton de suppression est cliqué
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const sortieId = this.getAttribute('data-id'); // Obtenez l'ID de la sortie
                    document.getElementById('sortieIdToDelete').value = sortieId; // Mettez à jour la valeur du formulaire caché
                });
            });
        });
    </script>


</body>