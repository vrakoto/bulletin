<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elements/style.css">
    <title>Bulletin élèves</title>
</head>
<body>

    <div class="container">
        <?php for ($i = 0; $i < 10; $i++): ?>
            <div class="unEleve">
                <img src="https://www.scholae.fr/wp-content/uploads/2019/01/avatar-male.jpg">
                <!-- <img src="https://www.kindpng.com/picc/m/378-3783625_avatar-woman-blank-avatar-icon-female-hd-png.png"> -->
                <div class="informations">
                    <span class="nomPrenom">NOM Prenom</span>
                    <p class="classe">Classe</p>
                </div>
            </div>
            <hr>
        <?php endfor ?>
    </div>
    
</body>
</html>