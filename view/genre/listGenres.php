<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Genre(s)</p>

<table>
    <thead>
        <tr>
            <th>Genre</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $genre){

        $index = $genre['id_genre'];

            echo    "<tr>",
                        "<td><a href=index.php?action=filmsGenre&id=$index>".$genre['nom_genre']."</a></td>",
                        "<td><a href=index.php?action=deleteGenre&id=$index>Supprimer</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>

<p>Ajouter un nouveau genre : </p>
<form action=index.php?action=addGenre method="post">
    <input type="text" name = "nom_genre">
    <input type="submit" name = "submit" value="Ajouter">
</form>

<?php


$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";