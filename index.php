    <?php include 'partials/nav.php'; ?>

    <main class="home">
        <section class="hero" id="home">

            <div class="hero-content">
                <h1>FRANSMAN<br>AMBRE</h1>

                <h2>INFOGRAPHISTE</h2>

                <p>
                    Je transforme vos idées en créations visuelles percutantes.
                    Spécialisé en PAO, design web et compositions graphiques.
                </p>

                <div class="buttons">
                    <a href="projects.php" class="btn black">
                        DÉCOUVRIR MES PROJETS <span>→</span>
                    </a>

                    <a href="cv.pdf" class="btn pink" target="_blank">
                        MON CV
                    </a>
                </div>
            </div>

            <img src="images/design-vague.png" alt="" class="pink-shape">

        </section>
    </main>

    <section class="about" id="about">

        <h2 class="about-title">À PROPOS</h2>

        <div class="about-content">

            <div class="about-image">
                <img src="images/.png" alt="Photo Ambre">
            </div>

            <div class="about-text">

                <div class="bloc">
                    <h3>MON PARCOURS</h3>
                    <p>
                        Passionnée par le design graphique, je développe mon univers visuel à travers des projets mêlant
                        <span>créativité</span>, précision et sens du détail.
                        Mes études me permettent d’explorer différents outils et techniques afin de concevoir des visuels à la fois
                        <span>esthétiques</span> et <span>efficaces</span>.
                    </p>
                </div>

                <div class="bloc">
                    <h3>MA PHILOSOPHIE</h3>
                    <p>
                        Chaque projet est unique. Mon objectif est de comprendre une idée et de la traduire en une création visuelle
                        claire, cohérente et <span>impactante</span>.
                        Toujours en quête d’évolution, j’affine mon regard et développe continuellement mon approche du design.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="skills" id="skills">
        <h2>Compétences</h2>
         <div class="skills-list">
             <div id="tooltip" role="tooltip"></div>
                <span data-tooltip="Retouche photo et création visuelle">Photoshop</span>

                <span class="skill" data-tooltip="Création vectorielle et logos">
                    Illustrator
                </span>

                <span class="skill" data-tooltip="UI/UX et prototypage">
                    Figma
                </span>
                <span>Indesign</span>
                <span>After Effect</span>
                <span>Adobe Audition</span>
                <span>HTML/CSS</span>
                <span>CMS</span>
                <span>Procreate</span>
            </div>
    </section>

   <?php
   require_once 'config/connexion.php';

   $selectedCategory = $_GET['category'] ?? 'all';

   $reqCategories = $bdd->query("SELECT * FROM categories ORDER BY name ASC");
   $categories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

   if ($selectedCategory === 'all') {
       $reqProjects = $bdd->query("
           SELECT products.*, categories.name AS category_name
           FROM products
           LEFT JOIN categories ON products.category = categories.id
           ORDER BY products.date DESC
           LIMIT 3
       ");
   } else {
       $reqProjects = $bdd->prepare("
           SELECT products.*, categories.name AS category_name
           FROM products
           LEFT JOIN categories ON products.category = categories.id
           WHERE products.category = ?
           ORDER BY products.date DESC
           LIMIT 3
       ");
       $reqProjects->execute([$selectedCategory]);
   }

   $projects = $reqProjects->fetchAll(PDO::FETCH_ASSOC);
   ?>
   <section class="projects" id="projects">
       <h2>PROJETS</h2>

       <div class="project-filters">
           <a href="index.php#projects" class="<?= $selectedCategory === 'all' ? 'active' : '' ?>">
               Tous
           </a>

           <?php foreach ($categories as $category): ?>
               <a href="index.php?category=<?= $category['id'] ?>#projects"
                  class="<?= $selectedCategory == $category['id'] ? 'active' : '' ?>">
                   <?= htmlspecialchars($category['name']) ?>
               </a>
           <?php endforeach; ?>
       </div>

       <div class="project-grid">
           <?php foreach ($projects as $project): ?>
               <article class="project-card">
                   <img src="images/<?= htmlspecialchars($project['cover']) ?>" alt="<?= htmlspecialchars($project['name']) ?>">

                   <div class="project-info">
                       <span class="project-category">
                           <?= htmlspecialchars($project['category_name']) ?>
                       </span>

                       <h3><?= htmlspecialchars($project['name']) ?></h3>

                       <p><?= htmlspecialchars($project['description']) ?></p>

                       <div class="project-date">
                           <?= date('F Y', strtotime($project['date'])) ?>
                       </div>
                   </div>
               </article>
           <?php endforeach; ?>
       </div>

       <a href="projects.php" class="see-more">VOIR PLUS</a>
   </section>

   <section class="contact" id="contact">
       <h2>CONTACT</h2>

       <div class="contact-content">
           <div class="contact-info">
               <h3>INFORMATIONS</h3>

               <div class="info-box">
                   <div>
                       <span>EMAIL</span>
                       <p>fransmanambre2006@gmail.com</p>
                   </div>

                   <div>
                       <span>DISPONIBILITÉ</span>
                       <p>Réponse sous 24h</p>
                   </div>

                   <div>
                       <span>COLLABORATION</span>
                       <p>Ouvert aux projets freelance</p>
                   </div>
               </div>
           </div>

           <form class="contact-form" method="POST" action="treatmentContact.php">

               <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                   <p class="success-message">Votre message a bien été envoyé.</p>
               <?php endif; ?>

               <?php if (isset($_GET['error'])): ?>
                   <p class="error-message">Merci de remplir tous les champs.</p>
               <?php endif; ?>

               <label for="nom">NOM</label>
               <input type="text" id="nom" name="nom">

               <label for="email">EMAIL</label>
               <input type="email" id="email" name="email">

               <label for="message">MESSAGE</label>
               <textarea id="message" name="message"></textarea>

               <button type="submit">ENVOYER</button>
           </form>
       </div>
   </section>




    <?php include 'partials/footer.php'; ?>