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

        public function addUser(){

            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $pseudoUser =  filter_input(INPUT_POST, "pseudoUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser = filter_input(INPUT_POST, "mdpUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser2 = filter_input(INPUT_POST, "mdpUser2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if($emailUser && $pseudoUser && $mdpUser){

                //On vérifie si l'e-mail n'existe pas déjà
                $sql = "SELECT *
                FROM user u 
                WHERE emailUser = :email";
        
                $checkEmail = $this->getOneOrNullResult(
                    DAO::select($sql,['email' => $emailUser]), 
                    $this->className
                );
                
                if(!$checkEmail){

                    //On vérifie si le pseudo n'existe pas déjà 
                    $sql = "SELECT *
                        FROM user u 
                        WHERE pseudoUser = :pseudo";
            
                    $checkPseudo = $this->getOneOrNullResult(
                    DAO::select($sql,['pseudo' => $pseudoUser]), 
                    $this->className
                    );

                    if(!$checkPseudo){

                        if ($mdpUser == $mdpUser2){ //on vérifie que les 2 mots de passe sont identiques
                            $mdpHash = password_hash($mdpUser, PASSWORD_DEFAULT);
                            $data=["emailUser"=>$emailUser,"pseudoUser"=>$pseudoUser,"mdpUser"=>$mdpHash];
                            return $this->add($data);
                        }
                    }
                }
            }
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