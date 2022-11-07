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
          
            return [
                "view" => VIEW_DIR."security/addUserForm.php",
            ];
        
        }

        public function addUser(){
            $userManager = new UserManager();

            $userManager->addUser();

            return [
                "view" => VIEW_DIR."security/addUserForm.php",
            ];
        }


    }
?>