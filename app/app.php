<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Animal.php";
    require_once __DIR__."/../src/AnimalType.php";


    $app = new Silex\Application();

    $app['debug'] = true;


    $server = 'mysql:host=localhost:8889;dbname=animal_shelter';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('animal_types' => AnimalType::getAll()));
    });

    $app->get("/animal_type/{id}", function($id) use ($app) {
        $animal_type= AnimalType::find($id);
        return $app['twig']->render('animal_types.html.twig', array('animal_type' => $animal_type, 'animals' => $animal_type->getAnimals('admittance_date')));
    });
    $app->post("/order/{id}", function($id) use ($app) {
        $animal_type= AnimalType::find($id);
        $order= $_POST['order'];
        return $app['twig']->render('animal_types.html.twig', array('animal_type' => $animal_type, 'animals' => $animal_type->getAnimals($order)));
    });

    $app->post("/add_animal_type", function() use ($app) {
        $name = $_POST['name'];
        $id = null;
        $new_animal_type = new AnimalType($id, $name);
        $new_animal_type->save();
        return $app['twig']->render('index.html.twig', array('animal_types' => AnimalType::getAll()));
    });

    $app->post("/add_animal/{id}", function($id) use ($app) {
        $something = null;
        $new_animal = new Animal($something, (int)$_POST['animal_type'], $_POST['breed'], $_POST['name'], $_POST['gender'], $_POST['date']);
        $new_animal->save();
        $animal_type= AnimalType::find($id);
        return $app['twig']->render('animal_types.html.twig', array('animal_type' => $animal_type, 'animals' => $animal_type->getAnimals('admittance_date')));
    });





    return $app;
?>
