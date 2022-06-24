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
            $erreurInterne = "Erreur interne lors de la récupération des établissements";
        }
        require_once $vuesDirection . 'mesEtablissements.php';
    break;

    case 'etablissement':
        $idEtablissement = (int)$_REQUEST['id'];
        try {
            $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
        } catch (PDOException $th) {
            $erreurInterne = "Etablissement inexistant ou impossible de le récupérer";
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
            $erreurInterne = "Impossible de supprimer l'établissement pour le moment";
            require_once $vues . '404.php';
        }
    break;

    case 'listeUtilisateurs':
        $idEtablissement = (int)$_REQUEST['id'];
        try {
            $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
            $lesUtilisateurs = $pdo->getLesUtilisateurs();
            $id = (int)$leEtablissement['id'];
            $nom = htmlentities($leEtablissement['nom']);
            $effectif = (int)$leEtablissement['effectif'];
            $description = htmlentities($leEtablissement['description']);
            $dateCreation = htmlentities($leEtablissement['dateCreation']);
        } catch (\Throwable $th) {
            $erreurs['recup_etablissement'] = "Erreur interne, veuillez réessayez plus-tard";
        }

        require_once $vuesDirection . 'listeUtilisateurs.php';
    break;

    case 'utilisateur':
        try {
            $idUtilisateur = htmlentities($_REQUEST['identifiant']);
            $utilisateur = $pdo->getInfosUser($idUtilisateur);
            $nom = htmlentities($utilisateur['nom']);
            $prenom = htmlentities($utilisateur['prenom']);
            $typeUtilisateur = htmlentities($utilisateur['type']);
            $sexe = htmlentities($utilisateur['sexe']);
            $dateCreation = htmlentities($utilisateur['dateCreation']);

            // infos spécifique
            switch ($typeUtilisateur) {
                case 'eleve':
                    $eleve = $pdo->getEleve($idUtilisateur);
                    $etablissementRattache = $eleve['etablissement_rattache'];
                    $classe = $eleve['classe'];
                break;

                case 'professeur':
                    # code...
                break;
                    
                default:
                    $erreur = "Cet utilisateur n'est rattaché à aucune catégorie";
                break;
            }
        } catch (PDOException $th) {
            $erreur = "Impossible de récupérer les informations de l'utilisateur";
        }

        require_once $vues . 'ficheUtilisateur.php';
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