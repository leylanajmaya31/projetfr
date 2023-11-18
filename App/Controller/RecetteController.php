<?php
namespace App\Controller;
use App\vue\Template;
use App\Model\Utilisateur;
use App\Utils\Utilitaire;
use App\Model\Recette;
class RecetteController extends Recette{
    public function addRecette(){
        $error ="";
        $user = new Utilisateur();
        $user->setId(Utilitaire::cleanInput($_SESSION['id']));
        $users = $user->findAll();
        if(isset($_POST['submit'])){
            if(!empty($_POST['nom_recette']) AND !empty($_POST['date_recette']) AND !empty($_POST['niveau_recette'])
            AND !empty($_POST['description_recette'])AND !empty($_POST['portion_recette']) AND !empty($_POST['temps_recette'])
            AND !empty($_POST['image_recette'])){
                $this->setNom(Utilitaire::cleanInput($_POST['nom_recette']));
                $this->setDate(Utilitaire::cleanInput($_POST['date_recette']));
                $this->setNiveau(Utilitaire::cleanInput($_POST['niveau_recette']));
                $this->setDescription(Utilitaire::cleanInput($_POST['description_recette']));
                $this->setPortion(Utilitaire::cleanInput($_POST['portion_recette']));
                $this->setTemps(Utilitaire::cleanInput($_POST['temps_recette']));
                $this->setImage(Utilitaire::cleanInput($_POST['image_recette']));
                $this->setStatut(false);
                 // Associer l'ID de l'utilisateur à la recette
                 $this->setIdUtilisateur($user->getId());
                $recette = $this->findOneBy();
                if($recette){
                    $error = "La recette existe déja";
                }
                else{
                    $this->add();
                    $error = "La recette a été ajoutée en BDD";
                }

            }
            else{
                $error = "Veuillez remplir tous les champs du formulaire";
            }
        }
        Template::render('navbar.php', 'footer.php','vueAddRecette.php','Recette',   
        ['script.js', 'main.js'],['style.css', 'main.css'],$error,$users);
    }
    


    public function getAllRecette(){
        $error = "";
        $recettes = $this->findAll();
        if(empty($recettes)){
            $error = "Il n'y a pas de recettes à afficher";
        }
        Template::render('navbar.php','footer.php','vueAllRecette.php','Toutes les Recettes', 
        ['script.js', 'main.js'],['style.css', 'main.css'],$error,$recettes);
    }
}

    // public function filterRecette(){
    //     $error = "";
    //     $recettes = $this->filterAll(5);
    //     if($recettes){
    //         if(isset($_POST['submit'])){
    //             if(!empty($_POST['filter'])){
    //                 $recettes = $this->filterAll(Utilitaire::cleanInput($_POST['filter']));
    //             }
    //         }
    //     }
    //     else{
    //         $error = "La liste des recettes est vide ";
    //     }

    //     Template::render('navbar.php','footer.php','vueFilterAllRecettes.php','Filtrer recettes', 
    //     ['script.js', 'main.js'], ['style.css', 'main.css'],$error, $recettes);
    // }
