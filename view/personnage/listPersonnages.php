<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> personnage(s)</p>

<table>
    <thead>
        <tr>
            <th>Nom de personnage</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $personnage){

        $index = $personnage['id_personnage'];

            echo    "<tr>",
                        "<td><a href=index.php?action=detailPersonnage&id=$index>".$personnage['nom_personnage']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>

<a href=index.php?action=addPersonnage>Ajouter un nouveau personnage</a>


<?php


$titre = "Liste des personnages";
$titre_secondaire = "Liste des personnages";
$contenu = ob_get_clean();
require "view/template.php";