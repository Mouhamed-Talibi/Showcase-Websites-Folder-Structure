<?php

    use App\Core\Router;

    $router->get('/', 'HomeController@index');
    $router->post('/signup', 'HomeController@signup');

