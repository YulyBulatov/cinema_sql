<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> realisateur(s)</p>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Filmographie</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $realisateur){

        $indexR = $realisateur['id_realisateur'];
        $indexP = $realisateur['id_personne'];

            echo    "<tr>",
                        "<td>".$realisateur['prenom']."</a></td>",
                        "<td>".$realisateur['nom']."</td>",
                        "<td>".$realisateur['age']."</td>",
                        "<td><a href=index.php?action=filmographieRealisateur&id=$indexR>Filmographie</a></td>",
                        "<td><a href=index.php?action=deleteRealisateur&id=$indexP>Supprimer</a></td>";
                    "</tr>";
}
?>
    </tbody>
</table>
</div>
<br>

<label>Ajouter un nouveau realisateur :
    <form action="index.php?action=addRealisateur" method="post">
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


$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";