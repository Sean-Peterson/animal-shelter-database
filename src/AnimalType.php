<?php
    class AnimalType
    {
        private $name;
        private $id;

        function __construct($id = null, $name)
        {
            $this->name = $name;
            $this->id =$id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO animal_type (animal_type) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_animal_type = $GLOBALS['DB']->query("SELECT * FROM animal_type;");
            $types = array();
            foreach($returned_animal_type as $type){
                $id = $type['id'];
                $atype = $type['animal_type'];
                $new_type = new AnimalType($id, $atype);
                array_push($types, $new_type);
            }
            return $types;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM animal_type;");
        }

        static function find($search_id)
        {
            $found_type = null;
            $animal_type = AnimalType::getAll();
            foreach($animal_type as $type) {
                $type_id = $type->getId();
                if ($type_id == $search_id) {
                    $found_type = $type;
                }
            }
            return $found_type;
        }

        function getAnimals($order)
        {
            $animals = array();
            $returned_animals = $GLOBALS['DB']->query("SELECT * FROM animal WHERE type_id = {$this->getId()} ORDER BY {$order};");
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
    }
?>
