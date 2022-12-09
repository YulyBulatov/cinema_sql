<?php ob_start(); ?>

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


$titre = "Détail de réalisateur";
$titre_secondaire = "Détail de réalisateur";
$contenu = ob_get_clean();
require "view/template.php";