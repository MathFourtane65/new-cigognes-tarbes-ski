<?php
class RelationsComptesController
{
    private $relationsComptesModel;
    private $licencieModel;

    public function __construct($relationsComptesModel, $licencieModel)
    {
        $this->relationsComptesModel = $relationsComptesModel;
        $this->licencieModel = $licencieModel;
    }

    public function showListeRelations()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $relations = $this->relationsComptesModel->getAllRelationsWithNomAndPrenom();
        require '../src/view/listRelationsComptes.php';
    }

    public function showCreateRelationForm()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }
        $licencies = $this->licencieModel->getAllLicenciesSortedByLastName();
        require '../src/view/create-relations-comptes.php';
    }

    public function processAddRelations()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $parentId = filter_input(INPUT_POST, 'parent_id', FILTER_SANITIZE_NUMBER_INT);
        $childrenIds = filter_input(INPUT_POST, 'children_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

        if ($parentId && !empty($childrenIds)) {
            foreach ($childrenIds as $childId) {
                $this->relationsComptesModel->addRelation($parentId, $childId);
            }
        }

        header("Location: /admin/relations-comptes/new?success=create");
    }

    public function deleteRelation()
    {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: /connexion-admin");
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $deleted = $this->relationsComptesModel->deleteRelation($id);

        if ($deleted) {
            header('Location: /admin/relations-comptes?success=delete');
        } else {
            header('Location: /admin/relations-comptes?error=failed_delete');
        }
    }
}
