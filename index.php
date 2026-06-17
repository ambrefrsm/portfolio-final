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

                    <a href="images/cv-ambre.pdf"
                       download
                       class="btn pink">
                        MON CV
                    </a>
                </div>
            </div>

         <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2227.74 1905.32" class="pink-shape">
           <path class="cls-1" d="M2147.6,2.8s10.09,288.42-141.2,338.85c0,0-141.2,36.98-235.33-33.62s-208.44,20.17-201.71,94.13,40.34,114.3,84.05,151.28,248.78-13.45,309.29,60.51,60.51,151.28,10.09,218.52c0,0-60.51,52.3-147.92,46.32s-191.63-5.98-228.61,37.73-74.53,107.58-27.18,248.78-22.22,211.8-22.22,211.8c0,0-68.27,104.22-178.96,49.8-33.06-13.83-57.41-51.85-57.41-133.85,0,0,35.95-229.12-33.62-336.19s-203.07-78.07-218.52,30.26c0,0,15.45,198.35-174.82,154.65-134.47-70.6-121.03-225.24-121.03-225.24,0,0,50.43-262.23-147.92-282.4,0,0-184.33,11.12-114.3,282.4s-114.3,309.29-114.3,309.29c0,0-267.46-40.1-302.57,110.94s211.8,174.82,211.8,174.82c0,0,144.56-53.79,211.8,73.96,0,0,73.96,137.84-43.7,265.59"/>
         </svg>

        </section>
    </main>

    <section class="about" id="about">

        <h2 class="about-title">À PROPOS</h2>

        <div class="about-content">

            <div class="photo-wrapper">
                <div class="about-image">
                    <img src="images/moi.png" alt="Photo Ambre">
                </div>
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
                <span class="skill" data-tooltip="Retouche photo et création visuelle">
                    Photoshop
                </span>

                <span class="skill" data-tooltip="Création vectorielle, logos et illustrations">
                    Illustrator
                </span>

                <span class="skill" data-tooltip="UI/UX design, maquettes et prototypage">
                    Figma
                </span>

                <span class="skill" data-tooltip="Mise en page éditoriale et supports imprimés">
                    Indesign
                </span>

                <span class="skill" data-tooltip="Animation, motion design et effets visuels">
                    After Effect
                </span>

                <span class="skill" data-tooltip="Montage et traitement audio professionnel">
                    Adobe Audition
                </span>

                <span class="skill" data-tooltip="Création et intégration de sites web">
                    HTML/CSS
                </span>

                <span class="skill" data-tooltip="Gestion et administration de contenu web">
                    CMS
                </span>

                <span class="skill" data-tooltip="Illustration digitale et dessin sur tablette">
                    Procreate
                </span>
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
   <section class="projects home-projects" id="projects">
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
                   <img
                       src="images/<?= htmlspecialchars($project['cover']) ?>"
                       alt="<?= htmlspecialchars($project['name']) ?>"
                       class="project-image"
                       onclick="openModal(this.src)"
                   >
                   <div class="project-info">
                       <span class="project-category">
                           <?= htmlspecialchars($project['category_name']) ?>
                       </span>

                       <h3><?= htmlspecialchars($project['name']) ?></h3>

                       <p><?= htmlspecialchars($project['description']) ?></p>
                       <?php if (!empty($project['figma_link'])): ?>
                           <a
                               href="<?= htmlspecialchars($project['figma_link']) ?>"
                               target="_blank"
                               class="project-link"
                           >
                               Voir le prototype
                           </a>
                       <?php endif; ?>

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
                       <p>Disponible pour un poste en design</p>
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

   <div id="imageModal" class="image-modal">

       <span class="close-modal" onclick="closeModal()">
           ×
       </span>

       <img id="modalImage">

   </div>

   <script>

   function openModal(src) {

       document.getElementById("imageModal").style.display = "flex";

       document.getElementById("modalImage").src = src;
   }

   function closeModal() {

       document.getElementById("imageModal").style.display = "none";
   }

   </script>


<?php include 'partials/footer.php'; ?>

<script>
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-link");

window.addEventListener("scroll", () => {

    let current = "";

    sections.forEach(section => {
        const sectionTop = section.offsetTop - 120;

        if (scrollY >= sectionTop) {
            current = section.getAttribute("id");
        }
    });

    navLinks.forEach(link => {
        link.classList.remove("active");

        if (link.getAttribute("href").includes(current)) {
            link.classList.add("active");
        }
    });
});

const wrapper = document.querySelector('.photo-wrapper');

wrapper.addEventListener('mousemove', (e) => {

    const rect = wrapper.getBoundingClientRect();

    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    const rotateX = ((x - centerX) / centerX) * 15;
    const rotateY = ((y - centerY) / centerY) * -15;

    wrapper.style.setProperty('--rotateX', `${rotateX}deg`);
    wrapper.style.setProperty('--rotateY', `${rotateY}deg`);
});

wrapper.addEventListener('mouseleave', () => {
    wrapper.style.setProperty('--rotateX', '0deg');
    wrapper.style.setProperty('--rotateY', '0deg');
});
</script>
</body>
</html>
