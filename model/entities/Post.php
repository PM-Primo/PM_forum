<?php

    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $datePost;
        private $textePost;
        private $topic;
        private $user;


        //Constructeur
        public function __construct($data){         
            $this->hydrate($data);        
        }

        //Get & Set pour tous les attributs

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        public function getDatePost()
        {
            $formattedDate = $this->datePost->format("d/m/Y, H:i:s");
            return $formattedDate;       
        }

        public function setDatePost($nvDate)
        {
            $this->datePost = new \DateTime($nvDate);
            return $this;
        }

        public function getTextePost()
        {
            return $this->textePost;
        }

        public function setTextePost($nvTxt)
        {
            $this->textePost = $nvTxt;
            return $this;
        }

        public function getTopic()
        {
            return $this->topic;
        }

        public function setTopic($nvTopic)
        {
            $this->topic = $nvTopic;
            return $this;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function setUser($nvUser)
        {
            $this->user = $nvUser;
            return $this;
        }

        //ToString
        public function __toString()
        {
            return $this->textePost;
        }
    }

?>