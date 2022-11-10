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

        public function findFirstPostByTopic($id){

            $sql = "SELECT *
                    FROM post
                    WHERE topic_id = :id
                    ORDER BY datePost ASC
                    LIMIT 1";

            return $this->getOneOrNullResult(
                DAO::select($sql,['id' => $id], false), 
                $this->className
            );
        }

        public function deletePostsByTopic($id){

            $sql = "DELETE FROM post
                    WHERE topic_id = :id
                    ";
                    
            return DAO::delete($sql, ['id' => $id]);
        }   

    }
?>