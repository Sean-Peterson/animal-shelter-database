<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Animal.php";
require_once "src/AnimalType.php";

$server = 'mysql:host=localhost:8889;dbname=animal_shelter_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class AnimalTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Animal::deleteAll();
        AnimalType::deleteAll();
    }

    function test_save()
    {
        // Arrange
        $id = null;
        $type_id = 1;
        $breed = "Golden";
        $name = "Roscoe";
        $gender = "Male";
        $admittance_date = "2010-1-1";
        $test_animal = new Animal($id, $type_id, $breed, $name, $gender, $admittance_date);

        // Act
        $test_animal->save();
        $result = Animal::getAll();

        // Assert
        var_dump($result);
        $this->assertEquals($test_animal, $result[0]);

    }


}

?>
