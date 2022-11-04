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
    }
?>