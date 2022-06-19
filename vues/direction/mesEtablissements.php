<div class="containerListe">

    <?php if (count($mesEtablissements) <= 0): ?>
        <a href="index.php?p=creerEtablissement">Aucun établissement à votre nom, créez-en un dès maintenant !</a>
    <?php endif ?>

    <?php foreach ($mesEtablissements as $etablissement):
        $id = (int)$etablissement['id'];
        $nom = htmlentities($etablissement['nom']);        
        $effectif = (int)$etablissement['effectif'];        
        $description = htmlentities($etablissement['description']);        
        $dateCreation = htmlentities($etablissement['dateCreation']);        
    
    ?>
        <div class="cardEtablissement">
            <h3><?= $nom ?></h3>
            <h3><?= $effectif ?></h3>
            <h3><?= $description ?></h3>
            <h3><?= $dateCreation ?></h3>

            <div class="actions">
                <a href="index.php?p=ajouterUtilisateur&id=<?= $id ?>"><i class="fa-solid fa-user-plus" style="color: green;"></i></a>
                <a href="index.php?p=etablissement&id=<?= $id ?>"><i class="fa-solid fa-file-pen"></i></i></a>
                <a href="index.php?p=supprimerEtablissement&id=<?= $id ?>"><i class="fa-solid fa-trash" style="color: red"></i></a>
            </div>
        </div>
    <?php endforeach ?>
</div>