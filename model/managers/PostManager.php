<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function listPosts($id){

            $sql = "SELECT *
                    FROM post p
                    WHERE topic_id = :id
                    ORDER BY datePost ASC ";

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]), 
                $this->className
            );
        }

        public function addPost(){

            $topicId = $_GET["id"];
            $texte = filter_input(INPUT_POST, "textePost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = 1;

            if($topicId && $texte && $userId){
                $data=["textePost"=>$texte,"topic_id"=>$topicId, "user_id"=>$userId];
                return $this->add($data);
            }

        }



    }
?>