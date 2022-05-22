<?php

class Commun {
    protected $pdo;

    function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=bulletin', 'root', null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    function is_connect(): bool
    {
        if (isset($_SESSION['id'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getInfosUser(int $id): array
    {
        $req = "SELECT * FROM utilisateur WHERE id = :id";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $id,
        ]);

        return $p->fetch();
    }

    function getLeEtablissement(int $id): array
    {
        $req = "SELECT * FROM etablissement WHERE id = :id";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $id,
        ]);

        return $p->fetch();
    }
}