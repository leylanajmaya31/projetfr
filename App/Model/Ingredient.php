<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Recette;

class Ingredient extends BddConnect{
private ?int $id_ingredient;   
private ?string $nom_ingredient;

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


public function add(){
    try {
        $nom = $this->getNom();
        $id_ingredient = $this->getIdIngredient();
        $req = $this->connexion()->prepare('INSERT INTO ingredients(nom_ingredient, id_utilisateur)
        VALUES (?,?)');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->bindParam(2, $nom, \PDO::PARAM_INT);
        $req->execute();
    } catch (\Exception $e) {
        die('Error :'.$e->getMessage());
    } 
}

public function addAssociation($idRecette, $idIngredient) {
    try {
        $req = $this->connexion()->prepare('INSERT INTO renseigner (id_recette, id_ingredient) VALUES (?, ?)');
        $req->bindParam(1, $idRecette, \PDO::PARAM_INT);
        $req->bindParam(2, $idIngredient, \PDO::PARAM_INT);
        $req->execute();
    } catch (\Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}





public function findOneBy(){
    try {
        $nom = $this->getNom();
        $req = $this->connexion()->prepare('SELECT ingredients.id_utilisateur, id_ingredient, nom_ingredient FROM ingredients 
        WHERE nom_ingredient = ?');
        $req->bindParam(1, $nom, \PDO::PARAM_STR);
        $req->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Ingredient::class);
        $req->execute();
        return $req->fetch();
    } 
    catch (\Exception $e) {
        die('Error : '.$e->getMessage());
    }
}
}

