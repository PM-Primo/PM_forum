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

        //Appel de la liste des catégories
        public function listCategories(){

            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["orderCategorie", "ASC"])
                ]
            ];

        }

        //Appel de la liste des topics d'une catégorie précise ($id)
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

        //Appel de la liste des posts d'un Topic précis ($id)
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

        //Appel du formulaire d'ajout de topics
        public function addTopicForm(){
            return ["view" => VIEW_DIR."forum/addTopicForm.php"];
        }

        //Ajout d'un topic & du premier message à la suite de l'utilisation du formulaire
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

        //Ajout d'un post à la suite d'un topic précis ($id)
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

        //Appel du formulaire d'édition d'un post($id)
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

        //Edition d'un post ($id) à la suite de l'emploi du formulaire
        public function editPost($id){
            
            $postManager = new PostManager();
            $nvTexte = $_POST["nvTextePost"];
            $data=["textePost" => $nvTexte];
            $postManager->update($id, $data);
            $idTopic=$postManager->findOneById($id)->getTopic()->getId();
            $this->redirectTo("forum", "listPosts", $idTopic);
        }

        //Suppression d'un post ($id)
        public function deletePost($id){
            $postManager = new PostManager();
            $idTopic=$postManager->findOneById($id)->getTopic()->getId();
            $postManager->delete($id);
            $this->redirectTo("forum", "listPosts", $idTopic);
        }
    }
?>
