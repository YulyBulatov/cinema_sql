<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Sexe</th>
            <th>Filmographie</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($requete->fetchAll() as $acteur){

        $index = $acteur['id_acteur'];

            echo    "<tr>",
                        "<td>".$acteur['prenom']."</a></td>",
                        "<td>".$acteur['nom']."</td>",
                        "<td>".$acteur['age']."</td>",
                        "<td>".$acteur['sexe']."</td>",
                        "<td><a href=index.php?action=filmographieActeur&id=$index>Filmographie</a></td>",
                    "</tr>";
}
?>
    </tbody>
</table>

<?php


$titre = "Détail d'acteur";
$titre_secondaire = "Détail d'acteurs";
$contenu = ob_get_clean();
require "view/template.php";