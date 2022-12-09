<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Genre(s)</p>

<table>
    <thead>
        <tr>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $genre){

        $index = $genre['id_genre'];

            echo    "<tr>",
                        "<td><a href=index.php?action=filmsGenre&id=$index>".$genre['nom_genre']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";