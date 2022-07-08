<div class="center">
    <div class="formUser readOnly">
        <h3><?= "#" . (int)$leEtablissement['id'] ?></h3>
        <hr>

        <label for="nomEtablissement">Nom de l'établissement</label>
        <input type="text" name="nomEtablissement" value="<?= $nom ?>" disabled>

        <label for="effectif">Effectif</label>
        <input type="number" name="effectif" value="<?= $effectif ?>" step="1" min="1" max="45000" disabled>

        <label for="description">Description</label>
        <textarea name="description" id="description" disabled><?= $description ?></textarea>

        <a href="index.php?p=etablissement&id=<?= $id ?>" class="btn primary">Consulter</a>
    </div>
</div>