<?php
    if (isset($_POST['id'], $_POST['mdp'])) {
        $id = (int)$_POST['id'];
        $mdp = htmlentities($_POST['mdp']);

        $connexion = new Connexion($id, $mdp);
        $lesErreurs = $connexion->verifierConnexion();

        if (!empty($lesErreurs)) {
            $erreur = TRUE;
        } else {
            $_SESSION['id'] = $id;
            header('Location:index.php');
            exit();
        }
    }
?>

<div class="container">
    <div class="connexion">
        <a href="index.php"><- Revenir</a>
        <h3 class="espaceConnexion">Espace <?= ucfirst($type) ?></h3>
        <i class="<?= $icon ?> connexionIcon"></i>

        <img class="separatorConnexion" src="src/separator.png" alt="Séparateur">

        <form class="formConnexion" method="POST">
            <input type="text" name="id" placeholder="Identifiant">
            <input type="password" name="mdp" placeholder="Mot de passe">

            <button class="btnConnexion" type="submit">Connexion</button>
        </form>
        <br>
        <a class="btnInscription" href="index.php?p=inscrire&type=<?= $type ?>">M'inscrire</a>
    </div>
</div>