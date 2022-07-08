<?php
if (!empty($_POST)) {
    $id = (int)$_REQUEST['id'];
    $nom = htmlentities($_POST['nomEtablissement']);
    $effectif = (int)$_POST['effectif'];
    $description = htmlentities($_POST['description']);

    $etablissement = new Etablissement($nom, $effectif, $description);

    $lesErreurs = $etablissement->verifierEtablissement();
    if (!empty($lesErreurs)) {
        $lesErreurs['titre'] = "Formulaire invalide";
    } else {
        try {
            $etablissement->modifierEtablissement($id);
            header('Refresh:0');
            exit();
        } catch (\Throwable $th) {
            $lesErreurs['pdo'] = "Erreur interne, réessayez-plus târd";
        }
    }
}
?>

<a href="index.php?p=listeEtablissements" class="iconNavigate"><i class="fa-solid fa-arrow-left"></i> Revenir</a>

<div class="center">

    <?php require_once VUES_ERREUR ?>
    
    <form method="post" class="formUser">
        <h3><?= "#" . (int)$leEtablissement['id'] ?></h3>
        <hr>

        <label for="nomEtablissement">Nom de l'établissement</label>
        <input type="text" id="nomEtablissement" name="nomEtablissement" value="<?= $leEtablissement['nom'] ?>" autofocus>

        <label for="effectif">Effectif</label>
        <input type="number" name="effectif" value="<?= $leEtablissement['effectif'] ?>" step="1" min="1" max="45000">

        <label for="description">Description</label>
        <textarea name="description" id="description"><?= $leEtablissement['description'] ?></textarea>

        <?php if ($type === 'direction') : ?>
            <button class="primary" type="submit">Modifier</button>
            <a class="btn btnRed" href="index.php?p=supprimerEtablissement&id=<?= (int)$leEtablissement['id'] ?>">Supprimer</a>
        <?php else : ?>
            <a class="btn primary" href="index.php?p=postuler&id=<?= (int)$leEtablissement['id'] ?>">Postuler</a>
        <?php endif ?>
    </form>
</div>