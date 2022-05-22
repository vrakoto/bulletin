<div class="container" id="cardEtablissement">

    <?php if (isset($erreur)): ?>
        <div class="erreurs">
            <h3><?= $erreur ?></h3>
        </div>
    <?php endif ?>

    <?php foreach ($mesEtablissements as $etablissement): ?>
        <div class="cardEtablissement">
            <h3><?= $etablissement['nom'] ?></h3>
            <h3><?= $etablissement['effectif'] ?></h3>
            <h3><?= $etablissement['description'] ?></h3>
            <h3><?= $etablissement['dateCreation'] ?></h3>

            <div class="actions">
                <a href="index.php?p=etablissement&id=<?= (int)$etablissement['id'] ?>"><i class="fa-solid fa-folder-open"></i></a>
                <a href="index.php?p=ajouterUtilisateur&id=<?= (int)$etablissement['id'] ?>"><i class="fa-solid fa-file-circle-plus" style="green"></i></a>
                <a href="index.php?p=supprimerEtablissement&id=<?= (int)$etablissement['id'] ?>"><i class="fa-solid fa-trash" style="color: red"></i></a>
            </div>
        </div>
    <?php endforeach ?>
</div>