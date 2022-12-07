<?php

try
{
    $db = new PDO('mysql:host=localhost;dbname=cinema_yuly;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e)
{
    die('Erreur : '. $e->getMessage());
}


$sqlQuery = "SELECT titre_film, TIME_FORMAT(SEC_TO_TIME(duree_minutes*60), '%H:%i') AS duree, YEAR(anne_sortie) AS anne_sortie, nom, prenom
FROM film
INNER JOIN realisateur on film.id_realisateur = realisateur.id_realisateur
INNER JOIN personne ON realisateur.id_personne = personne.id_personne
";

$stmt = $db->prepare($sqlQuery);
$stmt->execute();

$films = $stmt->fetchAll();

echo "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>Titre Film</th>",
                            "<th>Duree</th>",
                            "<th>Anné de sortie</th>",
                            "<th>Prenom Réalisateur</th>",
                            "<th>Nom Réalisateur</th>",
                        "</tr>",
                    "</thead>",
                    "<tbody>";

foreach($films as $film){

    echo "<tr>",
                        "<td>".$film['titre_film']."</td>",
                        "<td>".$film['duree']."</td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td>".$film['prenom']."</td>",
                        "<td>".$film['nom']."</td>",
                    "</tr>";
}