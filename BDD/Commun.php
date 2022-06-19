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

    function getLesUtilisateurs(): array
    {
        $req = "SELECT * FROM utilisateur";
        $p = $this->pdo->query($req);

        return $p->fetchAll();
    }

    function getLesEtablissements(): array
    {
        $req = "SELECT * FROM etablissement ORDER BY id";
        $p = $this->pdo->query($req);

        return $p->fetchAll();
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

    function rechercherEtablissement(string $recherche): array
    {
        $req = "SELECT id, nom, effectif, description FROM etablissement WHERE nom LIKE ? ORDER BY nom";
        $param = "%$recherche%";

        $p = $this->pdo->prepare($req);
        $p->bindParam(1, $param);
        $p->execute();

        return $p->fetchAll();
    }
}