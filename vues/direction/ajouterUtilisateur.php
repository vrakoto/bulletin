<?php
    if (isset($_POST['test'])) {
        print_r( $_POST);
    } else {
        echo "ok";
    }
?>

<form class="listeUtilisateurs" method="post">
    <div class="leUtilisateur">
        <input type="checkbox" name="test" id="">
        <img src="https://picsum.photos/200" alt="Avatar de l'utilisateur">
        <h3>NOM Prénom</h3>
        <h3>Fonction</h3>
        <button type="submit">Test</button>
    </div>
</form>