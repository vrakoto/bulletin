<?php

class Connexion extends Commun {
    private string $identifiant;
    private string $mdp;
    private string $type;

    function __construct(string $identifiant, string $mdp, string $type)
    {
        parent::__construct();
        $this->identifiant = $identifiant;
        $this->mdp = $mdp;
        $this->type = $type;
    }

    function auth_valid(): bool
    {
        $req = "SELECT identifiant, type, mdp FROM utilisateur WHERE identifiant = :identifiant AND type = :type";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'identifiant' => $this->identifiant,
            'type' => $this->type
        ]);

        $res = $p->fetchAll();
        if (count($res) > 0 && password_verify($this->mdp, $res[0]['mdp'])) {
            return TRUE;
        }
        return FALSE;
    }
}