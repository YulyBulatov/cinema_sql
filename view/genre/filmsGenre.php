<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre de film</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $index = $film['id_film'];

            echo    "<tr>",
                        "<td><a href=index.php?action=detailFilm&id=$index>".$film['titre_film']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Liste des film de genre ".$film['nom_genre'];
$titre_secondaire = "Liste des film de genre ".$film['nom_genre'];
$contenu = ob_get_clean();
require "view/template.php";