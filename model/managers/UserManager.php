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
            $mdpHash = password_hash($mdpUser, PASSWORD_DEFAULT);

            $data=["emailUser"=>$emailUser,"pseudoUser"=>$pseudoUser,"mdpUser"=>$mdpHash];

            return $this->add($data);

        }

    }
?>