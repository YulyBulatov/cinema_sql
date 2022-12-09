<?php ob_start(); 

 foreach($requete1->fetchAll() as $film){

  $index = $film["id_film"];

    echo    "<p>Année de sortie: ".$film['anne_sortie']."</p><br>",
            "<label class='rating-label'><strong>La note de  film:</strong>
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
          "<p>Réalisateur : ".$film['prenom']." ".$film['nom']."</p><br>",
          "<p>Synopsis : <br>".$film['synopsis']."</p><br>",
          "<a href=index.php?action=formSynopsis&id=$index>Ajouter/Modifier le synopsis</a><br>",
          "<p> Casting : </p><br>";              
}?>

<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Sexe</th>
            <th>Nom de personnage</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete2->fetchAll() as $role){

        $indexA = $role['id_acteur'];
        $indexP = $role['id_personnage'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailActeur&id=$indexA>".$role['prenom']." ".$role['nom']."</a></td>",
                        "<td>".$role['sexe']."</td>",
                        "<td><a href = index.php?action=detailPersonnage&id=$indexP>".$role['nom_personnage']."</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>


<?php

$titre = "Détail du film ".$film['titre_film'];
$titre_secondaire ="Détail du film ".$film['titre_film'];
$contenu = ob_get_clean();
require "view/template.php";