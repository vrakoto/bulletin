<?php if (!empty($lesErreurs)): ?>
    <div class="messageSubmit error">
        <h3><i class="fa-solid fa-triangle-exclamation"></i> <?= $lesErreurs['titre'] ?></h3>

        <?php if (count($lesErreurs) > 1):
            unset($lesErreurs['titre']); // Evite d'afficher le titre principal de l'erreur dans les erreurs listing
        ?>
        <ul>
            <?php foreach ($lesErreurs as $key => $erreur): ?>
                <li><?= $erreur ?></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
    </div>
<?php endif ?>