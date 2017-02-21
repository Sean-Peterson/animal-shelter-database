<?php
    class Animal
    {
            private $id;
            private $type_id;
            private $breed;
            private $name;
            private $gender;
            private $admittance_date;

            function __construct($id = null, $type_id, $breed, $name, $gender, $admittance_date)
            {
                $this->id = $id;
                $this->type_id = $type_id;
                $this->breed = $breed;
                $this->name = $name;
                $this->gender = $gender;
                $this->admittance_date = $admittance_date;
            }
            function setBreed($new_breed)
            {
              $this->breed = (string) $new_breed;
            }
            function getBreed()
            {
              return $this->breed;
            }

            function setName($new_name)
            {
                $this->name = (string) $new_name;
            }
            function getName()
            {
                return $this->name;
            }
            function setGender($new_gender)
            {
                $this->gender = (string) $new_gender;
            }
            function getGender()
            {
                return $this->gender;
            }
            function setAdmittanceDate($new_admittance_date)
            {
                $this->admittance_date = (string) $new_admittance_date;
            }
            function getAdmittanceDate()
            {
                return $this->admittance_date;
            }

            function getId()
            {
                return $this->id;
            }


            function getTypeId()
            {
                return $this->type_id;
            }

            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO animal (type_id, breed, name, gender, admittance_date) VALUES ({$this->getTypeId()}, '{$this->getBreed()}','{$this->getName()}','{$this->getGender()}','{$this->getAdmittanceDate()}')");
                $this->id = $GLOBALS['DB']->lastInsertId();
            }

            static function getAll()
            {
                $returned_animals = $GLOBALS['DB']->query("SELECT * FROM animal;");
                $animals = array();
                foreach ($returned_animals as $animal) {
                    $id = $animal['id'];
                    $type_id = $animal['type_id'];
                    $breed = $animal['breed'];
                    $name = $animal['name'];
                    $gender = $animal['gender'];
                    $admittance_date = $animal['admittance_date'];
                    $new_animal = new Animal($id, $type_id, $breed, $name, $gender, $admittance_date);
                    array_push($animals, $new_animal);
                }
               return $animals;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM animal;");
            }

            static function find($search_id)
            {
                $found_animal = null;
                $animals = Animal::getAll();
                foreach ($animals as $animal) {
                    $animal_id = $animal->getId();
                    if ($animal_id == $search_id){
                        $found_animal = $animal;
                    }
                }
                return $found_animal;
            }

    }
?>
