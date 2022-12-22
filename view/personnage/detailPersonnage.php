<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>
<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Titre de Film</th>
            <th>Acteur</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $indexF = $film['id_film'];
        $indexA = $film['id_acteur'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$indexF>".$film['titre_film']."</a></td>",
                        "<td><a href = index.php?action=detailActeur&id=$indexA>".$film['prenom']." ".$film['nom']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>
</div>
<?php


$titre = "Filmographie de ".$film['nom_personnage'];
$titre_secondaire = "Filmographie de ".$film['nom_personnage'];
$contenu = ob_get_clean();
require "view/template.php";