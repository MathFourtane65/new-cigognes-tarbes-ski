<?php require_once('components/header-admin.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/listMembresBureau.css">


</head>


<body>
    <div class="container tableau-membres-bureau">

        <?php if (isset($_GET['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['success'] == 'delete') echo "Suppression du memebre du bureau réussie.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div><?php endif; ?>


        <!-- Barre d'outils -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin"><button title="Retour" class="btn btn-dark" type="button"><i class="bi bi-arrow-left-circle"></i></button></a>

            <h3>Liste des membres du bureau (affichés sur le site internet)</h3>
            <div>
                <a href="/admin/bureau/new"><button title="Enregistrer un membre du bureau" class="btn btn-dark me-2" type="button"><i class="bi bi-plus-circle"></i></button></a>
            </div>
        </div>
        <table class="table">
            <thead class="table-info">
                <tr>
                    <!-- <th>#</th> -->
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th>Mail</th>
                    <th>Téléphone</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($membresBureau as $membre) : ?>
                    <tr>
                        <!-- <td class="cellule-texte"><?= htmlspecialchars($membre['id']) ?></td> -->
                        <td class="cellule-texte"><?= htmlspecialchars($membre['nom']) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($membre['prenom']) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($membre['role']) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($membre['mail']) ?></td>
                        <td class="cellule-texte"><?= htmlspecialchars($membre['telephone']) ?></td>
                        <td class="cellule-image">
                            <?php if ($membre['photo']) : ?>
                                <img src="<?= htmlspecialchars($membre['photo']) ?>" class="img-moniteur" alt="Photo de <?= htmlspecialchars($membre['prenom']) ?>">
                            <?php endif; ?>
                        </td>
                        <td class="buttons-actions cellule-texte">
                            <!-- <a href="/admin/moniteurs/update?id=<?= $membre['id'] ?>" class="btn btn-warning me-2" title="Mettre à jour le moniteur"><i class="bi bi-pencil"></i></a> -->
                            <button title="Supprimer le membre du bureau" type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteMembreBureauModal" data-id="<?= $membre['id'] ?>"> <i class="bi bi-trash"></i></button>
                        </td>
                        <!-- Affichez d'autres informations de licencié si nécessaire -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>



    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteMembreBureauModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce membre du bureau ?</p>
                    <p class="text-danger">
                        <strong>Attention :</strong> Il ne sera plus affcihé dans la liste des memebres du bureau sur le site internet.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Formulaire caché pour la soumission de suppression -->
                    <form action="/delete-membre-bureau-process" method="post" id="deleteForm" style="display: inline;">
                        <input type="hidden" name="id" id="membreBureauIdToDelete" value="">
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
                    document.getElementById('membreBureauIdToDelete').value = licencieId; // Mettez à jour la valeur du formulaire caché
                });
            });
        });
    </script>


</body>