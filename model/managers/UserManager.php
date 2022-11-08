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

        public function login(){

            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $mdpUser = filter_input(INPUT_POST, "mdpUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($emailUser && $mdpUser){

                //On vérifie que l'e-mail est bien dans la base de données
                $sql = "SELECT *
                FROM user u 
                WHERE emailUser = :email";
        
                $user = $this->getOneOrNullResult(
                    DAO::select($sql,['email' => $emailUser]), 
                    $this->className
                );

                var_dump($user->getId());
                echo"<br>";
                var_dump($user->getEmailUser());
                die;

                if($user){
                    //On vérifie que le mot de passe est bien celui associé au mail

                }

            }

        }

    }
?>