<?php
    //!import du fichier de configuration
    include './env.php';
    //!import de l'autoloader des classes
    require_once './autoload.php';
    require_once './vendor/autoload.php';
    use App\Controller\UtilisateurController;
    use App\Controller\RoleController;
    use App\Controller\HomeController;
    use App\Controller\RecetteController;
    use App\Controller\CommentaireController;
    use App\Controller\IngredientController;
    $userController = new UtilisateurController();  
    $roleController = new RoleController();
    $homeController = new HomeController();   
    $recetteController = new RecetteController();
    $commentaireController = new CommentaireController();  
    $ingredientController = new IngredientController();
    //!utilisation de session_start(pour gérer la connexion au serveur)
    session_start();
    //!Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //!test si l'url posséde une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //!version connecté
    if(isset($_SESSION['connected'])){
        //routeur
        switch ($path) {
            case '/projetfr':
                $homeController->getHome();
                break;
            case '/projetfr/roleadd':
                $roleController->addRole();
                break;
            case '/projetfr/userdeconnexion':
                $userController->deconnexionUser();
                break;
            case '/projetfr/recetteadd':
                $recetteController->addRecette();
                break;
                case '/projetfr/ingredientadd':
                    $ingredientController->addIngredient();
                    break;
            case '/projetfr/recetteall':
                $recetteController->getAllRecette();
                break;
                case '/projetfr/recetteone':
                    $recetteController->getRecette();
                    break;
            // case '/projetfr/recetteupdate':
            //     $recetteController->updateRecette();
            //     break;
            case '/projetfr/emailtest':
                $homeController->testMail();
                break;
            // case '/projetfr/projetfilter':
            //     $recetteController->filterRecette();
            //     break;
            case '/projetfr/commentaireadd':
                $commentaireController->addCommentaire();
                break;
            case '/projetfr/commentaireall':
                $commentaireController->allCommentaire();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
    //!Version deconnecté
    else{
        switch ($path) {
            case '/projetfr/':
                $homeController->getHome();
                break;
            case '/projetfr/userconnexion':
                $userController->connexionUser();
                break;
            case '/projetfr/useradd':
                $userController->addUser();
                break;
            // case '/projetfr/recetteall':
            //     $recetteController->getAllRecette();
            //     break;
            case '/projetfr/emailtest':
                $homeController->testMail();
                break;
            case '/projetfr/useractivate':
                $userController->activateUser();
                break;
            // case '/projetfr/recettefilter':
            //     $recetteController->filterRecette();
            //     break;
            case '/projetfr/commentaireall':
                $commentaireController->allCommentaire();
                break;
            case '/projetfr/commentaireadd':
            case '/projetfr/recetteupdate':
                $homeController->get401();
                break;
            default:
                $homeController->get404();
                break;
        }
    }
?>
