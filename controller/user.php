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
        if (isset($_REQUEST['id'])) {
            $idEtablissement = (int)$_REQUEST['id'];
            try {
                $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
            } catch (\Throwable $th) {
                $erreurInterne = "Etablissement inexistant";
            }
        } else {
            header('Location:index.php?p=listeEtablissements');
            exit();
        }

        if (isset($erreurInterne)) {
            require_once VUES . '505.php';
        } else {
            require_once VUES_USER . 'etablissement.php';
        }
    break;

    case 'listeEtablissements':
        $lesEtablissements = $pdo->getLesEtablissements();
        require_once VUES_USER . 'listeEtablissements.php';
    break;

    case 'listeUtilisateurs':
        $lesUtilisateurs = $pdo->getLesUtilisateurs();

        if (isset($_REQUEST['idEtablissement'])) {
            $idEtablissement = (int)$_REQUEST['idEtablissement'];
            try {
                $leEtablissement = $pdo->getLeEtablissement($idEtablissement);
                $id = (int)$leEtablissement['id'];
                $nom = htmlentities($leEtablissement['nom']);
                $effectif = (int)$leEtablissement['effectif'];
                $description = htmlentities($leEtablissement['description']);
                $dateCreation = htmlentities($leEtablissement['dateCreation']);
            } catch (\Throwable $th) {
                $erreurInterne = "Etablissement introuvable";
            }
        }

        if (isset($erreurInterne)) {
            require_once VUES . '404.php';
        } else {
            require_once VUES_USER . 'listeUtilisateurs.php';
        }
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
        } catch (\Throwable $th) {
            $erreur = "Impossible de récupérer les informations de l'utilisateur";
        }

        require_once VUES_USER . 'ficheUtilisateur.php';
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