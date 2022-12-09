<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> personnage(s)</p>

<table>
    <thead>
        <tr>
            <th>Prenom d'acteur</th>
            <th>Nom d'acteur</th>
            <th>Sexe</th>
            <th>Nom de personnage</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $role){

        $indexA = $role['id_acteur'];
        $indexP = $role['id_personnage'];

            echo    "<tr>",
                        "<td>".$role['prenom']."</td>",
                        "<td><a href = index.php?action=detailActeur&id=$indexA>".$role['nom']."</a></td>",
                        "<td>".$role['sexe']."</td>",
                        "<td><a href = index.php?action=detailPersonnage&id=$indexP>".$role['nom_personnage']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php

$indexF = $role['id_film'];
$titre = "Casting du film <a href = index.php?action=detailFilm&id=$indexF> ".$role['titre_film']."</a>";
$titre_secondaire = "Casting du film <a href = index.php?action=detailFilm&id=$indexF> ".$role['titre_film']."</a>";
$contenu = ob_get_clean();
require "view/template.php";