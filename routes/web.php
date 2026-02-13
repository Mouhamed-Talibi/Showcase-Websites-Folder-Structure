<?php

    use App\Core\Router;

    $router->get('/', 'HomeController@index');
    $router->get('/login', 'HomeController@login');
    $router->post('/signup', 'HomeController@signup');

?>