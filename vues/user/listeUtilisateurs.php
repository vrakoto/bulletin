<?php if (isset($erreurInterne)) : ?>
    <h1><?= $erreurInterne ?></h1>
<?php else: ?>
    <?php if (isset($_REQUEST['idEtablissement'])) :
        require_once ELEMENTS . 'parts' . DIRECTORY_SEPARATOR . 'etablissementReadOnly.php' ?>
        <hr class="spaceInAddUser">
    <?php endif ?>

    <div class="spaceInAddUser">
        <table>
            <caption class="titleTable">Liste des utilisateurs</caption>
            <thead>
                <tr>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Etablissement</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lesUtilisateurs as $utilisateur) :
                    $id = htmlentities($utilisateur['identifiant']);
                    $nom = htmlentities($utilisateur['nom']);
                    $prenom = htmlentities($utilisateur['prenom']);
                ?>
                    <tr class="utilisateur">
                        <td><img src="https://picsum.photos/80"></td>
                        <td><?= $utilisateur['nom'] ?></td>
                        <td><?= $utilisateur['prenom'] ?></td>
                        <td>???</td>
                        <td>???</td>
                        <td>
                            <a class="btn primary" href="index.php?p=utilisateur&identifiant=<?= $id ?>"><i class="fa-solid fa-folder-open"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>