<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> acteur(s)</p>

<table>
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Sexe</th>
            <th>Filmographie</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $acteur){

        $index = $acteur['id_acteur'];

            echo    "<tr>",
                        "<td>".$acteur['prenom']."</a></td>",
                        "<td>".$acteur['nom']."</td>",
                        "<td>".$acteur['age']."</td>",
                        "<td>".$acteur['sexe']."</td>",
                        "<td><a href=index.php?action=filmographieActeur&id=$index>Filmographie</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>

<form action="index.php?action=addActeur" method="post">
    <label>Nom : 
        <input type="text" name="nom">
    </label>
    <label>Prenom :
        <input type="text" name="prenom">
    </label>
    <label>Sexe :
        <input type="radio" name="sexe" value="f">
        <input type="radio" name="sexe" value="m">
        <input type="radio" name="sexe" value="Autre">
    </label>
    <label>Date de naissance :
        <input type="date" name="date_naissance">
    </label>
</form>
<?php


$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";