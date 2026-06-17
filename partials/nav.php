<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portfolio - Ambre Fransman</title>

    <meta name="description" content="Découvrez le portfolio d'Ambre Fransman, étudiante en design graphique et communication visuelle. Projets créatifs, identité visuelle, web design et réalisations graphiques.">
    <meta name="application-name" content="Portfolio - Ambre Fransman">

    <meta property="og:title" content="Portfolio - Ambre Fransman">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/preview-portfolio.jpg">
    <meta property="og:image:width" content="1800">
    <meta property="og:image:height" content="945">
    <meta property="og:url" content="https://www.ambrefransman.be/">
    <meta property="og:description" content="Découvrez le portfolio d'Ambre Fransman, étudiante en design graphique et communication visuelle.">

    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/svg+xml" href="images/favicon/favicon.svg">
    <link rel="shortcut icon" href="images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/web-app-manifest-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="images/favicon/web-app-manifest-512x512.png">

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="build/style.css">
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">
        <img src="images/logo-noir.png" alt="Logo">
    </a>

    <nav class="menu" id="menu">
        <a href="index.php#home" class="nav-link">Accueil</a>
        <a href="index.php#about" class="nav-link">Présentation</a>
        <a href="index.php#skills" class="nav-link">Compétences</a>
        <a href="index.php#projects" class="nav-link">Projets</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
    </nav>

    <button id="burger" class="burger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>
</header>

<script>
const burger = document.querySelector('.burger');
const menu = document.querySelector('.menu');

burger.addEventListener('click', () => {
    burger.classList.toggle('open');
    menu.classList.toggle('active');
});
</script>