<?php
require_once 'config/connexion.php';
include 'partials/nav.php';

$selectedCategory = $_GET['category'] ?? 'all';

$reqCategories = $bdd->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

if ($selectedCategory === 'all') {
    $reqProjects = $bdd->query("
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category = categories.id
        ORDER BY products.date DESC
    ");
} else {
    $reqProjects = $bdd->prepare("
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category = categories.id
        WHERE products.category = ?
        ORDER BY products.date DESC
    ");
    $reqProjects->execute([$selectedCategory]);
}

$projects = $reqProjects->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="projects all-projects" id="projects">

    <h2>PROJETS</h2>

    <div class="project-filters">
        <a href="projects.php" class="<?= $selectedCategory === 'all' ? 'active' : '' ?>">
            Tous
        </a>

        <?php foreach ($categories as $category): ?>
            <a href="projects.php?category=<?= $category['id'] ?>"
               class="<?= $selectedCategory == $category['id'] ? 'active' : '' ?>">
                <?= htmlspecialchars($category['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="project-grid">
        <?php foreach ($projects as $project): ?>

            <a href="product.php?id=<?= $project['id'] ?>" class="project-card-link">

                <article class="project-card">

                    <img
                        src="images/<?= htmlspecialchars($project['cover']) ?>"
                        alt="<?= htmlspecialchars($project['name']) ?>"
                    >

                    <div class="project-info">

                        <span class="project-category">
                            <?= htmlspecialchars($project['category_name']) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($project['name']) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($project['description']) ?>
                        </p>

                        <div class="project-date">
                            <?= date('F Y', strtotime($project['date'])) ?>
                        </div>

                    </div>

                </article>

            </a>

        <?php endforeach; ?>
    </div>
</section>

<?php include 'partials/footer.php'; ?>