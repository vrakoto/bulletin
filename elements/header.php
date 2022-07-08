<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach ($css as $c) : ?>
        <link rel="stylesheet" href="src/<?= $c ?>">
    <?php endforeach ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title><?= $title ?? 'Bulletin élèves' ?></title>
</head>

<body>
    <?php if ($pdo->is_connect()) : ?>
        <nav class="navbar">
            <div class="navbar-infos-user">
                <h4><?= strtoupper($type) ?></h4>
                <i class="<?= $avatar ?> icon avatar"></i>
                <h4>ID : <?= $myID ?></h4>
                <h4><?= $nom . ' ' . $prenom ?></h4>

                <a href="index.php?p=deconnexion" class="btn btnRed logout">Deconnexion</a>
            </div>

            <hr>
            <div class="menu-links">
                <h2 class="navbar-menu-links-title">Menu</h2>

                <div class="navbar-links">
                    <?php if ($type === 'direction') : ?>
                        <?= nav_links("creerEtablissement", "Créer un établissement") ?>
                        <?= nav_links("mesEtablissements", "Mes établissements") ?>
                        <?= nav_links("listeEtablissements", "Liste des établissements") ?>
                        <?= nav_links("listeUtilisateurs", "Liste des utilisateurs") ?>
                        <?php else : if ($type === 'etudiant') : ?>
                            <?= nav_links("listeEtablissements", "Rejoindre un établissement") ?>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>
        </nav>
        <div class="containerUser">
    <?php endif ?>