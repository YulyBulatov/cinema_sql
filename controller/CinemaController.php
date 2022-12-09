<?php


namespace Controller;

include ('model/Connect.php');
use Model\Connect;

    class CinemaController{



        public function listFilms(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_film, titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom
            FROM film
            INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne";
            $requete = $pdo->query($sqlQuery);

            require "view/film/listFilms.php";
        }

        public function detailFilm($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom, synopsis, note_film, id_film
            FROM film
            INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_film = :id
            ";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/film/detailFilm.php";
        }

        public function castingFilm($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT titre_film, nom, prenom, sexe, nom_personnage, personnage.id_personnage AS id_personnage, acteur.id_acteur AS id_acteur, film.id_film AS id_film
            FROM film
            INNER JOIN casting ON film.id_film = casting.id_film
            INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE film.id_film = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/film/castingFilm.php";
        }

        public function listRealisateurs(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_realisateur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age
            FROM personne, realisateur
            WHERE personne.id_personne = realisateur.id_personne";
            $requete = $pdo->query($sqlQuery);

            require "view/realisateur/listRealisateur.php";
        }

        public function detailRealisateur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_realisateur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe
            FROM personne, realisateur
            WHERE personne.id_personne = realisateur.id_personne AND realisateur.id_realisateur = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/realisateur/detailRealisteur.php";

        }

        public function filmographieRealisateur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_film, nom, prenom, titre_film, YEAR(anne_sortie) AS anne_sortie
            FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
            WHERE realisateur.id_realisateur = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/realisateur/filmographieRealisateur.php";
        }

        public function listActeurs(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_acteur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe
            FROM personne, acteur
            WHERE personne.id_personne = acteur.id_personne";
            $requete = $pdo->query($sqlQuery);

            require "view/acteur/listActeurs.php";
        }

        public function detailActeur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_acteur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe
            FROM personne, acteur
            WHERE personne.id_personne = acteur.id_personne AND acteur.id_acteur = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/acteur/detailActeur.php";

        }


        public function filmographieActeur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT nom, prenom, film.id_film, titre_film, nom_personnage, YEAR(anne_sortie) AS anne_sortie
            FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
            INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
            INNER JOIN film ON casting.id_film = film.id_film
            WHERE acteur.id_acteur = :id
            ORDER BY anne_sortie DESC";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/realisateur/filmographieRealisateur.php";
        }

        public function listGenres(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT *
            FROM genre";
            $requete = $pdo->query($sqlQuery);

            require "view/genre/listGenres.php";
        }

        public function filmsGenre($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT film.id_film AS id_film, titre_film, nom_genre
            FROM film
            INNER JOIN posseder ON film.id_film = posseder.id_film
            INNER JOIN genre ON posseder.id_genre = genre.id_genre
            WHERE genre.id_genre = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/genre/filmsGenre.php";    
        }

        public function listPersonnages(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT * 
            FROM personnage";
            $requete = $pdo->query($sqlQuery);

            require "view/personnage/listPersonnages.php";
        }

        public function detailPersonnage($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT film.id_film AS id_film, titre_film, nom, prenom, acteur.id_acteur AS id_acteur, nom_personnage
            FROM film
            INNER JOIN casting ON film.id_film=casting.id_film
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
            WHERE personnage.id_personnage = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            require "view/personnage/detailPersonnage.php";

        }



    }