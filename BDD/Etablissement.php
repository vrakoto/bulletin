<?php

class Etablissement extends Direction {
    private string $nom;
    private int $effectif;
    private string $description;

    function __construct(string $nom, int $effectif, string $description)
    {
        parent::__construct();
        $this->nom = $nom;
        $this->effectif = $effectif;
        $this->description = $description;
    }

    function verifierEtablissement(): array
    {
        $erreurs = [];
        if (strlen(trim($this->nom)) < 3) {
            $erreurs['nom'] = "Le nom de l'établissement est trop court";
        }

        if ($this->effectif <= 0 || $this->effectif > 45000) {
            $erreurs['effectif'] = "L'effectif doit être comprit entre 0 et 45,000";
        }

        if (strlen(trim($this->description)) <= 5) {
            $erreurs['description'] = "La description est trop courte";
        }

        return $erreurs;
    }

    function creer(): bool
    {
        $req = "INSERT INTO etablissement (idProprio, nom, effectif, description) VALUES (:idProprio, :nom, :effectif, :description)";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'idProprio' => $this->id,
            'nom' => strtoupper($this->nom),
            'effectif' => $this->effectif,
            'description' => $this->description
        ]);
    }

    function modifierEtablissement(int $id): bool
    {
        $req = "UPDATE etablissement SET nom = :nom, effectif = :effectif, description = :description
                WHERE id = :id AND idProprio = :idProprio";
        $p = $this->pdo->prepare($req);
        return $p->execute([
            'id' => $id,
            'idProprio' => $_SESSION['id'],
            'nom' => strtoupper($this->nom),
            'effectif' => $this->effectif,
            'description' => $this->description
        ]);
    }
}