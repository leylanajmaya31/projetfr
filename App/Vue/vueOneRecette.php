<?php ob_start()?>

<?php if (!empty($recette)): ?>
    <!-- Afficher une seule recette -->
    <h1 id="titreh1"><?= $recette->getNom() ?></h1>
    <hr>
    <main class="mainContent">
        <section class="card">
            <div class="card">
                <p>Titre: <?= $recette->getNom() ?></p>
                <p>Niveau: <?= $recette->getNiveau() ?></p>
                <p>Niveau: <?= $recette->getDate() ?></p>
                <p>Portion pour <?= $recette->getPortion() ?> personnes</p>
                <p>Description: <?= $recette->getDescription() ?></p>
                <p>Durée: <?= $recette->getTemps() ?> min</p>
            </div>
            <br>
        </section>
    </main>
<?php else: ?>
    <!-- Aucune recette trouvée -->
    <p>Aucune recette trouvée.</p>
<?php endif; ?>

<p><?= $error ?></p>
<?php $content = ob_get_clean()?>






