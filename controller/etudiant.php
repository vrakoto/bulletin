<?php
$vuesEtudiant = $root . 'vues' . DIRECTORY_SEPARATOR . 'eleve' . DIRECTORY_SEPARATOR;

switch ($vue) {
    case 'accueil':
        require_once $vuesEtudiant . 'accueil.php';
    break;

    case 'listeEtablissements':
        $lesEtablissements = $pdo->getLesEtablissements();
        require_once $vues . 'listeEtablissements.php';
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

    case 'deconnexion':
        session_destroy();
        header("Location:index.php");
        exit();
    break;
    
    default:
        # code...
    break;
}