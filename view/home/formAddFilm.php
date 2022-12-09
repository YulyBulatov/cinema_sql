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
                    Prix de produit :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Description :
                    <textarea name="desc"></textarea>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>