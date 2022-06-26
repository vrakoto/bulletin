<?php
    $lesErreurs = [];
    if (isset($_POST['identifiant'], $_POST['mdp'])) {
        $identifiant = htmlentities($_POST['identifiant']);
        $mdp = htmlentities($_POST['mdp']);

        try {
            $connexion = new Connexion($identifiant, $mdp, $type);

            if (!$connexion->auth_valid()) {
                $lesErreurs['auth'] = "Authentification incorrect";
            } else {
                $_SESSION['identifiant'] = $identifiant;
                header('Location:index.php');
                exit();
            }
        } catch (PDOException $th) {
            $lesErreurs['pdo'] = "Erreur interne, veuillez réessayez plus-tard";
        }
    }
?>

<div class="container">

    <?php if (!empty($lesErreurs) && isset($lesErreurs)): ?>
        <div class="messageSubmit error">
            <h3>Formulaire invalide</h3>
            <ul>
                <?php foreach ($lesErreurs as $erreur): ?>
                    <li><?= $erreur ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <div class="connexion">
        <a href="index.php"><- Revenir</a>
        <h3 class="espaceConnexion">Espace <?= ucfirst($type) ?></h3>

        <img class="separatorConnexion" src="src/separator.png" alt="Séparateur">

        <form class="formConnexion" method="POST">
            <input type="text" name="identifiant" placeholder="Identifiant" autofocus>
            <input type="password" name="mdp" placeholder="Mot de passe">

            <button class="primary" type="submit">Connexion</button>
        </form>
        <br>
        <a class="btnInscription" href="index.php?p=inscrire&type=<?= $type ?>">M'inscrire</a>
    </div>
</div>

<?php
    foreach ($pdo->getLesUtilisateurs() as $u) {
        if ($type === $u['type']) {
            echo '<br>';
            echo $u['identifiant'] . ' ';
            echo $u['prenom'];
        }
    }
?>