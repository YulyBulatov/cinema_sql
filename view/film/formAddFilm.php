<?php ob_start(); ?>

<form action="index.php?action=addFilm" method="post">
    <p>
        <label>
            Titre du film :
            <input type="text" name="titre_film" maxlength="255" required>
        </label>
    </p>
    <p>
        <label>
            Date de sortie :
            <input type="date" name="annee_sortie" required>
        </label>
    </p>
    <p>
        <label>
            Duree en minutes :
            <input type="number" name="duree_minutes" required></input>
        </label>
    </p>
    <p>
        <label>
            Synopsis :
            <textarea name="synopsis"></textarea>
        </label>
    </p>
    <p>
        <label>
            Note de film (sur 5) :
            <fieldset>
                <input type="radio" name="note_film" value =1 checked>1<br>
                <input type="radio" name="note_film" value =2>2<br>
                <input type="radio" name="note_film" value =3>3<br>
                <input type="radio" name="note_film" value =4>4<br>
                <input type="radio" name="note_film" value =5>5<br>
            </fieldset>
        </label>
     </p>
    <p>
        <label>
            Affiche du film :
            <input type="text" name="affiche_film" maxlength="50" placeholder="affichefilm.jpg" required></input>
        </label>
    </p>
    <p>
        <label>
            Réalisateur du film :
            <select name="realisateur">
                <?php foreach($requete->fetchAll() as $realisateur){
                    echo "<option value = '".$realisateur['id_realisateur']."'>".$realisateur['prenom']." ".$realisateur['nom']."</option>";
                }?>
            </select>
        </label>
    </p>
    <p>
        <input type="submit" name="submit" value="Ajouter un film">
    </p>
</form>

<?php


$titre = "Ajoutez un nouveau film";
$titre_secondaire = "Ajoutez un nouveau film";
$contenu = ob_get_clean();
require "view/template.php";