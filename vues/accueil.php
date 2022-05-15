<!-- <div class="container">
<?php foreach ($lesEleves as $eleve) :
    $nom = htmlentities($eleve['nom']);
    $prenom = htmlentities($eleve['prenom']);
    $classe = htmlentities($eleve['classe']);
    $sexe = htmlentities($eleve['sexe']);
?>
    <div class="unEleve">
        <img src="https://www.scholae.fr/wp-content/uploads/2019/01/avatar-<?= $sexe ?>.jpg">
        <div class="informations">
            <span class="nomPrenom"><?= $nom . $prenom ?></span>
            <p class="classe"><?= $classe ?></p>
        </div>
    </div>
    <hr>
<?php endforeach ?>
</div> -->

<div class="container">
    <div class="lesConnexions">
        <a class="laConnexion" href="index.php?p=connexion&type=direction"><i class="fas fa-user-cog"></i> Direction</a>
        <a class="laConnexion" href="index.php?p=connexion&type=professeur"><i class="fas fa-user-tie"></i> Professeur</a>
        <a class="laConnexion" href="index.php?p=connexion&type=etudiant"><i class="fas fa-user-graduate"></i> Etudiant</a>
    </div>
</div>