<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
<?php

    foreach($requete->fetchAll() as $film){

        $index = $film['id_film'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$index>".$film['titre_film']."</a></td>",
                        "<td>".$film['anne_sortie']."</td>",
                    "</tr>";
        }             
?>
    </tbody>
</table>
</div>
<br>

<p>Ce réalisateur n'a pas votre film préféré?<br>
Vous pouvez rajouter un nouveau film <a href=index.php?action=formAddFilm>ici</a>.</p>
<?php

foreach($requete1->fetchALL() as $realisateur){

    $titre = "Filmographie de ".$realisateur['prenom']." ".$realisateur['nom'];
    $titre_secondaire = "Filmographie de ".$realisateur['prenom']." ".$realisateur['nom'];
}
$contenu = ob_get_clean();
require "view/template.php";