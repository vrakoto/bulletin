<div class="containerUser">
    <table>
        <caption>Liste des établissements</caption>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Effectif</th>
                <th scope="col">Description</th>
                <th scope="col">Date de création</th>
                <th scope="col">Réputation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lesEtablissements as $etablissement):
                $idEtablissement = (int)$etablissement['id'];
                $nom = htmlentities($etablissement['nom']);
                $effectif = (int)$etablissement['effectif'];
                try {
                    $nbEleves = $pdo->getNbEleves($idEtablissement);
                } catch (PDOException $th) {
                    $erreur = "Erreur interne lors du calcul de nombre d'élèves dans un établissement";
                }
                $description = htmlentities($etablissement['description']);
                $dateCreation = htmlentities($etablissement['dateCreation']);
                // $reputation = htmlentities($etablissement['reputation']); 
            ?>
                <tr class="utilisateur">
                    <td><?= $nom ?></td>
                    <td><?= $effectif ?></td>
                    <td><?= $description ?></td>
                    <td><?= $dateCreation ?></td>
                    <td>Avis</td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>