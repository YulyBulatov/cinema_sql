<?php ob_start(); 

 foreach($requete->fetchAll() as $film){

  $index = $film["id_film"];
  $id_realisateur = $film["id_realisateur"];

    echo    "<p>Année de sortie: ".$film['anne_sortie']."</p><br>",
            "<p>Genre(s):  </p><br>";

    foreach($requete1->fetchALL() as $genre){

        $id_genre = $genre['id_genre'];

        echo    "<p><a href=index.php?action=filmsGenre&id=$id_genre>".$genre['nom_genre']."</a></p><br>";
    }

    echo    "<label class='rating-label'><strong>La note de  film:</strong>
            <input
              class='rating'
              max='5'
              readonly
              step='1'
              style='--fill: #f1c40f
              ;--value:".$film['note_film']."'
              type='range'
              value=".$film['note_film'].">
          </label><br>",                            //Le code pour rating pris ici :https://dev.to/madsstoumann/star-rating-using-a-single-input-i0l//
          "<p>Réalisateur : <a href=index.php?action=detailRealisateur&id=$id_realisateur>".$film['prenom']." ".$film['nom']."</a></p><br>",
          "<p>Synopsis : <br>".$film['synopsis']."</p><br>",
          "<a href=index.php?action=formSynopsis&id=$index>Ajouter/Modifier le synopsis</a><br>",
          "<p> Casting : </p><br>";              
}?>
<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Nom de personnage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete2->fetchAll() as $role){

        $indexA = $role['id_acteur'];
        $indexP = $role['id_personnage'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailActeur&id=$indexA>".$role['prenom']." ".$role['nom']."</a></td>",
                        "<td><a href = index.php?action=detailPersonnage&id=$indexP>".$role['nom_personnage']."</a></td>",
                        "<td><a href = index.php?action=deleteCasting&id=$index&id_a=$indexA&id_p=$indexP>Supprimer</a></td>",
                    "</tr>";
}
?>
    <tr>
        <form action="index.php?action=addCasting" method="post"> 
            <td>
                <select name="acteur">
                    <?php foreach($requete3->fetchALL() as $acteur){
                        echo "<option value = '".$acteur['id_acteur']."'>".$acteur['prenom']." ".$acteur['nom']."</option>";                    
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
                <input type="hidden" name="id_film" value=<?= $index?>>
                <input type="submit" name="submit" value="Ajouter">
            </td>
            
        </form>
    </tr>
    </tbody>
</table>
</div>

<div class = "likes">
    <p>Nombre de likes: <?= $film["likes"]?> </p>
    <button type="button"><a class="fa fa-thumbs-up" href="index.php?action=like&id=<?= $index?>"></a></button>
</div>
<?php

$titre = "Détail du film ".$film['titre_film'];
$titre_secondaire ="Détail du film ".$film['titre_film'];
$contenu = ob_get_clean();
require "view/template.php";