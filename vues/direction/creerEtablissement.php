<?php
if (isset($_POST['nom'], $_POST['effectif'], $_POST['description'])) {
    $nom = $_POST['nom'];
    $effectif = (int)$_POST['effectif'];
    $description = $_POST['description'];

    $etablissement = new Etablissement($nom, $effectif, $description);
    $lesErreurs = $etablissement->verifierEtablissement();

    if (!empty($lesErreurs)) {
        $erreur = "Formulaire invalide";
    } else {
        try {
            $etablissement->creer();
            $success = "Etablissement créé !";
        } catch (PDOException $th) {
            $erreur = "Erreur interne 505, veuillez réessayez plus-tard";
        }
    }
}
?>

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

    <?php if (isset($success)): ?>
        <div class="center">
            <div class="messageSubmit success">
                <h3><?= $success ?></h3>
            </div>
        </div>   
    <?php endif ?>

    <div class="center">
        <form method="post" class="formUser">
            <label for="nomEtablissement">Nom de l'établissement</label>
            <input type="text" class="<?php if (isset($lesErreurs['nom'])): ?>invalidField<?php endif ?>" name="nom" id="nomEtablissement" placeholder="Minimum 3 caractères" value="<?php if (!isset($lesErreurs['nom'])): ?><?= $_POST['nom'] ?? '' ?><?php endif ?>" autofocus>

            <label for="effectif">Effectif maximum</label>
            <input type="number" class="<?php if (isset($lesErreurs['effectif'])): ?>invalidField<?php endif ?>" name="effectif" id="effectifMaximum" step="1" min="1" max="45000" value="<?php if (!isset($lesErreurs['effectif'])): ?><?= $effectif ?? '' ?><?php endif ?>" placeholder="Maximum 45.000">

            <label for="description">Description</label>
            <textarea class="<?php if (isset($lesErreurs['description'])): ?>invalidField<?php endif ?>" name="description" id="description" placeholder="Minimum 5 caractères"><?php if (!isset($lesErreurs['description'])): ?><?= $description ?? '' ?><?php endif ?></textarea>

            <button type="submit" class="primary">Créer</button>
        </form>
    </div>