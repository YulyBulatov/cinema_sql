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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $acteur){

        $indexA = $acteur['id_acteur'];
        $indexP = $acteur['id_personne'];

            echo    "<tr>",
                        "<td>".$acteur['prenom']."</a></td>",
                        "<td>".$acteur['nom']."</td>",
                        "<td>".$acteur['age']."</td>",
                        "<td>".$acteur['sexe']."</td>",
                        "<td><a href=index.php?action=filmographieActeur&id=$indexA>Filmographie</a></td>",
                        "<td><a href=index.php?action=deleteActeur&id=$indexP>Supprimer</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>
<label>Ajouter un nouveau acteur :
    <form action="index.php?action=addActeur" method="post">
        <label>Nom : 
            <input type="text" name="nom">
        </label>
        <label>Prenom :
            <input type="text" name="prenom">
        </label>
        <label>Sexe :
            <input type="radio" name="sexe" value="f">f
            <input type="radio" name="sexe" value="m">m
            <input type="radio" name="sexe" value="Autre">Autre
        </label>
        <label>Date de naissance :
            <input type="date" name="date_naissance">
        </label>
        <input type="submit" name="submit" value="Ajouter">
    </form>
</label>
<?php


$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";