<?php

    namespace App\Controllers;

    use App\Core\View;

    class HomeController 
    {

        // index method
        public function index ()
        {
            View::render('home', [
                'title' => 'Mohamed talibi',
                'name' => 'Mohamed talibi',
                'css' => ['main.css']
            ]);
        }

        public function signup ()
        {
            echo "Hello from signup method ";
        }

    }


?>