<?php

namespace Controller;
use Model\Connect;

    class CinemaController{



        public function listFilms(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom
FROM film
INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
";
            $requete = $pdo->query($sqlQuery);

            require "view/listFilms.php";
        }


    }