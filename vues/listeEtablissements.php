<?php
    if (isset($_POST['recherche'])) {
        $laRecherche = htmlentities($_POST['recherche']);
        $lesEtablissements = $pdo->rechercherEtablissement($laRecherche);
    }

?>

<div class="container">
    <form method="post">
        <input type="text" name="recherche" placeholder="Rechercher le nom">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <table>
        <thead>
            <tr>
                <th>NOM</th>
                <th>Effectif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lesEtablissements as $etablissement): ?>
                <tr>
                    <td><?= htmlentities($etablissement['nom']) ?></td>
                    <td><?= (int)$etablissement['effectif'] ?></td>
                    <td><a href="index.php?p=etablissement&id=<?= (int)$etablissement['id'] ?>"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>