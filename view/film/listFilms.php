<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Duree</th>
            <th>Année de sortie</th>
            <th>Prenom Réalisateur</th>
            <th>Nom Réalisateur</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $index = $film['id_film'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$index>".$film['titre_film']."</a></td>",
                        "<td>".$film['duree']."</td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td>".$film['prenom']."</td>",
                        "<td>".$film['nom']."</td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";