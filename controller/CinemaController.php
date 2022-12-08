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

        public function detailFilm($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom, synopsis, note_film
            FROM film
            INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_film = :id
            ";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/detailFilm.php";
        }


    }