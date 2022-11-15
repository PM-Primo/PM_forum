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
                DAO::select($sql,['email' => $email], false), //On rajoute false car la fonction select a "multiple results = true" par défaut, du coup ça renvoie un objet null si on ne met pas "false"
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

        
        public function findMdpByEmail($email){
            $sql = "SELECT mdpUser
            FROM user u 
            WHERE emailUser = :email";
    
            return $this->getSingleScalarResult(
                DAO::select($sql,['email' => $email]), 
                $this->className
            );
        }

        public function viewProfile2($id){
            $sql="SELECT id_user, emailUser, pseudoUser, roleUser, COUNT(distinct p.id_post) AS nbPostsUser, COUNT(distinct t.id_topic) AS nbTopicsUser
            FROM user u
            LEFT JOIN post p ON u.id_user = p.user_id
            LEFT JOIN topic t ON u.id_user = t.user_id
            WHERE u.id_user = :id
            GROUP BY u.id_user
            LIMIT 1";

            return $this->getOneOrNullResult(
                DAO::select($sql,['id' => $id]), 
                $this->className
            );
        }

        // public function viewProfile($id){
        //     $sql = "SELECT id_user, emailUser, mdpUser, pseudoUser, roleUser, COUNT(distinct p.id_post) AS nbPostsUser, COUNT(distinct t.id_topic) AS nbTopicsUser
        //     FROM user u
        //     LEFT JOIN post p ON u.id_user = p.user_id
        //     LEFT JOIN topic t ON u.id_user = t.user_id
        //     WHERE u.id_user = :id
        //     GROUP BY u.id_user
        //     LIMIT 1
        //     ";   

        //     return $this->getSingleScalarResult(
        //         DAO::select($sql,['id' => $id]), 
        //         $this->className
        //     );
        // }

    }
?>