<?php
session_start();

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
$id_a = (isset($_GET["id_a"])) ? $_GET["id_a"] : null;
$id_p = (isset($_GET["id_p"])) ? $_GET["id_p"] : null;

if (isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listFilms": $ctrlCinema->listFilms(); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;
        case "castingFilm": $ctrlCinema->castingFilm($id); break;
        case "formAddFilm": $ctrlCinema->formAddFilm(); break;
        case "addFilm": $ctrlCinema->addFilm(); break;
        case "deleteFilm": $ctrlCinema->deleteFilm($id); break;
        case "formSynopsis": $ctrlCinema->formSynopsis($id); break;
        case "addSynopsis": $ctrlCinema->addSynopsis(); break;
        case "listRealisateurs": $ctrlCinema->listRealisateurs(); break;
        case "detailRealisateur": $ctrlCinema->detailRealisateur($id); break;   
        case "filmographieRealisateur": $ctrlCinema->filmographieRealisateur($id); break;
        case "addRealisateur": $ctrlCinema->addRealisateur(); break;
        case "deleteRealisateur": $ctrlCinema->deleteRealisateur($id); break;
        case "listActeurs": $ctrlCinema->listActeurs(); break;
        case "detailActeur": $ctrlCinema->detailActeur($id); break;
        case "filmographieActeur": $ctrlCinema->filmographieActeur($id); break;
        case "addActeur": $ctrlCinema->addActeur(); break;
        case "deleteActeur":$ctrlCinema->deleteActeur($id); break;
        case "listGenres":$ctrlCinema->listGenres(); break;
        case "filmsGenre":$ctrlCinema->filmsGenre($id); break;
        case "addGenre":$ctrlCinema->addGenre(); break;
        case "deleteGenre":$ctrlCinema->deleteGenre($id); break;
        case "listPersonnages":$ctrlCinema->listPersonnages(); break;
        case "detailPersonnage": $ctrlCinema->detailPersonnage($id); break;
        case "addPersonnage": $ctrlCinema->addPersonnage(); break;
        case "deletePersonnage": $ctrlCinema->deletePersonnage($id); break;
        case "addCasting": $ctrlCinema->addCasting($id); break;
        case "deleteCasting": $ctrlCinema->deleteCasting($id, $id_a, $id_p); break;
        case "addCastingActeur": $ctrlCinema->addCastingActeur($id); break;
        case "like":$ctrlCinema->like($id); break;
        


        case "home": $ctrlHome->index(); break;
        
    }
}
else{
    $ctrlHome->index();
}