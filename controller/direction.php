<?php
require_once $bdd . 'Direction.php';
require_once $bdd . 'Etablissement.php';

$vuesDirection = $root . 'vues' . DIRECTORY_SEPARATOR . 'direction' . DIRECTORY_SEPARATOR;

$direction = new Direction;

switch ($vue) {
    case 'accueil':
        require_once $vuesDirection . 'accueil.php';
    break;

    case 'creerEtablissement':
        require_once $vuesDirection . 'creerEtablissement.php';
    break;

    case 'mesEtablissements':
        try {
            $mesEtablissements = $direction->mesEtablissements();
        } catch (PDOException $th) {
            $erreur = TRUE;
        }
        require_once $vuesDirection . 'mesEtablissements.php';
    break;

    case 'etablissement':
        $idEtablissement = (int)$_REQUEST['id'];
        $erreurs = [];
        try {
            $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
        } catch (PDOException $th) {
            $erreurs['recup_etablissement'] = "Etablissement inexistant ou impossible de le récupérer";
        }
        require_once $vues . 'etablissement.php';
    break;

    case 'supprimerEtablissement':
        $idEtablissement = (int)$_REQUEST['id'];
        try {
            $direction->supprimerEtablissement($idEtablissement);
            header("Location:index.php?p=mesEtablissements");
            exit();
        } catch (PDOException $th) {
            $erreur = "Impossible de supprimer l'établissement pour le moment";
        }
    break;

    case 'ajouterUtilisateur':
        $idEtablissement = (int)$_REQUEST['id'];
        require_once $vuesDirection . 'ajouterUtilisateur.php';
    break;

    case 'deconnexion': 
        session_destroy();
        header("Location:index.php");
        exit();
    break;
    
    default:
        # code...
    break;
}