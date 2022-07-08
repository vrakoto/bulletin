<?php
    $lesErreurs = [];
    if (isset($_POST['recherche'])) {
        $recherche = htmlentities(strtoupper($_POST['recherche']));
        try {
            $lesEtablissements = $pdo->rechercherEtablissement($recherche);
        } catch (PDOException $th) {
            $lesErreurs['interne'] = "Impossible de rechercher un établissement";
        }
    }
?>

<?php if (!empty($lesErreurs)): ?>
    <div class="messageSubmit error">
        <h3>Erreur 505</h3>
        <ul>
            <?php foreach ($lesErreurs as $erreur): ?>
                <li><?= $erreur ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form method="post" class="formSearch">
    <h1>Rechercher un établissement</h1>
    <input type="text" name="recherche" placeholder="Rechercher le nom" autofocus value="<?php if (isset($_POST['recherche'])):?><?= htmlentities($_POST['recherche']) ?><?php endif ?>">
    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>

<table>
    <caption class="titleTable">Liste des établissements</caption>
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Effectif</th>
            <th scope="col">Date de création</th>
            <th scope="col">Réputation</th>
            <th scope="col">Consulter</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lesEtablissements as $etablissement):
            $idEtablissement = (int)$etablissement['id'];
            $nom = htmlentities($etablissement['nom']);
            $effectif = (int)$etablissement['effectif'];
            $nbEleves = $pdo->getNbEleves($idEtablissement);

            $dateCreation = htmlentities($etablissement['dateCreation']);
            $date = format_date($dateCreation);
            // $reputation = htmlentities($etablissement['reputation']); 
        ?>
            <tr class="utilisateur">
                <td><?= $nom ?></td>
                <td><?= $effectif ?></td>
                <td><?= $date ?></td>
                <td>Avis</td>
                <td><a class="btn primary" href="index.php?p=etablissement&id=<?= $idEtablissement ?>"><i class="fa-solid fa-folder-open"></i></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>