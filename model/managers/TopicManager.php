<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function listTopics($id){

            $sql = "SELECT *
                    FROM topic t 
                    WHERE categorie_id = :id
                    ORDER BY dateCreaTopic DESC ";

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]), 
                $this->className
            );
        }

        public function addTopic(){
            $catId = $_GET["id"];
            $titre = filter_input(INPUT_POST, "titreTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $texte = filter_input(INPUT_POST, "texteFirstPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = 1;


            if($catId && $titre && $userId && $texte){

                $dataTopic=["titreTopic"=>$titre,"categorie_id"=>$catId, "user_id"=>$userId];
                $newTopicId = $this->add($dataTopic);

                $postManager = new PostManager;
                $dataFirstPost=["textePost"=>$texte,"topic_id"=>$newTopicId, "user_id"=>$userId];
                return $postManager->add($dataFirstPost);

            }

        }
    }
?>