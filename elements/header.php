<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $css ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="<?= $js ?>" defer></script>
    <title>Bulletin élèves</title>
</head>

<body>
    <?php if ($pdo->is_connect()) : ?>
        <div class="navbar">
            <h4 class="navbar-typeUtilisateur"><?= strtoupper($type) ?></h4>
            <i class="<?= $avatar ?> connexionIcon"></i>
            <h4>ID : <?= $myID ?></h4>
            <h4><?= $nom . ' ' . $prenom ?></h4>

            <h2>Menu</h2>

            <h3>Créer un établissement</h3>
            <h3>Mes établissements</h3>
            <h3>Gestion établissement</h3>

            <a href="index.php?p=deconnexion" class="logout">Déconnexion</a>
        </div>

    <?php endif ?>