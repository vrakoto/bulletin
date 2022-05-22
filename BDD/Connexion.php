<?php

class Connexion extends Commun {
    private int $id;
    private string $mdp;

    function __construct(int $id, string $mdp)
    {
        parent::__construct();
        $this->id = $id;
        $this->mdp = $mdp;
    }

    function auth_valid(): bool
    {
        $req = "SELECT id, mdp FROM utilisateur WHERE id = :id";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $this->id,
        ]);

        return !empty($p->fetch()) && password_verify($this->mdp, $this->getInfosUser($this->id)['mdp']);
    }
}