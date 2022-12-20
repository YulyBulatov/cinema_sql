<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Année de sortie</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $index = $film['id_film'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$index>".$film['titre_film']."</a></td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td>".$film['nom_personnage']."</td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>

<form action="index.php?action=addCastingActeur" method="post"> 
            <td>
                <select name="film">
                    <?php foreach($requete3->fetchALL() as $film){
                        echo "<option value = '".$film['id_film']."'>".$film['titre_film']."</option>";                    
                    }?>
                </select>
            </td>
            <td>
                <select name="personnage">
                    <?php foreach($requete4->fetchALL() as $personnage){
                        echo "<option value = '".$personnage['id_personnage']."'>".$personnage['nom_personnage']."</option>";                    
                    }?>
                </select>
            </td>
            <td>
                <input type="hidden" name="id_acteur" value=<?= $_GET["id"]?>>
                <input type="submit" name="submit" value="Ajouter">
            </td>


<?php

foreach($requete1->fetchALL() as $acteur){
    $titre = "Filmographie de ".$acteur['prenom']." ".$acteur['nom'];
    $titre_secondaire = "Filmographie de ".$acteur['prenom']." ".$acteur['nom'];
}
$contenu = ob_get_clean();
require "view/template.php";