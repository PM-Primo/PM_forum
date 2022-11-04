<?php

    namespace Model\Entities;

    use App\Entity;

    final class Categorie extends Entity{

        private $id;
        private $nomCategorie;

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

        public function getNomCategorie()
        {
            return $this->nomCategorie;
        }

        public function setNomCategorie($nvNom)
        {
            $this->nomCategorie = $nvNom;
            return $this;
        }

    }

?>