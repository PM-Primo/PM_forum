<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $titreTopic;
        private $dateCreaTopic;
        private $verrouTopic;
        private $categorie;
        private $user;
        private $nbPostsTopic; // non mappé

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId(){
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getTitreTopic(){
            return $this->titreTopic;
        }

        public function setTitreTopic($nvTitre){
            $this->titreTopic = $nvTitre;
            return $this;
        }

        public function getDateCreaTopic(){
            $formattedDate = $this->dateCreaTopic->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreaTopic($date){
            $this->dateCreaTopic = new \DateTime($date);
            return $this;
        }

        public function getVerrouTopic(){
            return $this->verrouTopic;
        }

        public function setVerrouTopic($nvEtat){
            $this->verrouTopic = $nvEtat;
            return $this;
        }

        public function getCategorie(){
            return $this->categorie;
        }

        public function setCategorie($nvCat){
            $this->categorie = $nvCat;
            return $this;
        }

        public function getUser(){
            return $this->user;
        }

        public function setUser($nvUser){
            $this->user = $nvUser;
            return $this;
        }

        public function getNbPostsTopic(){
            return $this->nbPostsTopic;
        }

        public function setNbPostsTopic($nvNbPosts){
            $this->nbPostsTopic = $nvNbPosts;
            return $this;
        }

        //ToString
        public function __toString()
        {
            return $this->titreTopic;
        }

    }
?>