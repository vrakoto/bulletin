<?php

class Inscription extends Commun {
    private string $avatar;
    private string $nom;
    private string $prenom;
    private int $age;
    private string $sexe;
    private string $type;
    private string $mdp;
    private string $mdp_c;

    function __construct(string $avatar, string $nom, string $prenom, int $age, string $sexe, string $type, string $mdp, string $mdp_c)
    {
        parent::__construct();
        $this->avatar = $avatar;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->sexe = $sexe;
        $this->type = $type;
        $this->mdp = $mdp;
        $this->mdp_c = $mdp_c;
    }

    function verifierInscription(): array
    {
        $erreurs = [];
        if (strlen($this->nom) < 3) {
            $erreurs['nom'] = 'Le nom est trop court';
        }

        if (strlen($this->prenom) < 3) {
            $erreurs['prenom'] = 'Le prenom est trop court';
        }

        if ($this->age <= 8 || $this->age > 65) {
            $erreurs['age'] = "L'âge est incorrect";
        }

        if ($this->sexe !== 'H' && $this->sexe !== 'F') {
            $erreurs['sexe'] = "Le sexe est incorrect";
        }

        if (mb_strlen($this->mdp) < 3 || mb_strlen($this->mdp) > 300) {
            $erreurs['mdp'] = "Le mot de passe doit être supérieur à 3 caractères et inférieur à 300";
        }

        if ($this->mdp_c !== $this->mdp) {
            $erreurs['mdp_c'] = "Les mots de passe ne correspondent pas";
        }

        return $erreurs;
    }

    function inscrire(): bool
    {
        $req = "INSERT INTO utilisateur (avatar, nom, prenom, age, sexe, type, mdp) VALUES (:avatar, :nom, :prenom, :age, :sexe, :type, :mdp)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'avatar' => $this->avatar,
            'nom' => strtoupper($this->nom),
            'prenom' => strtolower($this->prenom),
            'age' => $this->age,
            'sexe' => $this->sexe,
            'type' => $this->type,
            'mdp' => password_hash($this->mdp, PASSWORD_DEFAULT, ['cost' => 12])
        ]);
    }
}