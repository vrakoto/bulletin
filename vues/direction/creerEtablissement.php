<?php
$lesErreurs = [];
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
            <?= display_error_input("Nom de l'établissement", "text", $lesErreurs, "nom", "nomEtablissement", "autofocus") ?>
            <?= display_error_input("Effectif maximum", "number", $lesErreurs, "effectif", "effectif", "step='1' min='1' max='45000'") ?>
            <?= display_error_input("Description", "textarea", $lesErreurs, "description", "description", "step='1' min='1' max='45000'") ?>
            <button type="submit" class="primary">Créer</button>
        </form>
    </div>