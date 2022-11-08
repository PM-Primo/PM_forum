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

        public function findOneByEmail($email){
            $sql = "SELECT *
            FROM user u 
            WHERE emailUser = :email";
    
            return $this->getOneOrNullResult(
                DAO::select($sql,['email' => $email]), 
                $this->className
            );
        }

        public function findOneByPseudo($pseudo){
            $sql = "SELECT *
            FROM user u 
            WHERE pseudoUser = :pseudo";

            return $this->getOneOrNullResult(
                DAO::select($sql,['pseudo' => $pseudo]), 
                $this->className
            );
        }

    }
?>