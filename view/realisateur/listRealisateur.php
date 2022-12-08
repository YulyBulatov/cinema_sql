<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> realisateurs</p>

<table>
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Filmographie</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $realisateur){

        $index = $realisateur['id_realisateur'];

            echo    "<tr>",
                        "<td>".$realisateur['prenom']."</a></td>",
                        "<td>".$realisateur['nom']."</td>",
                        "<td>".$realisateur['age']."</td>",
                        "<td><a href=index.php?action=filmographieRealisateur&id=$index>Filmographie</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";