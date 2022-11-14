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

        //Appel du formulaire d'inscription
        public function addUserForm(){
            return ["view" => VIEW_DIR."security/addUserForm.php"];
        }

        //Inscription d'un nouvel utilisateur
        public function addUser(){

            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $pseudoUser =  filter_input(INPUT_POST, "pseudoUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser = filter_input(INPUT_POST, "mdpUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser2 = filter_input(INPUT_POST, "mdpUser2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($emailUser){
                if($pseudoUser && $mdpUser && $mdpUser2){ //On vérifie que les champs sont bien remplis
                    $userManager = new UserManager();
                    if(!$userManager->findOneByEmail($emailUser)){ //On vérifie que l'e-mail n'est pas déjà utilisé
                        if(!$userManager->findOneByPseudo($pseudoUser)){ // On vérifie que le pseudo n'est pas déjà utilisé
                            if ($mdpUser == $mdpUser2 && strlen($mdpUser)>=8){ //on vérifie que les 2 mots de passe sont identiques & font plus de 8 caractères
                                $mdpHash = password_hash($mdpUser, PASSWORD_DEFAULT);
                                $data=["emailUser"=>$emailUser,"pseudoUser"=>$pseudoUser,"mdpUser"=>$mdpHash];
                                $userManager->add($data);
                                Session::addFlash('success','Inscription réalisée avec succès !');
                                return ["view" => VIEW_DIR."security/loginForm.php"];
                            }
                            else{
                                Session::addFlash('error','Les deux mots de passe saisis doivent être identiques');
                            }
                        }
                        else{
                            Session::addFlash('error','Le pseudonyme saisi est déjà utilisé');
                        }
                    }
                    else{
                        Session::addFlash('error',"L'adresse mail saisie est déjà utilisée");
                    }
                }
                else{
                    Session::addFlash('error','Certains champs ne sont pas remplis');
                }
            }
            else{
                Session::addFlash('error','Adresse e-mail non valide');
            }
            return ["view" => VIEW_DIR."security/addUserForm.php"];
        }

        //Appel du formulaire de login
        public function loginForm(){
            return ["view" => VIEW_DIR."security/loginForm.php"];
        }
        
        //login
        public function login(){
            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $mdpUser = filter_input(INPUT_POST, "mdpUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($emailUser){
                if($mdpUser){
                    //On vérifie que l'e-mail est bien dans la base de données
                    $userManager = new UserManager();
                    if($userManager->findOneByEmail($emailUser)){
                        $mdpHash = $userManager->findMdpByEmail($emailUser)["mdpUser"]; //on va chercher le mdp associé à l'e-mail dans la BDD
                        if (password_verify($mdpUser, $mdpHash)){ //on vérifie que le mdp hashé en bdd & le mdp entré sont identiques
                            
                            $user = $userManager->findOneByEmail($emailUser); //on va rechercher l'utilisateur associé
                            // var_dump($user);
                            // die;
                            Session::setUser($user);
                            Session::addFlash('success','Bienvenue '.$user->getPseudoUser());
                            return ["view" => VIEW_DIR."home.php"];
                        }
                        else{
                            Session::addFlash('error','Mot de passe incorrect');
                        }
                    }
                    else{
                        Session::addFlash('error','Aucun compte ne correspond à cette adresse e-mail');
                    }
                }
                else{
                    Session::addFlash('error','Mot de passe invalide');
                }
            }
            else{
                Session::addFlash('error','Adresse e-mail invalide');
            }
            return ["view" => VIEW_DIR."security/loginForm.php"];
        }

        //logout
        public function logout(){
            //$_SESSION[]=session_unset();
            $_SESSION['user'] = null;
            Session::addFlash('success','À bientôt !');
            return ["view" => VIEW_DIR."home.php"];
        }

        public function listUsers(){

            $userManager = new UserManager();

            if(\App\Session::IsAdmin()){
                return [
                    "view" => VIEW_DIR."security/listUsers.php",
                    "data" => [
                        "users" => $userManager->findAll(["pseudoUser", "ASC"])
                    ]
                ];
            }
            else{
                Session::addFlash('error','Accès interdit');
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
        }

        public function viewProfile($id){

            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."security/viewProfile.php",
                "data" => [
                    "user" => $userManager->viewProfile($id),
                ]
            ];

        
        }

    }
?>