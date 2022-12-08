<?php

include ('controller/CinemaController.php');
include ('controller/HomeController.php');

use Controller\CinemaController;
use Controller\HomeController;

spl_autoload_register(function ($class_name) {

    include $class_name . '.php';

});

$ctrlCinema = new CinemaController();
$ctrlHome = new HomeController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if (isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listFilms": $ctrlCinema->listFilms(); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;
        case "listRealisateurs": $ctrlCinema->listRealisateurs(); break;
        case "filmographieRealisateur": $ctrlCinema->filmographieRealisateur($id); break;

        case "home": $ctrlHome->index(); break;
    }
}
else{
    $ctrlHome->index();
}