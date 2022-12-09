<?php ob_start();
foreach($requete->fetchAll() as $film){
    $titreF = $film['titre_film'];
    $index = $film['id_film'];
    $synopsis = $film['synopsis'];

    echo "<form action='index.php?action=addSynopsis' method='post'>
    <p>
        <label>Synopsis :
            <textarea name='synopsis'>$synopsis</textarea>
        </label>
    </p>
    <input type='hidden' name='id_film' value=$index>
    <p>
        <input type='submit' name='submit' value='Ajouter un synopsis'>
    </p>
</form>";
} 

$titre = "Ajoutez un synopsis au film $titreF";
$titre_secondaire = "Ajoutez un synopsis au film $titreF";
$contenu = ob_get_clean();
require "view/template.php";