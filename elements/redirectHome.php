<?php
if (isset($_REQUEST['type'])) {
    $type = htmlentities(strtolower($_REQUEST['type']));

    switch ($type) {
        case 'direction':
            $_SESSION['icon'] = "fas fa-user-cog";
            $icon = $_SESSION['icon'];
        break;

        case 'professeur':
            $_SESSION['icon'] = "fas fa-user-tie";
            $icon = $_SESSION['icon'];
        break;

        case 'etudiant':
            $_SESSION['icon'] = "fas fa-user-graduate";
            $icon = $_SESSION['icon'];
        break;
    }
}