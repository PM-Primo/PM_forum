<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $userManager = new UserManager();

            // return [
            //     "view" => VIEW_DIR."forum/listTopics.php",
            //     "data" => [
            //         "topics" => $userManager->findAll(["creationdate", "DESC"])
            //     ]
            // ];
        
        }

        public function addUserForm(){
            return ["view" => VIEW_DIR."security/addUserForm.php"];
        }

        public function addUser(){

            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $pseudoUser =  filter_input(INPUT_POST, "pseudoUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser = filter_input(INPUT_POST, "mdpUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser2 = filter_input(INPUT_POST, "mdpUser2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($emailUser && $pseudoUser && $mdpUser && $mdpUser2){ //On vérifie que les champs sont bien remplis
                $userManager = new UserManager();
                if(!$userManager->findOneByEmail($emailUser)){ //On vérifie que l'e-mail n'est pas déjà utilisé
                    if(!$userManager->findOneByPseudo($pseudoUser)){ // On vérifie que le pseudo n'est pas déjà utilisé
                        if ($mdpUser == $mdpUser2 && strlen($mdpUser)>=8){ //on vérifie que les 2 mots de passe sont identiques & font plus de 8 caractères
                            $mdpHash = password_hash($mdpUser, PASSWORD_DEFAULT);
                            $data=["emailUser"=>$emailUser,"pseudoUser"=>$pseudoUser,"mdpUser"=>$mdpHash];
                            $userManager->add($data);
                        }
                    }
                }
            }
            return ["view" => VIEW_DIR."security/addUserForm.php"];
        }

        public function loginForm(){
            return ["view" => VIEW_DIR."security/loginForm.php"];
        }

        public function login(){
            $userManager = new UserManager();
            $userManager->login();
        }


    }
?>