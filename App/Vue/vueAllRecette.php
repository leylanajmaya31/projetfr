<?php ob_start() ?>
<h1 id="titreh1">TOUTES LES RECETTES</h1>
<hr>
<main class="mainContent">
    <?php foreach ($tab as $recette) : ?>
        <section class="card">
            <!-- ********************** Card 1 **********************  -->
            <div class="card1">
                <img src="./Public/asset/images/<?= $recette->getImage()?>" alt="...">
                <h4><strong>Titre: <?= $recette->getNom() ?></strong></h4> <br>
                <p>Publiée par: <?= $recette->nom_utilisateur ?></p> <br>
                <button type="submit" id="cardButton">Lire la recette</button>
            </div>
        </section>
    <?php endforeach ?>
    <p><?= $error ?></p>
</main>
<?php $content = ob_get_clean() ?>


