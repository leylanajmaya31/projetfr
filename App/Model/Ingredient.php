<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Recette;

class Ingredient extends BddConnect{
private ?int $id_ingredient;   
private ?string $nom_ingredient;
private ?string $quantite_ingredient;
private ?string $portion_ingredient;
private ?int $id_utilisateur;

public function getIdIngredient(){
    return $this->id_ingredient;
}
public function setIdIngredient(?int $id):void{
    $this->id_ingredient = $id;
}
public function getNom(){
    return $this->nom_ingredient;
}
public function setNom(?string $nom):void{
    $this->nom_ingredient = $nom;
}
public function getQuantite(){
    return $this->quantite_ingredient;
}
public function setQuantite(?string $quantite):void{
    $this->quantite_ingredient = $quantite;
}
public function getPortion(){
    return $this->portion_ingredient;
}
public function setPortion(?string $portion):void{
    $this->portion_ingredient = $portion;
}
public function getIdUtilisateur(): ?int {
    return $this->id_utilisateur;
}

public function setIdUtilisateur(?int $utilisateur): void {
    $this->id_utilisateur = $utilisateur;
}

public function add(){
    try {
        $nom = $this->getNom();
        $quantite = $this->getQuantite();
        $portion = $this->getPortion();
        $id_ingredient = $this->getIdIngredient();
        $utilisateur = $this->getIdUtilisateur();
        $req = $this->connexion()->prepare('INSERT INTO ingredients(nom_ingredient, quantite_ingredient, portion_ingredient,id_ingredient, id_utilisateur)
        VALUES (?,?,?,?,?)');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->bindParam(2, $quantite, \PDO::PARAM_STR);
        $req->bindParam(3, $portion, \PDO::PARAM_STR);
        $req->bindParam(4, $id_ingredient, \PDO::PARAM_INT);
        $req->bindParam(5, $utilisateur, \PDO::PARAM_INT);
        $req->execute();
    } catch (\Exception $e) {
        die('Error :'.$e->getMessage());
    } 
}

public function findOneBy(){
    try {
        $nom = $this->getNom();
        $quantite = $this->getQuantite();
        $portion = $this->getPortion();
        $req = $this->connexion()->prepare('SELECT ingredients.id_utilisateur, id_ingredient, nom_ingredient, quantite_ingredient, portion_ingredient FROM ingredients 
        WHERE nom_ingredient = ? AND quantite_ingredient = ?  AND portion_ingredient = ?');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->bindParam(2, $quantite, \PDO::PARAM_STR);
        $req->bindParam(3, $portion, \PDO::PARAM_STR);
        $req->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Ingredient::class);
        $req->execute();
        return $req->fetch();
    } 
    catch (\Exception $e) {
        die('Error : '.$e->getMessage());
    }
}
}

