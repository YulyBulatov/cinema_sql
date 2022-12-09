<?php

namespace Controller;

class HomeController {

    public function index(){
        require "view/home/home.php";
    }

    public function formAddFilm(){
        require "view/home/formAddFilm";
    }
}