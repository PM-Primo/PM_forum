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

            $sql = "SELECT t.id_topic, t.titreTopic, t.dateCreaTopic, t.verrouTopic, t.user_id, COUNT(p.topic_id) AS nbPostsTopic
                    FROM topic t
                    LEFT JOIN post p ON t.id_topic = p.topic_id
                    WHERE t.categorie_id = :id
                    GROUP BY t.id_topic
                    ORDER BY dateCreaTopic DESC ";

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]), 
                $this->className
            );
        }
    }
?>