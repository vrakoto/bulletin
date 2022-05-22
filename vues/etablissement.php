<?php
    if (!empty($_POST)) {
        $id = (int)$_REQUEST['id'];
        $nom = htmlentities($_POST['nomEtablissement']);
        $effectif = (int)$_POST['effectif'];
        $description = htmlentities($_POST['description']);

        $etablissement = new Etablissement($nom, $effectif, $description);

        $lesErreurs = $etablissement->verifierEtablissement();
        if (!empty($lesErreurs)) {
            $erreurs['formulaire'] = "Erreur formulaire incorrect";
        } else {
            try {
                $etablissement->modifierEtablissement($id);
                header('Refresh:0');
                exit();
            } catch (PDOException $th) {
                $erreurs['pdo'] = "Impossible de modifier l'établissement, réessayez-plus târd";
            }
        }
    }
?>

<div class="container">

    <?php if (!empty($erreurs)): ?>
        <div class="erreurs">
            <?php foreach ($erreurs as $erreur): ?>
                <h3><?= $erreur ?></h3>
                <?php if (isset($erreur['formulaire'])): ?>
                    <ul style="list-style: inside;">
                        <?php foreach ($lesErreurs as $e): ?>
                        <li><?= $e ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <div class="cardEtablissement">
        <h3><?= "#" . $leEtablissement['id'] ?></h3>
        <h3><?= $leEtablissement['nom'] ?></h3>
        <h3><?= $leEtablissement['effectif'] ?></h3>
        <h3><?= $leEtablissement['description'] ?></h3>
        <h3><?= $leEtablissement['dateCreation'] ?></h3>

        <hr>
        
        <form method="post">
            <label for="nomEtablissement">Nom de l'établissement</label>
            <input type="text" name="nomEtablissement" value="<?= $leEtablissement['nom'] ?>">

            <label for="effectif">Effectif</label>
            <input type="text" name="effectif" value="<?= $leEtablissement['effectif'] ?>">

            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $leEtablissement['description'] ?></textarea>

            <button class="btnConnexion" type="submit">Modifier</button>
        </form>
        <a class="btn btnConnexion suppression" href="index.php?p=supprimerEtablissement&id=<?= (int)$leEtablissement['id'] ?>">Supprimer</a>
    </div>
</div>