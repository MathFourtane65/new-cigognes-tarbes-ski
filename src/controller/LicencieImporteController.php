<?php

require_once '../src/utils/EmailSender.php';

class LicencieImporteController
{
    private $licencieImporteModel;
    private $licencieModel;

    public function __construct($licencieImporteModel, $licencieModel)
    {
        $this->licencieImporteModel = $licencieImporteModel;
        $this->licencieModel = $licencieModel;
    }

    public function showImportLicenciesForm()
    {
        require '../src/view/importLicencies.php';
    }

    public function showListeLicenciesImportes()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $licenciesImportes = $this->licencieImporteModel->getAllSortedByLastName();
        require '../src/view/listLicenciesImportes.php';
    }

    public function processImportLicencies()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        if (isset($_FILES['csvFile'])) {
            $csvFile = $_FILES['csvFile']['tmp_name'];

            $fileType = pathinfo($_FILES['csvFile']['name'], PATHINFO_EXTENSION);

            // Vérifier si le fichier est un CSV
            if (strtolower($fileType) !== 'csv') {
                header('Location: /admin/licencies/import?error=invalid_file_type');
                exit();
            }

            if (($handle = fopen($csvFile, "r")) !== FALSE) {

                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    // Convertir la date
                    if (strpos($data[2], '/') !== false) {
                        $dateObject = DateTime::createFromFormat('d/m/Y', $data[2]);
                    } else {
                        // Gestion d'une date Excel numérique
                        $dateObject = DateTime::createFromFormat('Y-m-d', ExcelToPHP($data[2]));
                    }

                    if ($dateObject === false) {
                        // Gérer l'erreur de conversion de la date
                        continue;
                    }

                    $dateNaissance = $dateObject->format('Y-m-d');

                    // Générer un identifiant et un mot de passe
                    //$identifiant = strtolower(str_replace(' ', '.', $data[0] . '.' . $data[1]));
                    //$password = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

                    // Insérer dans la base de données
                    $this->licencieImporteModel->createOne(
                        $data[0], // Nom
                        $data[1], // Prénom
                        $dateNaissance, // Date de naissance convertie en chaîne de caractères
                        $data[3], // Mail
                        $data[4], // Téléphone
                        $data[5], // Adresse
                        $data[6], // Code postal
                        $data[7], // Ville
                        "", // Niveau
                        //$data[8], // Niveau
                        //$password,
                        //$identifiant
                        "", //password
                        "", //identifiant
                    );
                }
                fclose($handle);
                header('Location: /admin/licencies/import?success=import');
            } else {
                header('Location: /admin/licencies/import?error=failed_open_file');
            }
        } else {
            header('Location: /admin/licencies/import?error=no_file');
        }
    }

    public function validerImportLicencies()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $licencieImporte = $this->licencieImporteModel->getOne($id);

        // Générer un identifiant et un mot de passe
        $identifiant = strtolower(str_replace(array(' ', 'á', 'é', 'í', 'ó', 'ú', 'â', 'ê', 'î', 'ô', 'û', 'à', 'è', 'ì', 'ò', 'ù', 'ä', 'ë', 'ï', 'ö', 'ü', 'ÿ', 'ç', 'œ', 'æ'), array('.', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'y', 'c', 'oe', 'ae'), htmlspecialchars($licencieImporte['prenom']) . '.' . htmlspecialchars($licencieImporte['nom'])));
        $password = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        // Insérer dans la base de données
        $created = $this->licencieModel->addLicencie(
            $licencieImporte['nom'], // Nom
            $licencieImporte['prenom'], // Prénom
            $licencieImporte['date_naissance'], // Date de naissance convertie en chaîne de caractères
            $licencieImporte['mail'], // Mail
            $licencieImporte['telephone'], // Téléphone
            $licencieImporte['adresse'], // Adresse
            $licencieImporte['code_postal'], // Code postal
            $licencieImporte['ville'], // Ville
            $licencieImporte['niveau'], // Niveau
            $password,
            $identifiant
        );

        if ($created) {
            // Préparer l'email
            $to =  $licencieImporte['mail']; // Email du licencié
            $subject = "Identifiants CIGOGNES TARBES SKI";
            $message = "Bonjour " . $licencieImporte['prenom'] . ",\n\nVoici vos identifiants pour accéder à votre espace licencié :\nIdentifiant: " . $identifiant . "\nMot de passe: " . $password . "\n\nSelon votre situation, des comptes dits 'enfants' seront rattachés à votre compte.\n\nCordialement,\nL'équipe du Club des Cigognes.";
            $from = "contact@cigognes-tarbes-ski.fr";
            $fromName = "Cigognes Tarbes Ski";
            // Envoyer l'email
            EmailSender::sendMail($to, $subject, $message, $from, $fromName);

            // Supprimer le licencié importé
            $this->licencieImporteModel->deleteOne($id);

            header('Location: /admin/licencies/importes?success=valide_import');
        } else {
            header('Location: /admin/licencies/importes?error=failed_validate_import');
        }
    }
}

function ExcelToPHP($excelDate)
{
    // Assurez-vous que $excelDate est un nombre
    if (!is_numeric($excelDate)) {
        // Si ce n'est pas un nombre, vous pouvez retourner une date par défaut ou gérer l'erreur
        return null; // Ou gérer l'erreur
    }

    $unixDate = ($excelDate - 25569) * 86400;
    return gmdate("Y-m-d", $unixDate);
}
