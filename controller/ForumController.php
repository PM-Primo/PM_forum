<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use DateTime;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
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
            $firstPost = $postManager->findFirstPostByTopic($id);

            return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->listPosts($id),
                    "topic" => $topic,
                    "firstPost" => $firstPost
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

                Session::addFlash('success','Nouveau topic créé');

            }
            else{
                Session::addFlash('error','Action Impossible !');
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

                Session::addFlash('success','Réponse enregistrée');

            }
            else{
                Session::addFlash('error','Action Impossible !');
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
            $userId=$postManager->findOneById($id)->getUser()->getId();

            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                $nvTexte = $_POST["nvTextePost"];
                $data=["textePost" => $nvTexte];
                $postManager->update($id, $data);

                Session::addFlash('success','Message modifié avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $idTopic=$postManager->findOneById($id)->getTopic()->getId();
            $this->redirectTo("forum", "listPosts", $idTopic);
        }

        //Suppression d'un post ($id)
        public function deletePost($id){
            $postManager = new PostManager();
            $idTopic = $postManager->findOneById($id)->getTopic()->getId();
            $userId = $postManager->findOneById($id)->getUser()->getId();
            $firstPostId= $postManager->findFirstPostByTopic($idTopic)->getId();

            if($id != $firstPostId){
                if(\App\Session::getUser()){
                    if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                        $postManager->delete($id);
                        Session::addFlash('success','Message supprimé avec succès');
                    }
                    else{
                        Session::addFlash('error','Action Impossible');
                    }
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $this->redirectTo("forum", "listPosts", $idTopic);
        }

        //Appel du formulaire d'édition d'un topic ($id) + 1er message
        public function editTopicForm($id){

            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            $postManager = new PostManager();
            $firstPost = $postManager->findFirstPostByTopic($id);

            return [
                "view" => VIEW_DIR."forum/editTopicForm.php",
                "data" => [
                    "topic" => $topic,
                    "firstPost" => $firstPost,
                ]
            ];
        }

        //Edition d'un topic ($id) + premier message
        public function editTopic($id){
            //On vérifie que l'utilisateur est bien l'auteur du topic
            $topicManager = new TopicManager();
            $userId = $topicManager->findOneById($id)->getUser()->getId();
            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                    //On met à jour le titre du topic
                    $nvTitre = $_POST["nvTitre"];
                    $data=["titreTopic" => $nvTitre];
                    $topicManager->update($id, $data);

                    //On va chercher le premier post
                    $postManager = new PostManager();
                    $firstPost = $postManager->findFirstPostByTopic($id);

                    //Et on en change le texte
                    $nvTexte = $_POST["nvTexte"];
                    $data=["textePost" => $nvTexte];
                    $firstPostId = $firstPost->getId();
                    $postManager->update($firstPostId, $data);

                    Session::addFlash('success','Topic modifié avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }    
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $this->redirectTo("forum", "listPosts", $id);
        }

        //Suppression d'un topic ($id) & de tous les messages qu'il contient
        public function deleteTopic($id){

            //On va chercher la catégorie du topic pour rediriger par la suite
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);
            $catId = $topic->getCategorie()->getId();
            $userId = $topic->getUser()->getId();

            //On vérifie que l'utilisateur est bien l'auteur du topic
            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){

                    //On supprime tous les messages du topic
                    $postManager = new PostManager();
                    $postManager->deletePostsByTopic($id);
                    
                    //On supprime le topic
                    $topicManager->delete($id);

                    //Message de validation
                    Session::addFlash('success','Topic supprimé avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            //On redirige
            $this->redirectTo("forum", "listTopics", $catId);
        }

        //Verrouillage d'un topic
        public function lockTopic($id){
            $topicManager = new TopicManager();
            $catId = $topicManager->findOneById($id)->getCategorie()->getId();
            $userId = $topicManager->findOneById($id)->getUser()->getId();

            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                    $data=["verrouTopic" => 1];
                    $topicManager->update($id, $data);
                    Session::addFlash('success','Topic verrouillé avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $this->redirectTo("forum", "listTopics", $catId);
        }

        //Déverrouillage d'un topic
        public function unlockTopic($id){
            $topicManager = new TopicManager();
            $catId = $topicManager->findOneById($id)->getCategorie()->getId();
            $userId = $topicManager->findOneById($id)->getUser()->getId();

            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                    $data=["verrouTopic" => 0];
                    $topicManager->update($id, $data);
                    Session::addFlash('success','Topic déverrouillé avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $this->redirectTo("forum", "listTopics", $catId);
        }

    }
?>
