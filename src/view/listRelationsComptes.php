<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listRelationsComptes.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!-- jQuery (nécessaire pour DataTables) -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <!-- Inclusion de SheetJS -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>



</head>


<body>
    <div class="container tableau-relations">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') echo "Suppression de la relation réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/licencies"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des relations "parents-enfants" des licenciés</h3>
            <div>
                <a href="/admin/relations-comptes/new"><button title="Enregistrer une relation" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
                <a href="/admin/licencies"><button title="Liste des licenciés" class="btn btn-dark me-2" type="button"><i class="bi bi-people"></i></button></a>
                <button disabled title="Exporter en .csv" class="btn btn-dark" type="button"><i class="bi bi-file-earmark-excel"></i></button>
            </div>
        </div>

        <table class="table" id="tableau-relations-licencies">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>Parent</th>
                    <th>Enfant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relations as $relation) : ?>
                    <tr>
                        <td><?= htmlspecialchars($relation['id']) ?></td>
                        <td><?= htmlspecialchars($relation['nom_parent']) . ' ' . htmlspecialchars($relation['prenom_parent']) ?></td>
                        <td><?= htmlspecialchars($relation['nom_enfant']) . ' ' . htmlspecialchars($relation['prenom_enfant']) ?></td>
                        <td class="buttons-actions">
                            <!-- <a href="/admin/update-licencie?id=<?= $sortie['id'] ?>" class="btn btn-warning me-2" title="Mettre à jour le licencié"><i class="bi bi-pencil"></i></a> -->
                            <button title="Supprimer le licencié" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteRelationsComptesModal" data-id="<?= $relation['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteRelationsComptesModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette relation entre ces licenciés ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-relations-comptes-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="relationsComptesIdToDelete" value="">
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
                    const relatioComptesId = this.getAttribute('data-id'); // Obtenez l'ID de la relation
                    document.getElementById('relationsComptesIdToDelete').value = relatioComptesId; // Mettez à jour la valeur du formulaire caché
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json',
                },
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Tous"]
                ],
            });
        });
    </script>



</body>