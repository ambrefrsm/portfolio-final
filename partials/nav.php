<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Ambre</title>

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

    <div class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<script>
const burger = document.getElementById("burger");
const menu = document.getElementById("menu");

burger.addEventListener("click", function () {
    burger.classList.toggle("active");
    menu.classList.toggle("active");
});
</script>