<?php ob_start(); 

 foreach($requete->fetchAll() as $film){

    echo    "<p>Année de sortie: ".$film['annee_sortie']."</p><br>",
            "<label class='rating-label'><strong>La note de  film:</strong>
            <input
              class='rating'
              max='5'
              readonly
              step='1'
              style='--fill:#777'
              type='range'
              value=".$film['note_film'].">
          </label><br>",                            //Le code pour rating pris ici :https://dev.to/madsstoumann/star-rating-using-a-single-input-i0l//
          "<p>Réalisateur : ".$film['prenom']." ".$film['nom']."</p><br>",
          "<p>Synopsis : <br>".$film['synopsis']."</p><br>";
                   
}





$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";