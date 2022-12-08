<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>
<body>
    <nav>
        <li><a href="index.php?action=home">Page d'accueil</a></li>
        <li><a href="index.php?action=listFilms">Liste de films</a></li>
        <li><a href="index.php?action=listRealisateurs">Réalisateurs</a></li>
        <li><a href="index.php?action=listActeurs">Acteurs</a></li>
        <li><a href="index.php?action=listGenres">Genres</a></li>
        <li><a href="index.php?action=listPersonnages">Personnages</a></li>
    </nav>
    <main>
        <div id="contenu">
            <h1>PDO Cinema</h1>
            <h2><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
        </div>
    </main>
    
</body>
</html>