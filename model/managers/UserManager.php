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
            $emailUser = $_POST["emailUser"];
            $pseudoUser = $_POST["pseudoUser"];
            $mdpUser = $_POST["mdpUser"];

            $data=["emailUser"=>$emailUser,"pseudoUser"=>$pseudoUser,"mdpUser"=>$mdpUser];

            return $this->add($data);

        }

    }
?>