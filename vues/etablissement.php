<?php
    if (!empty($_POST)) {
        $id = (int)$_REQUEST['id'];
        $nom = htmlentities($_POST['nomEtablissement']);
        $effectif = (int)$_POST['effectif'];
        $description = htmlentities($_POST['description']);

        $etablissement = new Etablissement($nom, $effectif, $description);

        $lesErreurs = $etablissement->verifierEtablissement();
        if (!empty($lesErreurs)) {
            $erreur = "Formulaire invalide";
        } else {
            try {
                $etablissement->modifierEtablissement($id);
                header('Refresh:0');
                exit();
            } catch (PDOException $th) {
                $erreur = "Erreur interne, réessayez-plus târd";
            }
        }
    }
?>

<?php if (isset($erreurInterne)): ?>
    <?= $erreurInterne ?>
<?php else: ?>

<div class="containerUser">
    <?php if (isset($erreur)) : ?>
        <div class="center">
            <div class="messageSubmit error">
                <h3><i class="fa-solid fa-triangle-exclamation"></i> <?= $erreur ?></h3>

                <?php if (!empty($lesErreurs)): ?>
                    <ul>
                        <?php foreach ($lesErreurs as $erreur) : ?>
                            <li><?= $erreur ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>

    <a href="index.php?p=mesEtablissements" class="iconNavigate"><i class="fa-solid fa-arrow-left"></i> Revenir</a>

    <div class="center">
        <form method="post" class="formUser">
            <h3><?= "#" . (int)$leEtablissement['id'] ?></h3>
            <hr>

            <label for="nomEtablissement">Nom de l'établissement</label>
            <input type="text" id="nomEtablissement" name="nomEtablissement" value="<?= $leEtablissement['nom'] ?>" autofocus>

            <label for="effectif">Effectif</label>
            <input type="number" name="effectif" value="<?= $leEtablissement['effectif'] ?>" step="1" min="1" max="45000">

            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $leEtablissement['description'] ?></textarea>

            <button class="primary" type="submit">Modifier</button>
            <a class="btn btnRed" href="index.php?p=supprimerEtablissement&id=<?= (int)$leEtablissement['id'] ?>">Supprimer</a>
        </form>
    </div>
</div>
<?php endif ?>