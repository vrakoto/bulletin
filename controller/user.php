<?php
switch ($type) {
    case 'direction':
        require_once CONTROLLER . 'direction.php';
    break;

    case 'professeur':
        require_once CONTROLLER . 'professeur.php';
    break;
    
    case 'etudiant':
        require_once CONTROLLER . 'etudiant.php';
    break;
}

$commun = '';
switch ($vue) {
    case 'etablissement':
        $idEtablissement = (int)$_REQUEST['id'];
        try {
            $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
        } catch (PDOException $th) {
            $erreurInterne = "Etablissement inexistant ou impossible de le récupérer";
        }
        require_once VUES . 'etablissement.php';
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

        require_once VUES . 'listeUtilisateurs.php';
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

        require_once VUES . 'ficheUtilisateur.php';
    break;

    case 'deconnexion': 
        session_destroy();
        header("Location:index.php");
        exit();
    break;

    default:
        $common = $vue;
    break;
}

if (isset($common) && $common === $erreurPage) {
    $userErreurPage = TRUE;
}