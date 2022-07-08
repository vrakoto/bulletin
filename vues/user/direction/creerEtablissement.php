<?php
$lesErreurs = [];
if (isset($_POST['nom'], $_POST['effectif'], $_POST['description'])) {
    $nom = $_POST['nom'];
    $effectif = (int)$_POST['effectif'];
    $description = $_POST['description'];

    $etablissement = new Etablissement($nom, $effectif, $description);
    $lesErreurs = $etablissement->verifierEtablissement();

    if (!empty($lesErreurs)) {
        $lesErreurs['titre'] = "Formulaire invalide";
    } else {
        try {
            $etablissement->creer();
            $success = "Etablissement créé !";
        } catch (\Throwable $th) {
            $lesErreurs['pdo'] = "Erreur interne 505, veuillez réessayez plus-tard";
        }
    }
}
?>

<div class="center">
    <?php require_once VUES_ERREUR ?>

    <?php if (isset($success)): ?>
        <div class="messageSubmit success">
            <h3><?= $success ?></h3>
        </div>
    <?php endif ?>

    <form method="post" class="formUser">
        <?= display_error_input("Nom de l'établissement", "text", $lesErreurs, "nom", "nomEtablissement", "autofocus") ?>
        <?= display_error_input("Effectif maximum", "number", $lesErreurs, "effectif", "effectif", "step='1' min='1' max='45000'") ?>
        <?= display_error_input("Description", "textarea", $lesErreurs, "description", "description", "step='1' min='1' max='45000'") ?>
        <button type="submit" class="primary">Créer</button>
    </form>
</div>