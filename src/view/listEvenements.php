<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/view/listEvenements.css">


</head>


<body>
    <div class="container tableau-evenements">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') echo "Suppression de l'évènement réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des évènements (affichés sur le site internet)</h3>
            <div>
                <a href="/admin/evenements/new"><button title="Enregistrer un évènement" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
                <button disabled title="Exporter en .csv" class="btn btn-dark" type="button"><i class="bi bi-file-earmark-excel"></i></button>
            </div>
        </div>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Date</th>
                    <th>Evènement</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($evenements as $evenement) : ?>
                    <tr>
                        <!-- <td class="cellule-texte"><?= htmlspecialchars($evenement['id']) ?></td> -->
                        <td class="cellule-texte"><?= date('d/m/Y', strtotime($evenement['date'])) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($evenement['nom']) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($evenement['lieu']) ?></td>
                        <td class="buttons-actions cellule-texte">
                            <!-- <a href="/admin/moniteurs/update?id=<?= $evenement['id'] ?>" class="btn btn-warning me-2" title="Mettre à jour le moniteur"><i class="bi bi-pencil"></i></a> -->
                            <button title="Supprimer l'évènement" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteEvenementModal" data-id="<?= $evenement['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteEvenementModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette évènement ?</p>
                    <p class="text-danger">
                        <strong>Attention :</strong> Il ne sera plus affcihé dans la liste des évènements sur le site internet.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-evenement-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="evenementIdToDelete" value="">
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
                    const licencieId = this.getAttribute('data-id'); // Obtenez l'ID du licencié
                    document.getElementById('evenementIdToDelete').value = licencieId; // Mettez à jour la valeur du formulaire caché
                });
            });
        });
    </script>


</body>