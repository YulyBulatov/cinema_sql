<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> film(s)</p>

<table>
    <thead>
        <tr>
            <th>Titre Film</th>
            <th>Duree</th>
            <th>Année de sortie</th>
            <th>Réalisateur</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $film){

        $indexF = $film['id_film'];
        $indexR = $film['id_realisateur'];

            echo    "<tr>",
                        "<td><a href = index.php?action=detailFilm&id=$indexF>".$film['titre_film']."</a></td>",
                        "<td>".$film['duree']."</td>",
                        "<td>".$film['anne_sortie']."</td>",
                        "<td><a href = index.php?action=detailRealisateur&id=$indexR>".$film['prenom']." ".$film['nom']."</td>",
                        "<td><a href=index.php?action=deleteFilm&id=$indexF>Supprimer</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<br>

<a href=index.php?action=formAddFilm>Ajouter un nouveau film</a>

<br>

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


$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";