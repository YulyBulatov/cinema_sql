/*Réalisez les   requêtes   SQL   suivantesavec   PhpMyAdmin   (rédigezles requêtes   dans   un document  Word  afin  de  garder  un  historique  de  celles-ci):entre  parenthèse  les champs servant de référence aux requêtes.


A. Informations d’un film(id_film): titre, année, durée (au format HH:MM) et réalisateur*/

SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), "%H:%i") AS duree, nom AS nom_realisateur
FROM film
INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE id_film = 1

/*B. Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court*/

SELECT titre_film, SEC_TO_TIME(duree_minutes*60) AS duree
FROM film
WHERE duree_minutes > 135
ORDER BY duree DESC

/*C. Liste des films d’un réalisateur (en précisant l’année de sortie)*/

SELECT nom, prenom, titre_film, YEAR(anne_sortie) AS anne_sortie
FROM personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
WHERE id_personne = 2

/*D. Nombre de films par genre (classés dans l’ordre décroissant)*/

SELECT nom_genre, COUNT(id_film) AS nbre_films
FROM genre
INNER JOIN posseder ON genre.id_genre = posseder.id_genre
GROUP BY id_genre
ORDER BY nbre_films DESC

/*E. Nombre de films par réalisateur (classés dans l’ordre décroissant)*/

SELECT nom, prenom, COUNT(id_film) AS nbre_film
FROM personne
INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
INNER JOIN film ON realisateur.id_realisateur = film.id_realisateur
GROUP BY id_personne
ORDER BY nbre_film DESC

/*F. Casting d’un film en particulier (id_film): nom, prénom des acteurs + sexe*/

SELECT titre_film, nom, prenom, sexe, nom_personnage
FROM film
INNER JOIN casting ON film.id_film = casting.id_film
INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
INNER JOIN acteur ON casting.id_acteur = acteur.id_acteur
INNER JOIN personne ON acteur.id_personne = personne.id_personne
WHERE film.id_film = 1 

/*G. Films tournés par un acteur en particulier (id_acteur)avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)*/

SELECT nom, prenom, titre_film, nom_personnage, YEAR(anne_sortie) AS anne_sortie
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
INNER JOIN personnage ON casting.id_personnage = personnage.id_personnage
INNER JOIN film ON casting.id_film = film.id_film
WHERE acteur.id_acteur = 4
ORDER BY anne_sortie DESC

/*H. Listes des personnes qui sont à la fois acteurs et réalisateurs*/

SELECT nom, prenom
FROM personne, acteur, realisateur
WHERE personne.id_personne = acteur.id_personne AND personne.id_personne = realisateur.id_personne

/*I. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)*/

SELECT titre_film, YEAR(anne_sortie) AS anne_sortie
FROM film
WHERE (YEAR(NOW()) - YEAR(anne_sortie)) <= 5
ORDER BY anne_sortie DESC

/*J. Nombre d’hommes et de femmes parmi les acteurs*/

SELECT sexe, COUNT(id_acteur) AS nbre_acteur
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
GROUP BY sexe

/*K.Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)*/

SELECT nom, prenom, FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) AS age
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
WHERE FLOOR(DATEDIFF(NOW(), date_naissance) / 365.25) > 50 

/*L. Acteurs ayant joué dans 3 films ou plus*/

SELECT nom, prenom, COUNT(id_film) AS nbre_film
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
INNER JOIN casting ON acteur.id_acteur = casting.id_acteur
GROUP BY id_personne
HAVING  COUNT(id_film) >= 3