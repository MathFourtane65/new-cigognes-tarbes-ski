<?php

require_once '../src/utils/EmailSender.php';

class InscriptionController
{
    private $inscriptionModel;
    private $licencieModel;
    private $relationsComptesModel;
    private $sortieModel;

    public function __construct($inscriptionModel, $licencieModel, $relationsComptesModel, $sortieModel)
    {
        $this->inscriptionModel = $inscriptionModel;
        $this->licencieModel = $licencieModel;
        $this->relationsComptesModel = $relationsComptesModel;
        $this->sortieModel = $sortieModel;
    }

    public function createOneInscription()
    {
        $id_sortie = filter_input(INPUT_POST, 'id_sortie', FILTER_SANITIZE_NUMBER_INT);
        $id_licencie = filter_input(INPUT_POST, 'id_licencie', FILTER_SANITIZE_NUMBER_INT);
        $bus = filter_input(INPUT_POST, 'bus', FILTER_SANITIZE_SPECIAL_CHARS);
        $lieu_bus = filter_input(INPUT_POST, 'lieu_bus', FILTER_SANITIZE_SPECIAL_CHARS);

        $created = $this->inscriptionModel->addInscription($id_licencie, $id_sortie, $bus, $lieu_bus);

        if ($created) {
            header('Location: /admin/inscriptions?success=create');
        } else {
            header('Location: /admin/inscriptions?error=failed_create');
        }
    }

    // public function showInscriptionSortieLicencie()
    // {
    //     if (!isset($_SESSION['licencie_logged_in']) || $_SESSION['licencie_logged_in'] !== true) {
    //         header("Location: /connexion-licencie");
    //         exit();
    //     }
    //     $id = $_SESSION['licencie_id'];
    //     $licencie = $this->licencieModel->getLicencie($id);
    //     $enfants = $this->relationsComptesModel->getChildrenByParentId($id);
    //     //$parents = $this->relationsComptesModel->getParentsByChildId($id);

    //     $sortiesOuvertes = $this->sortieModel->getAllSortiesBeforeDateFinInscriptions();
    //     if (!$licencie) {
    //         // Gérer l'erreur si le licencié n'existe pas
    //         header("Location: /licencie?error=not_found"); 
    //         exit();
    //     }
    //     require '../src/view/licencie-inscription-sortie-p1.php';
    // }

    public function processInscriptionForm()
    {
        if (!isset($_SESSION['licencie_logged_in']) || !$_SESSION['licencie_logged_in']) {
            header("Location: /connexion-licencie");
            exit();
        }
        $idLicencieConnected = $_SESSION['licencie_id'];
        $licencieConnected = $this->licencieModel->getLicencie($idLicencieConnected);
        $mail = $licencieConnected['mail'];


        $sortieId = filter_input(INPUT_POST, 'sortie_id', FILTER_SANITIZE_NUMBER_INT);
        $licencies = $_POST['licencie']; // Suppose que 'licencie' est le nom du tableau contenant tous les licenciés et leurs informations du formulaire.

        foreach ($licencies as $licencieId => $licencieDetails) {
            // Vérifier si le licencié participe
            if ($licencieDetails['participe'] === 'OUI') {
                $bus = ($licencieDetails['bus'] === 'OUI') ? 1 : 0;
                $lieuBus = $bus ? $licencieDetails['lieu_bus'] : null;
                $commentaireLicencie = $licencieDetails['commentaire_licencie'] ?? null; // Utiliser l'opérateur de coalescence nulle pour éviter les erreurs si le champ est vide

                // Appeler la méthode d'ajout d'inscription
                $success = $this->inscriptionModel->addInscription(
                    $licencieId,
                    $sortieId,
                    $bus,
                    $lieuBus,
                    // Vous devez ajouter la logique pour déterminer ces valeurs
                    $montantLicencie = 0, // Supposons que c'est 0 pour l'exemple
                    $paye = 0, // Supposons que c'est 0 pour l'exemple
                    $commentaireLicencie,
                    $commentaireAdmin = '' // Mettre une chaîne vide si vous n'avez pas ce champ
                );

                // Vérifier si l'inscription a été ajoutée avec succès
                if (!$success) {
                    // Gérer l'erreur ici
                    // Par exemple, en ajoutant un message à une variable de session pour l'afficher plus tard
                    $_SESSION['error_messages'][] = "Erreur lors de l'inscription du licencié ID: $licencieId";
                } else {
                    // Ajouter un message de succès à une variable de session pour l'afficher plus tard
                    $_SESSION['success_messages'][] = "Le licencié ID: $licencieId a été inscrit avec succès";
                }
            }
        }

        // Rediriger vers la page de succès avec un message approprié
        if (empty($_SESSION['error_messages'])) {
            $messageDetails = "";
            $sortieDetails = $this->sortieModel->getSortie($sortieId);
            foreach ($licencies as $licencieId => $licencieDetails) {
                if ($licencieDetails['participe'] === 'OUI') {
                    $licencieData = $this->licencieModel->getLicencie($licencieId);
                    $nomComplet = $licencieData['prenom'] . ' ' . $licencieData['nom'];
                    $messageDetails .= "* " . $nomComplet;  // Ajoute un astérisque devant le nom
                    $messageDetails .= $licencieDetails['bus'] === 'OUI' ? " / Prend le bus / Arrêt : " . $licencieDetails['lieu_bus'] : " / Ne prend pas le bus";
                    $messageDetails .= "\n";
                }
            }

            $message = "Bonjour, \n";
            $message .= "Votre inscription pour la sortie " . $sortieDetails['nom'] . " du " . date('d/m/Y', strtotime($sortieDetails['date'])) . " à " . $sortieDetails['lieu'] . " est bien confirmée. \n";
            if (!empty($sortieDetails['heure_depart_bus'])) {
                $message .= "Si vous vous êtes inscrits au bus, le départ est à " . $sortieDetails['heure_depart_bus'] . " de Tarbes. \n";
            }
            $message .= "Voici les détails sur l'inscription réalisée : \n";
            $message .= $messageDetails;
            $message .= "Ceci est un mail automatique, merci de ne pas y répondre.";

            // Préparer l'email
            $to = $mail; // Email du licencié
            $subject = "Confirmation inscription sortie CIGOGNES TARBES SKI";
            $from = "contact@cigognes-tarbes-ski.fr";
            $fromName = "Cigognes Tarbes Ski";
            // Envoyer l'email
            EmailSender::sendMail($to, $subject, $message, $from, $fromName);



            header('Location: /licencie?success=inscription');
        } else {
            header('Location: /licencie?error=inscription');
        }
        exit();
    }

    public function showListInscriptionsBySortie()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $sortieId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sortie = $this->sortieModel->getSortie($sortieId);
        $inscriptions = $this->inscriptionModel->getAllInscriptionBySortieWithLicencie($sortieId);

        if (!$sortie) {
            // Gérer l'erreur si la sortie n'existe pas
            header("Location: /admin/sorties?error=not_found");
            exit();
        }
        require '../src/view/listInscriptions.php';
    }
}
