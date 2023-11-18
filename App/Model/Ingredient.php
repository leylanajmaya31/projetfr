<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Recette;

class Ingredient extends BddConnect{
private ?string $nom_ingredient;

private ?string $quantite_ingredient;

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

public function add(){
    try {
        $nom = $this->getNom();
        $quantite = $this->getQuantite();
        $req = $this->connexion()->prepare('INSERT INTO ingredients(nom_ingredient, quantite_ingredient)
        VALUES (?,?)');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->bindParam(2, $quantite, \PDO::PARAM_STR);
        $req->execute();
    } catch (\Exception $e) {
        die('Error :'.$e->getMessage());
    } 
}

public function findOneBy(){
    try {
        $nom = $this->getNom();
        $quantite = $this->getQuantite();
        $req = $this->connexion()->prepare('SELECT ingredients.id_ingredients, nom_ingredient, quantite_ingredient FROM ingredients 
        WHERE nom_ingredient = ? AND quantite_ingredient = ?');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->bindParam(2, $quantite, \PDO::PARAM_STR);
        $req->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Recette::class);
        $req->execute();
        return $req->fetch();
    } 
    catch (\Exception $e) {
        die('Error : '.$e->getMessage());
    }
}


}