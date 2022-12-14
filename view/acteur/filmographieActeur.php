<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Année de sortie</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $index = $film['id_film'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$index>".$film['titre_film']."</a></td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td>".$film['nom_personnage']."</td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Filmographie de ".$film['prenom']." ".$film['nom'];
$titre_secondaire = "Filmographie de ".$film['prenom']." ".$film['nom'];
$contenu = ob_get_clean();
require "view/template.php";