<?php ob_start()?>

<?php foreach ($recettes as $recette) : ?>
    <div class="card">
        <img src="<?= $recette->getImage(); ?>" alt="<?= $recette->getNom(); ?>">
        <h2><?= $recette->getNom(); ?></h2>
        <p>Niveau : <?= $recette->getNiveau(); ?></p>
        <p>Date : <?= $recette->getDate(); ?></p>
        <p>Description : <?= $recette->getDescription(); ?></p>
        <p>Portions : <?= $recette->getPortion(); ?></p>
        <p>Temps de cuisson : <?= $recette->getTemps(); ?></p>
        <p>Auteur : <?= $recette->getNomUtilisateur(); ?></p>
    </div>
<?php endforeach; ?>
<p><?=$error?></p>
<?php $content = ob_get_clean()?>

