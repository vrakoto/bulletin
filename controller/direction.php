<?php
require_once BDD . 'Direction.php';
require_once BDD . 'Etablissement.php';

define("VUES_DIRECTION", VUES_USER . 'direction' . DIRECTORY_SEPARATOR);

$direction = new Direction;

switch ($vue) {
    case 'accueil':
        require_once VUES_DIRECTION . 'accueil.php';
    break;

    case 'creerEtablissement':
        require_once VUES_DIRECTION . 'creerEtablissement.php';
    break;

    case 'mesEtablissements':
        try {
            $mesEtablissements = $direction->mesEtablissements();
        } catch (PDOException $th) {
            $erreurInterne = "Erreur interne lors de la récupération des établissements";
        }
        require_once VUES_DIRECTION . 'mesEtablissements.php';
    break;

    case 'supprimerEtablissement':
        if (isset($_REQUEST['id'])) {
            $idEtablissement = (int)$_REQUEST['id'];
            try {
                $direction->supprimerEtablissement($idEtablissement);
                header("Location:index.php?p=mesEtablissements");
                exit();
            } catch (\Throwable $th) {
                $erreurInterne = "Impossible de supprimer l'établissement pour le moment";
                require_once VUES . '505.php';
            }
        }
    break;

    default:
        $erreurPage = $vue;
    break;
}