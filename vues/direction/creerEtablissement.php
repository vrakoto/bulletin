<?php
if (isset($_POST['nom'], $_POST['effectif'], $_POST['description'])) {
    $nom = htmlentities($_POST['nom']);
    $effectif = (int)$_POST['effectif'];
    $description = htmlentities($_POST['description']);

    $etablissement = new Etablissement($nom, $effectif, $description);
    $lesErreurs = $etablissement->verifierEtablissement();

    if (!empty($lesErreurs)) {
        $erreurs = TRUE;
    } else {
        try {
            $etablissement->creer();
            header("Location:index.php?p=gestionEtablissement");
            exit();
        } catch (PDOException $th) {
            $erreur = TRUE;
            var_dump($th->getMessage());
        }
    }
}
?>

<div class="container">

    <?php if (isset($erreur)) : ?>
        <div class="erreurs">
            <h3>Erreur général, veuillez réessayez plus-tard</h3>
        </div>
    <?php endif ?>

    <?php if (isset($erreurs)) : ?>
        <div class="erreurs">
            <h3>Erreur formulaire</h3>
            <ul style="list-style: inside;">
                <?php foreach ($lesErreurs as $erreur) : ?>
                    <li><?= $erreur ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form method="post">
        <div>
            <input type="text" name="nom" placeholder="Nom de l'établissement" autofocus>
        </div>
        <div>
            <input type="number" name="effectif" step="1" min="1" max="45000" placeholder="Effectif maximum">
        </div>
        <textarea name="description" placeholder="Description de l'établissement"></textarea>

        <button type="submit">Créer</button>
    </form>
</div>