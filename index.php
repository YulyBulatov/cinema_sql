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
        case "castingFilm": $ctrlCinema->castingFilm($id); break;
        case "listRealisateurs": $ctrlCinema->listRealisateurs(); break;
        case "detailRealisateur": $ctrlCinema->detailRealisateur($id); break;   
        case "filmographieRealisateur": $ctrlCinema->filmographieRealisateur($id); break;
        case "listActeurs": $ctrlCinema->listActeurs(); break;
        case "detailActeur": $ctrlCinema->detailActeur($id); break;
        case "filmographieActeur": $ctrlCinema->filmographieActeur($id); break;
        case "listGenres":$ctrlCinema->listGenres(); break;
        case "filmsGenre":$ctrlCinema->filmsGenre($id); break;
        case "listPersonnages":$ctrlCinema->listPersonnages(); break;
        case "detailPersonnage": $ctrlCinema->detailPersonnage($id); break;

        case "home": $ctrlHome->index(); break;
    }
}
else{
    $ctrlHome->index();
}