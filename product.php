<?php
require_once 'config/connexion.php';
include 'partials/nav.php';

$reqProjects = $bdd->query("
    SELECT products.*, categories.name AS category_name
    FROM products
    LEFT JOIN categories ON products.category = categories.id
    ORDER BY products.date DESC
");

$projects = $reqProjects->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="projects" id="projects">
    <h2>TOUS LES PROJETS</h2>

    <div class="project-grid">
        <?php foreach ($projects as $project): ?>
            <article class="project-card">
                <img src="images/<?= htmlspecialchars($project['cover']) ?>"
                     alt="<?= htmlspecialchars($project['name']) ?>">

                <div class="project-info">
                    <span class="project-category">
                        <?= htmlspecialchars($project['category_name']) ?>
                    </span>

                    <h3><?= htmlspecialchars($project['name']) ?></h3>

                    <p><?= htmlspecialchars($project['description']) ?></p>

                    <div class="project-date">
                        <?= date('F Y', strtotime($project['date'])) ?>
                    </div>

                    <a href="product.php?id=<?= $project['id'] ?>" class="see-more">
                        Voir le projet
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'partials/footer.php'; ?>