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

    function verifierConnexion(): bool
    {
        $req = "SELECT id, mdp FROM utilisateur WHERE id = :id AND mdp = :mdp";
        $p = $this->pdo->prepare($req);
        $p->execute([
            'id' => $this->id,
            'mdp' => password_verify($this->mdp, $this->getInfosUser($this->id)['mdp'])
        ]);

        $datas = $p->fetch();
        return !empty($datas);
    }
}