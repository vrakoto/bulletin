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
        if (isset($_SESSION['identifiant'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getInfosUser(string $identifiant): array
    {
        $req = "SELECT * FROM utilisateur
                WHERE identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $identifiant,
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
        $req = "SELECT * FROM etablissement
                WHERE id = :id";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $id,
        ]);

        return $p->fetch();
    }

    function rechercherEtablissement(string $recherche): array
    {
        $req = "SELECT * FROM etablissement
                WHERE nom LIKE ?
                ORDER BY nom";
        $param = "%$recherche%";

        $p = $this->pdo->prepare($req);
        $p->bindParam(1, $param);
        $p->execute();

        return $p->fetchAll();
    }

    function getNbEleves(int $idEtablissement): int
    {
        $req = "SELECT count(*) as nbEleve
                FROM etablissement
                JOIN eleve on etablissement.id = eleve.idEtablissement
                WHERE etablissement.id = :id";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $idEtablissement,
        ]);

        return $p->fetch()['nbEleve'];
    }

    function getEleve(string $idEleve): array
    {
        $req = "SELECT * FROM eleve e
                JOIN utilisateur u on e.identifiant = u.identifiant
                WHERE u.identifiant = :identifiant";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $idEleve,
        ]);

        return $p->fetch();
    }
}