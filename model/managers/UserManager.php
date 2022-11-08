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

        public function addUser( ){

            $emailUser =  filter_input(INPUT_POST, "emailUser", FILTER_VALIDATE_EMAIL);
            $pseudoUser =  filter_input(INPUT_POST, "pseudoUser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $mdpUser = $_POST["mdpUser"];
            $mdpUser2 = $_POST["mdpUser2"];


            if($emailUser && $pseudoUser && $mdpUser){

                //On vérifie si l'e-mail n'existe pas déjà
                $sql = "SELECT *
                FROM user u 
                WHERE emailUser = :email";
        
                $checkEmail = $this->getMultipleResults(
                    DAO::select($sql,['email' => $emailUser]), 
                    $this->className
                );
                
                if(!$checkEmail){

                    //On vérifie si le pseudo n'existe pas déjà 
                    $sql = "SELECT *
                        FROM user u 
                        WHERE pseudoUser = :pseudo";
            
                    $checkPseudo = $this->getMultipleResults(
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
    }
?>