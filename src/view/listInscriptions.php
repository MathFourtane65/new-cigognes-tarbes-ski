<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listInscriptions.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!-- jQuery (nécessaire pour DataTables) -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>



</head>


<body>
    <!-- <h1>LICENCIES</h1> -->
    <div class="container tableau-inscriptions">

        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/sorties"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des inscrits <strong><?= htmlspecialchars($sortie['nom']), ' (', date('d/m/Y', strtotime ($sortie['date'])), ')' ?></strong></h3>
            <div>
                <a href="/admin/sorties/inscriptions/new"><button title="Enregistrer une inscription" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
                <button disabled title="Exporter en .csv" class="btn btn-dark  me-2" type="button"><i class="bi bi-file-earmark-excel"></i></button>

            </div>
        </div>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Bus</th>
                    <th>Lieu Bus</th>
                    <th>Commentaire</th>
                    <!-- <th>CP</th> -->
                    <!-- <th>Ville</th> -->
                    <!-- <th>Adresse</th> -->
                    <!-- <th>Niveau</th> -->
                    <th>Actions</th>
                    <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscriptions as $inscrit) : ?>
                    <tr>
                        <!-- <td><?= htmlspecialchars($inscrit['id']) ?></td> -->
                        <td><?= htmlspecialchars($inscrit['nom']) ?></td>
                        <td><?= htmlspecialchars($inscrit['prenom']) ?></td>
                        <td><?= date('d/m/Y', strtotime ($inscrit['date_naissance'])) ?></td>
                        <td><?= htmlspecialchars($inscrit['mail']) ?></td>
                        <td><?= htmlspecialchars($inscrit['telephone']) ?></td>
                        <td><?= $inscrit['bus'] == 1 ? 'OUI' : 'NON' ?></td>                        <td><?= htmlspecialchars($inscrit['lieu_bus']) ?></td>
                        <td><?= htmlspecialchars($inscrit['commentaire_licencie']) ?></td>
                        <td class="buttons-actions">
                            <!-- <button type="button" class="btn btn-danger">Supprimer</button> -->

                            <!-- <a href="/admin/licencies/details?id=<?= $licencie['id'] ?>" class="btn btn-info me-1" title="Détails du licencié"><i class="bi bi-eye"></i></a> -->

                            <button title="Supprimer l'inscription" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteInscriptionModal" data-id="<?= $inscrit['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteInscriptionModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer l'inscription de ce licencié ?</p>
                    <p class="text-danger">
                        <!-- <strong>Attention :</strong> Cette action entraînera également la suppression de toutes les relations "parents-enfants" associées à ce licencié. -->
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-inscription-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="inscriptionIdToDelete" value="">
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
                    const inscriptionId = this.getAttribute('data-id'); // Obtenez l'ID du licencié
                    document.getElementById('inscriptionIdToDelete').value = inscriptionId; // Mettez à jour la valeur du formulaire caché
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

<?php require_once('components/footer.php'); ?>