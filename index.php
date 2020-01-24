<?php

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

//Define a animal type route
$f3->route("GET /@item", function($f3, $params){
    var_dump($params);
    $item = $params["item"];
    echo "<p>You Ordered $item</p>";

    $foodsWeServe = array("chicken", "dog", "cat", "owl", "snake");
    if(!in_array($item, $foodsWeServe)){
        echo "<p>Sorry... we don't serve $item</p>";
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