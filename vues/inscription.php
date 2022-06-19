<?php
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['age'], $_POST['sexe'], $_POST['mdp'], $_POST['mdp_c'])) {
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $age = (int)$_POST['age'];
        $sexe = htmlentities($_POST['sexe']);
        $mdp = htmlentities($_POST['mdp']);
        $mdp_c = htmlentities($_POST['mdp_c']);

        $inscription = new Inscription($icon, $nom, $prenom, $age, $sexe, $type, $mdp, $mdp_c);
        $lesErreurs = $inscription->verifierInscription();

        if (!empty($lesErreurs)) {
            $erreurs = TRUE;
        } else {
            $inscription->inscrire();
            header('Location:index.php?p=connexion&type=' . $type);
            exit();
        }
    }
?>

<div class="container">

    <?php if (isset($erreurs)): ?>
    <div class="messageSubmit error">
        <h3>Erreur formulaire</h3>
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
            <input type="text" name="nom" placeholder="Nom" autofocus>
            <input type="text" name="prenom" placeholder="Prénom">
            <input type="number" name="age" min="7" placeholder="Age">
            
            <select name="sexe">
                <option value="none" selected>Sélectionnez votre sexe</option>
                <option value="H">Homme</option>
                <option value="F">Femme</option>
            </select>
            
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="password" name="mdp_c" placeholder="Confirmez le mot de passe">

            <button class="primary" type="submit">S'inscrire</button>
        </form>
    </div>
</div>