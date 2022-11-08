<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationdate", "DESC"])
                ]
            ];
        
        }

        public function listCategories(){

            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["orderCategorie", "ASC"])
                ]
            ];

        }

        public function listTopics($id){

            $topicManager = new TopicManager();
            $categorieManager = new CategorieManager();
            
            $categorie = $categorieManager->findOneById($id);

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->listTopics($id),
                    "categorie" => $categorie
                ]
            ];

        }

        public function listPosts($id){

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            
            $topic = $topicManager->findOneById($id);

            return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->listPosts($id),
                    "topic" => $topic
                ]
            ];

        }

        public function addTopicForm(){
            return ["view" => VIEW_DIR."forum/addTopicForm.php"];
        }

        public function addTopic(){

            $topicManager = new TopicManager();

            $newTopicId = $topicManager->addTopic();

            $this->redirectTo("forum", "listPosts", $newTopicId);
        }   


        public function addPost($id){

            $texte = filter_input(INPUT_POST, "textePost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = 1;

            if($id && $texte && $userId){
                $postManager = new PostManager();
                $data=["textePost"=>$texte,"topic_id"=>$id, "user_id"=>$userId];
                $postManager->add($data);
                $this->redirectTo("forum", "listPosts", $id);
            }
        }
    }
?>
