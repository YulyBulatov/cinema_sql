<?php ob_start()?>

<p><strong>Bienvenue au Cinema!</strong></p>

<?php
$titre = "Page d'accueil";
$titre_secondaire = "Page d'accueil";  
$contenu = ob_get_clean();
require "view/template.php";