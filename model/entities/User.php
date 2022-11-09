<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $emailUser;
        private $mdpUser;
        private $pseudoUser;
        private $roleUser;

        //Constructeur
        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        //Get & Set pour tous les attributs
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getEmailUser(){
            return $this->emailUser;
        }

        public function setEmailUser($nvEmail){
            $this->emailUser = $nvEmail;
            return $this;
        }

        public function getMdpUser(){
            return $this->mdpUser;
        }

        public function setMdpUser($nvMdp){
            $this->mdpUser = $nvMdp;
            return $this;
        }

        public function getPseudoUser(){
            return $this->pseudoUser;
        }

        public function setPseudoUser($nvPseudo){
            $this->pseudoUser = $nvPseudo;
            return $this;
        }

        public function getRoleUser(){
            return $this->roleUser;
        }

        public function setRoleUser($nvRole){
            $this->roleUser = $nvRole;
            return $this;
        }

        //Vérifier si l'utilisateur a le rôle que l'on cherche 
        public function hasRole($role){
            if($this->roleUser == $role){
                return $this->roleUser;
            }
            else{
                return false;
            }
        }

        //ToString
        public function __toString()
        {
            return $this->pseudoUser;
        }
    }
?>