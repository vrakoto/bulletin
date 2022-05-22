<?php

class Direction extends Commun {
    protected int $id;

    function __construct()
    {
        parent::__construct();
        $this->id = $_SESSION['id'];
    }

    function mesEtablissements(): array
    {
        $req = "SELECT * FROM etablissement WHERE idProprio = " . $this->id;
        $p = $this->pdo->query($req);
        return $p->fetchAll();
    }

    function supprimerEtablissement(int $id): bool
    {
        $req = "DELETE FROM etablissement WHERE id = :id AND idProprio = " . $this->id;
        $p = $this->pdo->prepare($req);
        return $p->execute(['id' => $id]);
    }
}