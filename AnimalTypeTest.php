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

    class AnimalTypeTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     AnimalType::deleteAll();
        //     Animal::deleteAll();
        // }
        //
        // function test_getName()
        // {
        //     //Arrange
        //     $name = "dog";
        //     $test_animal_type = new AnimalType($name);
        //
        //     //Act
        //     $result = $test_animal_type->getName();
        //
        //     //Assert
        //     $this->assertEquals($name, $result);
        // }


    }

?>
