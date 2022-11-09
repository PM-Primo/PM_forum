<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
use DateTime;
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

            $catId = $_GET["id"];
            $titre = filter_input(INPUT_POST, "titreTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $texte = filter_input(INPUT_POST, "texteFirstPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($catId && $titre && $texte && \App\Session::getUser()){

                $userId=\App\Session::getUser()->getId();

                $topicManager = new TopicManager();
                $dataTopic=["titreTopic"=>$titre,"categorie_id"=>$catId, "user_id"=>$userId];
                $newTopicId = $topicManager->add($dataTopic);

                $postManager = new PostManager();
                $dataFirstPost=["textePost"=>$texte,"topic_id"=>$newTopicId, "user_id"=>$userId];
                $postManager->add($dataFirstPost);
            }
            $this->redirectTo("forum", "listPosts", $newTopicId);
        }   


        public function addPost($id){

            $texte = filter_input(INPUT_POST, "textePost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($id && $texte && \App\Session::getUser()){ // on doit mettre un "\" au début pour qu'il aille à la racine et non dans le namespace Controller\App\Session

                $userId= \App\Session::getUser()->getId();
                
                $postManager = new PostManager();
                $data=["textePost"=>$texte,"topic_id"=>$id, "user_id"=>$userId];
                $postManager->add($data);
            }
            $this->redirectTo("forum", "listPosts", $id);
        }

        public function editPostForm($id){

            $postManager = new PostManager();
            $post = $postManager->findOneById($id);

            return [
                "view" => VIEW_DIR."forum/editPostForm.php",
                "data" => [
                    "post" => $post
                ]
            ];
        }

        public function editPost($id){
            
            $postManager = new PostManager();
            $nvTexte = $_POST["nvTextePost"];
            $data=["textePost" => $nvTexte];
            $postManager->update($id, $data);
            $idTopic=$postManager->findOneById($id)->getTopic()->getId();
            $this->redirectTo("forum", "listPosts", $idTopic);
        }
    }
?>
