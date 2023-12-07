<?php require_once('components/header-licencie.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="/css/view/licencie-inscription-sortie-p2.css">

</head>


<body>

    <div class="container licencie-inscription-p2-form">
        <!-- Titre et retour -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a title="Retour" href="/licencie/inscription-sortie" class="btn btn-dark"><i class="bi bi-arrow-left"></i></a>
            <h3>Inscription : <?= htmlspecialchars($sortieSelectionne['nom']) ?></h3>
            <div></div>
        </div>
        <p class="consigne-formulaire">Les champs avec <span class="champ-obligatoire">*</span> sont obligatoires.</p>


        <!-- Détails de la sortie sélectionnée -->
        <div class="alert alert-light" role="alert">
            <h5><strong>Détails</strong></h5>
            <div class="row">
                <div class="col-md-4">
                    <p>Lieu : <?= htmlspecialchars($sortieSelectionne['lieu']) ?></p>

                </div>
                <div class="col-md-4">
                    <p>Date : <?= date('d/m/Y', strtotime($sortieSelectionne['date'])) ?></p>

                </div>
                <div class="col-md-4">
                    <p>Fin inscriptions : <?= date('d/m/Y H:i:s', strtotime($sortieSelectionne['date_fin_inscriptions'])) ?></p>

                </div>
                <div class="col-md-4">
                    <p>Départ du bus : <?= htmlspecialchars($sortieSelectionne['heure_depart_bus']) ?></p>

                </div>
                <div class="col-md-10">
                    <?php if ($isBusUnlimited) : ?>
                        <h5 class="nbr-places-bus">Pas de limite de places dans le bus</h5>
                    <?php else : ?>
                        <h5 class="nbr-places-bus">Places restantes dans le bus : <?= htmlspecialchars($availableBusPlaces) ?></h5>
                    <?php endif; ?>
                    <!-- <h5 class="nbr-places-bus">Places restantes dans le bus : <?= htmlspecialchars($availableBusPlaces) ?></h5> -->

                </div>

            </div>
        </div>

        <!-- Désactiver le bouton valider si tous les licenciés sont déjà inscrits -->
        <?php
        $allInscrits = true;
        if (!$licencieInscrit) {
            $allInscrits = false;
        }
        foreach ($enfants as $enfant) {
            if (!$enfantsInscrits[$enfant['id_enfant']]) {
                $allInscrits = false;
                break;
            }
        }
        ?>



        <form class="row g-3 needs-validation" action="/process-inscription-sortie-licencie" method="post">
            <input type="hidden" name="sortie_id" value="<?= $sortieSelectionne['id'] ?>">
            <div class="box-licencie row g-3">
                <h5 class="titre-section-form"><?= htmlspecialchars($licencie['prenom'] . ' ' . $licencie['nom']), ' (', date('d/m/Y', strtotime($licencie['date_naissance'])), ')' ?></h5>
                <?php
                if (!$licencieInscrit) { ?>
                    <div class="col-md-4">
                        <label id="licencie_<?= $licencie['id'] ?>_participe_label" for="licencie_<?= $licencie['id'] ?>_participe" class="form-label">Participe à la sortie<!--<span class="champ-obligatoire">*</span>--></label>
                        <select id="licencie_<?= $licencie['id'] ?>_participe" name="licencie[<?= $licencie['id'] ?>][participe]" class="form-select">
                            <option value="">--- Choisir une option ---</option>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                        </select>
                    </div>
                    <?php
                    if (!$isBusFull || $isBusUnlimited) { ?>
                        <div class="col-md-4">
                            <label for="prenom" class="form-label">Si OUI, prend le bus ?<!--<span class="champ-obligatoire">*</span>--></label>
                            <select id="licencie_<?= $licencie['id'] ?>_bus" name="licencie[<?= $licencie['id'] ?>][bus]" class="form-select">
                                <option value="">--- Choisir une option ---</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date_naissance" class="form-label">Si OUI, quel arrêt ?<!--<span class="champ-obligatoire">*</span>--></label>
                            <select id="licencie[<?= $licencie['id'] ?>][lieu_bus]" name="licencie[<?= $licencie['id'] ?>][lieu_bus]" class="form-select">
                                <option value="">--- Choisir une option ---</option>
                                <option value="Tarbes">Tarbes</option>
                                <option value="Lourdes">Lourdes</option>
                                <option value="Argelès-Gazost">Argelès-Gazost</option>
                            </select>
                        </div>
                    <?php
                    } else {
                        // Afficher les champs désactivés avec un message
                    ?>
                        <div class="col-md-4">
                            <label for="prenom" class="form-label">Si OUI, prend le bus ?<!--<span class="champ-obligatoire">*</span>--></label>
                            <select id="licencie_<?= $licencie['id'] ?>_bus" name="licencie[<?= $licencie['id'] ?>][bus]" class="form-select" disabled>
                                <option value="">--- Choisir une option ---</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="date_naissance" class="form-label">Si OUI, quel arrêt ?<!--<span class="champ-obligatoire">*</span>--></label>
                            <select id="licencie[<?= $licencie['id'] ?>][lieu_bus]" name="licencie[<?= $licencie['id'] ?>][lieu_bus]" class="form-select" disabled>
                                <option value="">--- Choisir une option ---</option>
                                <option value="Tarbes">Tarbes</option>
                                <option value="Lourdes">Lourdes</option>
                                <option value="Argelès-Gazost">Argelès-Gazost</option>
                            </select>
                        </div>

                    <?php
                        echo "<p class='no-bus-places'>Plus de places disponibles dans le bus.</p>";
                    }
                    ?>
                    <div class="col-md-6">
                        <label for="mail" class="form-label">Commentaire</label>
                        <textarea id="licencie[<?= $licencie['id'] ?>][commentaire_licencie]" name="licencie[<?= $licencie['id'] ?>][commentaire_licencie]" class="form-control" placeholder="Commentaire ou demande spéciale"></textarea>
                    </div>

                <?php
                } else {
                    echo "<p class='text-deja-inscrit'>Déjà inscrit à cette sortie.</p>";
                }
                ?>
            </div>

            <?php
            // Pour les enfants
            foreach ($enfants as $enfant) { ?>
                <input type="hidden" name="sortie_id" value="<?= $sortieSelectionne['id'] ?>">
                <div class="box-licencie row g-3">
                    <h5 class="titre-section-form"><?= htmlspecialchars($enfant['prenom_enfant'] . ' ' . $enfant['nom_enfant']), ' (', date('d/m/Y', strtotime($enfant['date_naissance_enfant'])), ')' ?></h5>
                    <?php
                    if (!$enfantsInscrits[$enfant['id_enfant']]) { ?>
                        <div class="col-md-4">
                            <label for="nom" class="form-label">Participe à la sortie<!--<span class="champ-obligatoire">*</span>--></label>
                            <select id="licencie[<?= $enfant['id_enfant'] ?>][participe]" name="licencie[<?= $enfant['id_enfant'] ?>][participe]" class="form-select">
                                <option value="">--- Choisir une option ---</option>
                                <option value="OUI">OUI</option>
                                <option value="NON">NON</option>
                            </select>
                        </div>
                        <?php
                        if (!$isBusFull || $isBusUnlimited) { ?>
                            <div class="col-md-4">
                                <label for="prenom" class="form-label">Si OUI, prend le bus ?<!--<span class="champ-obligatoire">*</span>--></label>
                                <select id="licencie[<?= $enfant['id_enfant'] ?>][bus]" name="licencie[<?= $enfant['id_enfant'] ?>][bus]" class="form-select">
                                    <option value="">--- Choisir une option ---</option>
                                    <option value="OUI">OUI</option>
                                    <option value="NON">NON</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date_naissance" class="form-label">Si OUI, quel arrêt ?<!--<span class="champ-obligatoire">*</span>--></label>
                                <select id="licencie[<?= $enfant['id_enfant'] ?>][lieu_bus]" name="licencie[<?= $enfant['id_enfant'] ?>][lieu_bus]" class="form-select">
                                    <option value="">--- Choisir une option ---</option>
                                    <option value="Tarbes">Tarbes</option>
                                    <option value="Lourdes">Lourdes</option>
                                    <option value="Argelès-Gazost">Argelès-Gazost</option>
                                </select>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-md-4">
                                <label for="prenom" class="form-label">Si OUI, prend le bus ?<!--<span class="champ-obligatoire">*</span>--></label>
                                <select id="licencie[<?= $enfant['id_enfant'] ?>][bus]" name="licencie[<?= $enfant['id_enfant'] ?>][bus]" class="form-select" disabled>
                                    <option value="">--- Choisir une option ---</option>
                                    <option value="OUI">OUI</option>
                                    <option value="NON">NON</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date_naissance" class="form-label">Si OUI, quel arrêt ?<!--<span class="champ-obligatoire">*</span>--></label>
                                <select id="licencie[<?= $enfant['id_enfant'] ?>][lieu_bus]" name="licencie[<?= $enfant['id_enfant'] ?>][lieu_bus]" class="form-select" disabled>
                                    <option value="">--- Choisir une option ---</option>
                                    <option value="Tarbes">Tarbes</option>
                                    <option value="Lourdes">Lourdes</option>
                                    <option value="Argelès-Gazost">Argelès-Gazost</option>
                                </select>
                            </div>

                        <?php
                            echo "<p class='no-bus-places'>Plus de places disponibles dans le bus.</p>";
                        }
                        ?>

                        <div class="col-md-6">
                            <label for="mail" class="form-label">Commentaire</label>
                            <textarea id="licencie[<?= $enfant['id_enfant'] ?>][commentaire_licencie]" name="licencie[<?= $enfant['id_enfant'] ?>][commentaire_licencie]" class="form-control" placeholder="Commentaire ou demande spéciale"></textarea>
                        </div>
                </div>
        <?php
                    } else {
                        echo "<p class='text-deja-inscrit'>Déjà inscrit à cette sortie.</p>";
                        echo "</div>";
                    }
                }
        ?>
        <div class="justify-content-center row">
            <div class="col-md-6">
                <button type="submit" id="submitButton" class="btn btn-primary mt-2 w-50">Valider</button>

            </div>
            <div class="col-md-6">
                <a href="/licencie/inscription-sortie"><button class="btn btn-danger mt-2 w-50" type="button">Annuler</button></a>
            </div>
        </div>

    </div>

    </form>

    <!-- Désactiver le bouton valider si tous les licenciés sont déjà inscrits -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            <?php if ($allInscrits) : ?>
                document.getElementById('submitButton').disabled = true;
            <?php endif; ?>
        });
    </script>







</body>

<?php require_once('components/footer.php'); ?>