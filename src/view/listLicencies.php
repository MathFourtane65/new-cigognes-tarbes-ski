<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listLicencies.css">

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
    <!-- <h1>LICENCIES</h1> -->
    <div class="container tableau-licencies">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') echo "Suppression du licencié réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des licenciés <strong>ENREGISTRES (saison 23/24)</strong></h3>
            <div>
                <a href="/admin/new-licencie"><button title="Enregistrer un licencié" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
                <a href="/admin/relations-comptes"><button title="Relations entre comptes licenciés" class="btn btn-dark me-2" type="button"><i class="bi bi-diagram-3"></i></button></a>
                <a href="/admin/licencies/importes"><button title="Liste licenciés inactifs" class="btn btn-dark me-2" type="button"><i class="bi bi-list-check"></i></button></a>
                <button id="export-excel-licencies" title="Exporter en .csv" class="btn btn-dark  me-2" type="button"><i class="bi bi-file-earmark-excel"></i></button>
                <!-- <a href="/admin/licencies/import"><button title="Importer des licenciés" class="btn btn-dark me-2" type="button"><i class="bi bi-upload"></i></button></a> -->

            </div>
        </div>
        <table class="table" id="tableau-licencies">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Identifiant</th>
                    <!-- <th>CP</th> -->
                    <!-- <th>Ville</th> -->
                    <!-- <th>Adresse</th> -->
                    <!-- <th>Niveau</th> -->
                    <th>Actions</th>
                    <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($licencies as $licencie) : ?>
                    <tr>
                        <!-- <td><?= htmlspecialchars($licencie['id']) ?></td> -->
                        <td><?= htmlspecialchars($licencie['nom']) ?></td>
                        <td><?= htmlspecialchars($licencie['prenom']) ?></td>
                        <td><?= htmlspecialchars($licencie['date_naissance']) ?></td>
                        <td><?= htmlspecialchars($licencie['mail']) ?></td>
                        <td><?= htmlspecialchars($licencie['telephone']) ?></td>
                        <td><?= htmlspecialchars($licencie['identifiant']) ?></td>
                        <!-- <td><?= htmlspecialchars($licencie['code_postal']) ?></td> -->
                        <!-- <td><?= htmlspecialchars($licencie['ville']) ?></td> -->
                        <!-- <td><?= htmlspecialchars($licencie['adresse']) ?></td> -->
                        <!-- <td><?= htmlspecialchars($licencie['adresse']) . ', ' . htmlspecialchars($licencie['code_postal']) . ' ' . htmlspecialchars($licencie['ville']) ?></td> -->
                        <!-- <td><?= htmlspecialchars($licencie['niveau']) ?></td> -->
                        <td class="buttons-actions">
                            <!-- <button type="button" class="btn btn-danger">Supprimer</button> -->

                            <a href="/admin/licencies/details?id=<?= $licencie['id'] ?>" class="btn btn-info me-1" title="Détails du licencié"><i class="bi bi-eye"></i></a>

                            <a href="/admin/update-licencie?id=<?= $licencie['id'] ?>" class="btn btn-warning me-1" title="Mettre à jour le licencié"><i class="bi bi-pencil"></i></a>
                            <button title="Supprimer le licencié" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $licencie['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce licencié ?</p>
                    <p class="text-danger">
                        <strong>Attention :</strong> Cette action entraînera également la suppression de toutes les relations "parents-enfants" associées à ce licencié.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-licencie-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="licencieIdToDelete" value="">
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
                    document.getElementById('licencieIdToDelete').value = licencieId; // Mettez à jour la valeur du formulaire caché
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

    <script>
        const exportButton = document.getElementById('export-excel-licencies');

        const table = document.getElementById('tableau-licencies');

        exportButton.addEventListener('click', () => {
            /* Create worksheet from HTML DOM TABLE */
            const wb = XLSX.utils.table_to_book(table, {
                sheet: 'liste_licencies',
            });

            // Obtenez la première feuille de calcul du livre de travail
            var ws = wb.Sheets[wb.SheetNames[0]];

            /* hide 'Actions' column - remplacez 6 par l'index réel de votre colonne */
            if (!ws['!cols']) ws['!cols'] = [];
            ws['!cols'][6] = {
                hidden: true
            };

            /* Export to file (start a download) */
            XLSX.writeFile(wb, 'liste_licencies.xlsx');
        });
    </script>




</body>

<?php require_once('components/footer.php'); ?>