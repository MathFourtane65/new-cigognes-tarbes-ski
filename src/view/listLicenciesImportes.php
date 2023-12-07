<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listLicenciesImportes.css">

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
    <div class="container tableau-licencies-importes">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'valide_import') echo "Validation de l'import du licencié du réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>

        <?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['error'] == 'failed_validate_import') echo "Erreur lors de l'import du licencié.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin/licencies"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des licenciés <strong>IMPORTES (saison 22/23)</strong></h3>
            <div>
                <!-- <a href="/admin/new-licencie"><button title="Enregistrer un licencié" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a> -->
                <!-- <a href="/admin/relations-comptes"><button title="Relations entre comptes licenciés" class="btn btn-dark me-2" type="button"><i class="bi bi-diagram-3"></i></button></a> -->
                <a href="/admin/licencies/import"><button title="Importer des licenciés" class="btn btn-dark me-2" type="button"><i class="bi bi-upload"></i></button></a>
                <button id="export-excel-licencies-importes" title="Exporter en .csv" class="btn btn-dark  me-2" type="button"><i class="bi bi-file-earmark-excel"></i></button>
                <!-- <a href="/admin/licencies-importes"><button title="Liste licenciés importés" class="btn btn-dark me-2" type="button"><i class="bi bi-list-check"></i></button></a> -->

            </div>
        </div>
        <table class="table" id="tableau-licencies-importes">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <!-- <th>Niveau</th> -->
                    <th>Actions</th>
                    <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($licenciesImportes as $licencieImporte) : ?>
                    <tr>
                        <!-- <td><?= htmlspecialchars($licencieImporte['id']) ?></td> -->
                        <td><?= htmlspecialchars($licencieImporte['nom']) ?></td>
                        <td><?= htmlspecialchars($licencieImporte['prenom']) ?></td>
                        <td><?= htmlspecialchars($licencieImporte['date_naissance']) ?></td>
                        <td><?= htmlspecialchars($licencieImporte['mail']) ?></td>
                        <td><?= htmlspecialchars($licencieImporte['telephone']) ?></td>
                        <td class="buttons-actions">
                            <!-- <button type="button" class="btn btn-danger">Supprimer</button> -->
                            <!-- <a href="/valider-import-licencie-process?id=<?= $licencieImporte['id'] ?>" class="btn btn-success me-1" title="Valider le licencié"><i class="bi bi-check-circle"></i></a> -->
                            <!-- <a href="/admin/licencies/details?id=<?= $licencieImporte['id'] ?>" class="btn btn-info me-1" title="Détails du licencié"><i class="bi bi-eye"></i></a> -->

                            <!-- <a href="/admin/update-licencie?id=<?= $licencieImporte['id'] ?>" class="btn btn-warning me-1" title="Mettre à jour le licencié"><i class="bi bi-pencil"></i></a> -->
                            <button title="Valider l'import du licencié" type="button" class="btn btn-success me-1 import-btn" data-bs-toggle="modal" data-bs-target="#importModal" data-id="<?= $licencieImporte['id'] ?>"> <i class="bi bi-check-circle"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation d'import du licencié -->
    <div class="modal fade" id="importModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer l'import du licencié</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir importer ce licencié ?</p>
                    <p class="text-primary">
                        <strong>Attention :</strong> Cette action entraînera l'envoi d'un mail au licencié avec son identifiant et son mot de passe.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/valider-import-licencie-process" method="post" id="importForm" style="display: inline;">
                        <input type="hidden" name="id" id="licencieImporteIdToImport" value="">
                        <button type="submit" class="btn btn-success">Importer le licencié</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JS gestion Modal de confirmation d'import -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Lorsqu'un bouton de suppression est cliqué
            document.querySelectorAll('.import-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const licencieImporteId = this.getAttribute('data-id'); // Obtenez l'ID du licencié
                    document.getElementById('licencieImporteIdToImport').value = licencieImporteId; // Mettez à jour la valeur du formulaire caché
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
        const exportButton = document.getElementById('export-excel-licencies-importes');

        const table = document.getElementById('tableau-licencies-importes');

        exportButton.addEventListener('click', () => {
            /* Create worksheet from HTML DOM TABLE */
            const wb = XLSX.utils.table_to_book(table, {
                sheet: 'liste_licencies',
            });

            // Obtenez la première feuille de calcul du livre de travail
            var ws = wb.Sheets[wb.SheetNames[0]];

            /* hide 'Actions' column - remplacez 6 par l'index réel de votre colonne */
            if (!ws['!cols']) ws['!cols'] = [];
            ws['!cols'][5] = {
                hidden: true
            };

            /* Export to file (start a download) */
            XLSX.writeFile(wb, 'liste_licencies.xlsx');
        });
    </script>


</body>

<?php require_once('components/footer.php'); ?>