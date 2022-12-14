<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> personnage(s)</p>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Nom de personnage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $personnage){

        $index = $personnage['id_personnage'];

            echo    "<tr>",
                        "<td><a href=index.php?action=detailPersonnage&id=$index>".$personnage['nom_personnage']."</a></td>",
                        "<td><a href=index.php?action=deletePersonnage&id=$index>Supprimer</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>
</div>
<br>

<p>Ajouter un nouveau personnage : </p>
<form action=index.php?action=addPersonnage method="post">
    <input type="text" name = "nom_personnage" maxlength="255">
    <input type="submit" name = "submit" value="Ajouter">
</form>



<?php


$titre = "Liste des personnages";
$titre_secondaire = "Liste des personnages";
$contenu = ob_get_clean();
require "view/template.php";