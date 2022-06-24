<?php

class Direction extends Commun {
    protected string $identifiant;

    function __construct()
    {
        parent::__construct();
        $this->identifiant = $_SESSION['identifiant'];
    }

    function mesEtablissements(): array
    {
        $req = "SELECT * FROM etablissement
                WHERE idProprio = :identifiant";

        $p = $this->pdo->prepare($req);
        $p->execute(['identifiant' => $this->identifiant]);

        return $p->fetchAll();
    }

    function supprimerEtablissement(int $idEtablissement): bool
    {
        $req = "DELETE FROM etablissement
                WHERE id = :idEtablissement
                AND idProprio = :identifiant";
                
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idEtablissement' => $idEtablissement,
            'identifiant' => $this->identifiant
        ]);
    }
}