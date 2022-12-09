<?php ob_start(); 

 foreach($requete->fetchAll() as $film){

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
          "<a href = index.php?action=castingFilm&id=$index>Casting du film</a>";
                   
}





$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";