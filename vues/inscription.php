<?php
    $lesErreurs = [];
    if (isset($_POST['identifiant'], $_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['sexe'], $_POST['mdp'], $_POST['mdp_c'])) {
        $identifiant = htmlentities($_POST['identifiant']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $age = (int)$_POST['age'];
        $sexe = htmlentities($_POST['sexe']);
        $mdp = htmlentities($_POST['mdp']);
        $mdp_c = htmlentities($_POST['mdp_c']);

        try {
            $inscription = new Inscription($icon, $identifiant, $nom, $prenom, $age, $sexe, $type, $mdp, $mdp_c);
            $lesErreurs = $inscription->verifierInscription();

            if (!empty($lesErreurs)) {
                $erreurs = "Formulaire invalide";
            } else {
                $inscription->inscrire();
                header('Location:index.php?p=connexion&type=' . $type);
                exit();
            }
        } catch (PDOException $th) {
            $erreurs = "Erreur interne, veuillez réessayez plus-tard";
        }
    }
?>

<div class="container">

    <?php if (isset($erreurs)): ?>
    <div class="messageSubmit error">
        <h3><?= $erreurs ?></h3>
        <ul>
            <?php foreach ($lesErreurs as $erreur): ?>
                <li><?= $erreur ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php endif ?>

    <div class="connexion">
        <a href="index.php?p=connexion&type=<?= $type ?>"><- Revenir</a>
        <h3 class="espaceConnexion">Inscription <?= ucfirst($type) ?></h3>
        <i class="<?= $icon ?> icon"></i>

        <img class="separatorConnexion" src="src/separator.png" alt="Séparateur">

        <form class="formConnexion" method="POST">
            <?= display_error_input('', 'text', $lesErreurs, 'identifiant', '', "placeholder='Identifiant' autofocus") ?>
            <?= display_error_input('', 'text', $lesErreurs, 'nom', '', "placeholder='Nom'") ?>
            <?= display_error_input('', 'text', $lesErreurs, 'prenom', '', "placeholder='Prénom'") ?>
            <?= display_error_input('', 'number', $lesErreurs, 'age', '', "placeholder='Age' min='7' max='65'") ?>
            
            <select class="selectForm" name="sexe">
                <option value="none" selected>Sélectionnez votre sexe</option>
                <option value="H">Homme</option>
                <option value="F">Femme</option>
            </select>

            <?= display_error_input('', 'password', $lesErreurs, 'mdp', '', "placeholder='Mot de passe'") ?>
            <?= display_error_input('', 'password', $lesErreurs, 'mdp_c', '', "placeholder='Confirmez le mot de passe'") ?>
            
            <button class="primary" type="submit">S'inscrire</button>
        </form>
    </div>
</div>