<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Duree</th>
            <th>Année de sortie</th>
            <th>Réalisateur</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $indexF = $film['id_film'];
        $indexR = $film['id_realisateur'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$indexF>".$film['titre_film']."</a></td>",
                        "<td>".$film['duree']."</td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td><a href = index.php?action=detailRealisateur&id=$indexR>".$film['prenom']." ".$film['nom']."</td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<a href=index.php?action=formAddFilm>Ajouter un nouveau film</a>

<?php


$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";