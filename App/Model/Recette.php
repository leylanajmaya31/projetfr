<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Utilisateur;
class Recette extends BddConnect{
    /*---------------------------- 
                Attributs
    -----------------------------*/
    private ?int $id_recette;
    private ?string $nom_recette;
    private ?string $niveau_recette;
    private ?string $date_recette;
    private ?int $portion_recette;
    private ?string $temps_recette;
    private ?bool $statut_recette;
    private ?string $description_recette;
    private ?string $image_recette;
    private ?int $id_utilisateur;
    
    /*---------------------------- 
            Getters et Setters
    -----------------------------*/
    public function getId(){
        return $this->id_recette;
    }
    public function setId(?int $id):void{
        $this->id_recette = $id;
    }
    public function getNom():?string{
        return $this->nom_recette;
    }
    public function setNom(?string $nom):void{
        $this->nom_recette = $nom;
    }
    public function getNiveau():?string{
        return $this->niveau_recette;
    }
    public function setNiveau(?string $niveau):void{
        $this->niveau_recette = $niveau;
    }
    public function getDate():?string{
        return $this->date_recette;
    }
    public function setDate(?string $date):void{
        $this->date_recette = $date;
    }
    public function getPortion():?int{
        return $this->portion_recette;
    }
    public function setPortion(?int $portion):void{
        $this->portion_recette = $portion;
    }
    
    public function getTemps():?string{
        return $this->temps_recette;
    }
    public function setTemps(?string $temps):void{
        $this->temps_recette = $temps;
    }
    public function getStatut():?bool{
        return $this->statut_recette;
    }
    public function setStatut(?bool $statut):void{
        $this->statut_recette = $statut;
    }
    public function getDescription():?string{
        return $this->description_recette;
    }
    public function setDescription(?string $description):void{
        $this->description_recette = $description;
    }
    public function getImage():?string{
        return $this->image_recette;
    }
    public function setImage(?string $image):void{
        $this->image_recette = $image;
    }

    public function getIdUtilisateur(): ?int {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?int $utilisateur): void {
        $this->id_utilisateur = $utilisateur;
    }

    /*---------------------------- 
                Méthodes
    -----------------------------*/

    //!Ajouter un chocoblast
    public function add(){
        try {
            $nom = $this->getNom();
            $date = $this->getDate();
            $niveau = $this->getNiveau();
            $description = $this->getDescription();
            $portion = $this->getPortion();
            $temps = $this->getTemps();
            $image = $this->getImage();
            $statut = $this->getStatut();
            $utilisateur = $this->getIdUtilisateur();
            $req = $this->connexion()->prepare('INSERT INTO recette(nom_recette, date_recette,
            niveau_recette, description_recette, portion_recette, temps_recette, image_recette, statut_recette, id_utilisateur)
            VALUES (?,?,?,?,?,?,?,?,?)');
            $req->bindParam(1, $nom, \PDO::PARAM_STR);
            $req->bindParam(2, $date, \PDO::PARAM_STR);
            $req->bindParam(3, $niveau, \PDO::PARAM_STR);
            $req->bindParam(4, $description, \PDO::PARAM_STR);
            $req->bindParam(5, $portion, \PDO::PARAM_INT);
            $req->bindParam(6, $temps, \PDO::PARAM_STR);
            $req->bindParam(7, $image, \PDO::PARAM_STR);
            $req->bindParam(8, $statut, \PDO::PARAM_BOOL);
            $req->bindParam(9, $utilisateur, \PDO::PARAM_INT);
            $req->execute();
        } catch (\Exception $e) {
            die('Error :'.$e->getMessage());
        } 
    }

    //!Rechercher une recette
    public function findOneBy(){
        try {
            $nom = $this->getNom();
            $date = $this->getDate();
            $niveau = $this->getNiveau();
            $description = $this->getDescription();
            $portion = $this->getPortion();
            $temps = $this->getTemps();
            $image = $this->getImage();
            $req = $this->connexion()->prepare('SELECT recette.id_utilisateur, id_recette, nom_recette,
            niveau_recette, description_recette, date_recette, portion_recette, temps_recette FROM recette 
            WHERE nom_recette = ? AND niveau_recette = ? AND date_recette = ? AND description_recette = ?
            AND portion_recette = ? AND temps_recette = ? AND image_recette = ?');
            $req->bindParam(1, $nom, \PDO::PARAM_STR);
            $req->bindParam(2, $niveau, \PDO::PARAM_STR);
            $req->bindParam(3, $description, \PDO::PARAM_STR);
            $req->bindParam(4, $date, \PDO::PARAM_STR);
            $req->bindParam(5, $portion, \PDO::PARAM_INT);
            $req->bindParam(6, $temps, \PDO::PARAM_STR);
            $req->bindParam(7, $image, \PDO::PARAM_STR);
            $req->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Recette::class);
            $req->execute();
            return $req->fetch();
        } 
        catch (\Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }


    //!Afficher la liste des recettes
    public function findAll() {
        try {
            $req = $this->connexion()->prepare('SELECT 
                recette.id_recette, recette.nom_recette, recette.niveau_recette, 
                recette.description_recette, recette.date_recette, recette.portion_recette, recette.temps_recette,
                utilisateur.nom_utilisateur
                FROM recette
                INNER JOIN utilisateur ON recette.id_utilisateur = utilisateur.id_utilisateur');
            $req->execute();
            return $req->fetchAll(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Recette::class);
        } catch (\Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }


}