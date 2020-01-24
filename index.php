<?php

//Start a session
session_start();

// Turn on error reporting - this is critical!
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function (){
    //$view = new Template();
    //echo $view->render('views/home.html');
    echo "<h1>My Pets</h1>";
    echo "<a href='order'>Order a Pet</a>";
});

//Define a order route
$f3->route('GET /order', function (){
    $view = new Template();
    echo $view->render('views/form1.html');
});

//Define a order2 route
$f3->route('POST /order2', function (){

    $_SESSION['animal'] = $_POST['animal'];

    $view = new Template();
    echo $view->render('views/form2.html');
});

//Define a results route
$f3->route('POST /results', function (){
    $_SESSION['color'] = $_POST['color'];

    $view = new Template();
    echo $view->render('views/results.html');
});


//Define a animal type route
$f3->route("GET /@item", function($f3, $params){
    //var_dump($params);
    $item = $params["item"];
    //echo "<p>You Ordered $item</p>";

    $foodsWeServe = array("chicken", "dog", "cat", "owl", "snake");
    if(!in_array($item, $foodsWeServe)){
        echo "<p>Sorry... we don't have this animal $item</p>";
    }

    switch ($item){
        case 'chicken':
            echo "<p>Cluck!</p>";
            break;
        case 'dog':
            echo "<p>Woof!</p>";
            break;
        case 'cat':
            echo "<p>meow!</p>";
            break;
        case 'owl':
            echo "<p>ooo!</p>";
            break;
        case 'snake':
            echo "<p>hiss!</p>";
            break;
        default:
            $f3->error(404);
    }

});



//Run fat free
$f3->run();