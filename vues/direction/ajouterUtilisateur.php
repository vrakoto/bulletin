<div class="containerUser">
    <a href="index.php?p=mesEtablissements" class="iconNavigate"><i class="fa-solid fa-arrow-left"></i> Revenir</a>
    <div class="center">
        <div class="formUser readOnly">
            <h3><?= "#" . (int)$leEtablissement['id'] ?></h3>
            <hr>

            <label for="nomEtablissement">Nom de l'établissement</label>
            <input type="text" name="nomEtablissement" value="<?= $nom ?>" disabled>

            <label for="effectif">Effectif</label>
            <input type="number" name="effectif" value="<?= $effectif ?>" step="1" min="1" max="45000" disabled>

            <label for="description">Description</label>
            <textarea name="description" id="description" disabled><?= $description ?></textarea>

            <a href="index.php?p=etablissement&id=<?= $id ?>" class="btn primary">Consulter</a>
        </div>
    </div>

    <hr class="spaceInAddUser">

    <div class="spaceInAddUser">
        <table>
            <caption>Liste des utilisateurs</caption>
            <thead>
                <tr>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Classe</th>
                </tr>
            </thead>
            <tbody>
                <tr class="utilisateur">
                    <td data-label="Account"><img src="https://picsum.photos/80"></td>
                    <td data-label="Due Date">Dupont</td>
                    <td data-label="Amount">Marc</td>
                    <td data-label="Period">Terminale</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>