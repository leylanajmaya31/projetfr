<?php ob_start()?>
    <form action="" method="post">
        <label for="nom_ingredient">Saisir le nom de l'ingredient</label>
        <input type="text" name="nom_ingredient">
        <label for="quantite_ingredient">Saisir la quantite</label>
        <input type="text" name="quantite_ingredient">
        <input type="submit" value="Ajouter" name="submit">
    </form>
    <p><?=$error?></p>
<?php $content = ob_get_clean()?>

