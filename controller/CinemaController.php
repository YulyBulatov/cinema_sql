<?php


namespace Controller;

include ('model/Connect.php');
use Model\Connect;

    class CinemaController{



        public function listFilms(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT film.id_film AS id_film, titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom, realisateur.id_realisateur AS id_realisateur
            FROM film
            INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne";
            $requete = $pdo->query($sqlQuery);

            require "view/film/listFilms.php";
        }

        public function detailFilm($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom, synopsis, note_film, likes, id_film, film.id_realisateur AS id_realisateur
            FROM film
            INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            WHERE id_film = :id
            ";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            $sqlQuery1 = "SELECT nom_genre, genre.id_genre AS id_genre
            FROM genre
            INNER JOIN posseder ON genre.id_genre = posseder.id_genre
            WHERE id_film = :id";
            $requete1 = $pdo->prepare($sqlQuery1);
            $requete1->execute(["id" => $id]);

            $sqlQuery2 = "SELECT titre_film, nom, prenom, sexe, nom_personnage, personnage.id_personnage AS id_personnage, acteur.id_acteur AS id_acteur, film.id_film AS id_film
            FROM film
            INNER JOIN casting ON film.id_film = casting.id_film
            INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
            INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE film.id_film = :id";
            $requete2 = $pdo->prepare($sqlQuery2);
            $requete2->execute(["id" => $id]);

            $sqlQuery3 = "SELECT acteur.id_acteur AS id_acteur, nom, prenom
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne";
            $requete3 = $pdo->query($sqlQuery3);

            $sqlQuery4 = "SELECT id_personnage, nom_personnage
            FROM personnage";
            $requete4 = $pdo->query($sqlQuery4);

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

        public function formAddFilm(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_realisateur, nom, prenom
            FROM personne, realisateur
            WHERE personne.id_personne = realisateur.id_personne";
            $requete = $pdo->query($sqlQuery);
            $sqlQuery2 = "SELECT *
            FROM genre";
            $requete2 = $pdo->query($sqlQuery2);

            require "view/film/formAddFilm.php";
        }

        public function addFilm(){

            
            $pdo = Connect::seConnecter();

            if(isset($_POST['submit'])){

                $titre = filter_input(INPUT_POST, "titre_film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $annee = filter_input(INPUT_POST, "annee_sortie");
                $duree = filter_input(INPUT_POST, "duree_minutes", FILTER_SANITIZE_NUMBER_INT);
                $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $note = filter_input(INPUT_POST, "note_film",FILTER_SANITIZE_NUMBER_INT);
                $affiche = filter_input(INPUT_POST, "affiche_film", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $realisateur = filter_input(INPUT_POST,"realisateur", FILTER_SANITIZE_NUMBER_INT);
                $genres = filter_input(INPUT_POST, "genre", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

                if($titre && $annee && $duree && $synopsis && $affiche && $realisateur && $genres){

                    $sqlQuery = "INSERT INTO film (titre_film, anne_sortie, duree_minutes, synopsis, note_film, affiche_film, id_realisateur)
                    VALUES (:titre_film, :anne_sortie, :duree, :synopsis, :note_film, :affiche_film, :id_realisateur)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue(':titre_film', $titre);
                    $requete->bindValue(':anne_sortie', $annee);
                    $requete->bindValue(':duree', $duree);
                    $requete->bindValue(':synopsis', $synopsis);
                    $requete->bindValue(':note_film', $note);
                    $requete->bindValue(':affiche_film', $affiche);
                    $requete->bindValue(':id_realisateur', $realisateur);
                    $requete->execute();

                    $id_film = $pdo->lastInsertId();

                    foreach ($genres as $genre){
                        $sqlQuery = "INSERT INTO posseder 
                        VALUES (:film, :genre)";
                        $requete = $pdo->prepare($sqlQuery);
                        $requete->bindValue(':genre', $genre);
                        $requete->bindValue(':film', $id_film);
                        $requete->execute(); 
                    }
                }
            }
            

            self::detailFilm($id_film);
        }

        public function deleteFilm($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM posseder
            WHERE id_film = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id"=>$id]); 
            $sqlQuery = "DELETE FROM film
            WHERE id_film = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id"=>$id]);
            

            self::listFilms();
        }

        public function formSynopsis($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_film, titre_film, synopsis
            FROM film
            WHERE id_film = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id"=>$id]);

            require "view/film/formSynopsis.php";
        }

        public function addSynopsis(){

            $pdo = Connect::seConnecter();

            if(isset($_POST['submit'])){
                $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $id_film = filter_input(INPUT_POST, "id_film", FILTER_SANITIZE_NUMBER_INT);

                if($synopsis && $id_film){
                    $sqlQuery = "UPDATE film
                    SET synopsis = :synopsis
                    WHERE id_film = :id_film";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue(':synopsis', $synopsis);
                    $requete->bindValue(':id_film', $id_film);
                    $requete->execute();
                }
            }


        
            self::detailFilm($id_film);

        }

        public function listRealisateurs(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_realisateur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, personne.id_personne AS id_personne
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
            $sqlQuery = "SELECT id_realisateur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe
            FROM personne, realisateur
            WHERE personne.id_personne = realisateur.id_personne AND realisateur.id_realisateur = :id";
            $requete1 = $pdo->prepare($sqlQuery);
            $requete1->execute(["id" => $id]);


            require "view/realisateur/filmographieRealisateur.php";
        }

        public function addRealisateur(){

            if(isset($_POST['submit'])){

                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date = filter_input(INPUT_POST, "date_naissance");

                if($nom && $prenom && $sexe && $date){

                    $pdo = Connect::seConnecter();
                    $sqlQuery = "INSERT INTO personne (nom, prenom, sexe, date_naissance)
                    VALUES (:nom, :prenom, :sexe, :date_naissance)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue(":nom", $nom);
                    $requete->bindValue(":prenom", $prenom);
                    $requete->bindValue(":sexe", $sexe);
                    $requete->bindValue(":date_naissance", $date);
                    $requete->execute();

                    $id = $pdo->lastInsertId();

                    $sqlQuery = "INSERT INTO realisateur (id_personne)
                    VALUES (:id)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->execute(["id" => $id]);

                }
            }

            self::listRealisateurs();
        }

        public function deleteRealisateur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM realisateur
            WHERE id_personne = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            $sqlQuery = "DELETE FROM personne
            WHERE id_personne = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            self::listRealisateurs();
        }

        public function listActeurs(){

            $pdo = Connect::seConnecter();
            $sqlQuery = "SELECT id_acteur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe, personne.id_personne AS id_personne
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
            $sqlQuery = "SELECT nom, prenom, film.id_film AS id_film, titre_film, nom_personnage, YEAR(anne_sortie) AS anne_sortie
            FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
            INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
            INNER JOIN film ON casting.id_film = film.id_film
            WHERE acteur.id_acteur = :id
            ORDER BY anne_sortie DESC";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            $sqlQuery = "SELECT id_acteur, nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age, sexe
            FROM personne, acteur
            WHERE personne.id_personne = acteur.id_personne AND acteur.id_acteur = :id";
            $requete1 = $pdo->prepare($sqlQuery);
            $requete1->execute(["id" => $id]);

            $sqlQuery3 = "SELECT id_film, titre_film
            FROM film";
            $requete3 = $pdo->query($sqlQuery3);

            $sqlQuery4 = "SELECT id_personnage, nom_personnage
            FROM personnage";
            $requete4 = $pdo->query($sqlQuery4);



            require "view/acteur/filmographieActeur.php";
        }

        public function addActeur(){

            if(isset($_POST['submit'])){

                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date = filter_input(INPUT_POST, "date_naissance");

                if($nom && $prenom && $sexe && $date){

                    $pdo = Connect::seConnecter();
                    $sqlQuery = "INSERT INTO personne (nom, prenom, sexe, date_naissance)
                    VALUES (:nom, :prenom, :sexe, :date_naissance)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue(":nom", $nom);
                    $requete->bindValue(":prenom", $prenom);
                    $requete->bindValue(":sexe", $sexe);
                    $requete->bindValue(":date_naissance", $date);
                    $requete->execute();

                    $id = $pdo->lastInsertId();

                    $sqlQuery = "INSERT INTO acteur (id_personne)
                    VALUES (:id)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->execute(["id" => $id]);

                }
            }

            self::listActeurs();
        }

        public function deleteActeur($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM acteur
            WHERE id_personne = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            $sqlQuery = "DELETE FROM personne
            WHERE id_personne = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            self::listActeurs();
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

        public function addGenre(){

            if(isset($_POST['submit'])){

                $nom_genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($nom_genre){

                    $pdo = Connect::seConnecter();
                    $sqlQuery =  "INSERT INTO genre (nom_genre)
                    VALUES (:nom_genre)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->execute(["nom_genre" => $nom_genre]);
                }
            }

            self::listGenres();
            
        }

        public function deleteGenre($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM genre
            WHERE id_genre = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            self::listGenres();

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

        public function addPersonnage(){

            if(isset($_POST['submit'])){

                $nom_personnage = filter_input(INPUT_POST, "nom_personnage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($nom_personnage){

                    $pdo = Connect::seConnecter();
                    $sqlQuery = "INSERT INTO personnage (nom_personnage)
                    VALUES (:nom_personnage)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->execute(["nom_personnage" => $nom_personnage]);

                }
            }

            self::listPersonnages();

        }

        public function deletePersonnage($id){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM personnage
            WHERE id_personnage = :id";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id" => $id]);

            self::listPersonnages();
        }

        public function addCasting(){

            if(isset($_POST["submit"])){

                $id_acteur = filter_input(INPUT_POST, "acteur", FILTER_SANITIZE_NUMBER_INT);
                $id_personnage = filter_input(INPUT_POST, "personnage", FILTER_SANITIZE_NUMBER_INT);
                $id_film = filter_input(INPUT_POST, "id_film", FILTER_SANITIZE_NUMBER_INT);

                if($id_acteur && $id_personnage && $id_film){

                    $pdo = Connect::seConnecter();
                    $sqlQuery = "INSERT INTO casting
                    VALUES (:id_film, :id_acteur, :id_personnage)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue("id_acteur", $id_acteur);
                    $requete->bindValue("id_personnage", $id_personnage);
                    $requete->bindValue("id_film", $id_film);
                    $requete->execute();

                }
            }

            self::detailFilm($id_film);
        }

        public function deleteCasting($id_film, $id_acteur, $id_personnage){

            $pdo = Connect::seConnecter();
            $sqlQuery = "DELETE FROM casting
            WHERE id_film = :id_film AND id_acteur = :id_acteur AND id_personnage = :id_personnage";
            $requete = $pdo->prepare($sqlQuery);
            $requete->bindValue("id_acteur", $id_acteur);
            $requete->bindValue("id_personnage", $id_personnage);
            $requete->bindValue("id_film", $id_film);
            $requete->execute();

            self::detailFilm($id_film);
        }

        public function addCastingActeur(){

            if(isset($_POST["submit"])){

                $id_acteur = filter_input(INPUT_POST, "id_acteur", FILTER_SANITIZE_NUMBER_INT);
                $id_personnage = filter_input(INPUT_POST, "personnage", FILTER_SANITIZE_NUMBER_INT);
                $id_film = filter_input(INPUT_POST, "film", FILTER_SANITIZE_NUMBER_INT);

                if($id_acteur && $id_personnage && $id_film){

                    $pdo = Connect::seConnecter();
                    $sqlQuery = "INSERT INTO casting
                    VALUES (:id_film, :id_acteur, :id_personnage)";
                    $requete = $pdo->prepare($sqlQuery);
                    $requete->bindValue("id_acteur", $id_acteur);
                    $requete->bindValue("id_personnage", $id_personnage);
                    $requete->bindValue("id_film", $id_film);
                    $requete->execute();

                }
            }

            self::filmographieActeur($id_acteur);
        }

        public function like($id){
               
            $pdo = Connect::seConnecter();
            $sqlQuery = "UPDATE film
            SET likes = likes + 1
            WHERE id_film = :id_film";
            $requete = $pdo->prepare($sqlQuery);
            $requete->execute(["id_film" => $id]);
            
            self::detailFilm($id);
        }

            
        }        



    