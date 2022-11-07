<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function addUser(/* */){

            // $sql = "SELECT *
            //         FROM topic t 
            //         WHERE categorie_id = :id
            //         ORDER BY dateCreaTopic DESC ";

            // return $this->getMultipleResults(
            //     DAO::select($sql,['id' => $id]), 
            //     $this->className
            // );
        }

    }
?>