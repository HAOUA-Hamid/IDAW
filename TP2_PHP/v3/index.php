<?php
require_once('template_header.php');
?>
<header class="bg-info text-white text-center py-4 position-relative">
    <h1>Bienvenue sur mon site personnel</h1>
</header>

<div class="container-fluid d-flex flex-grow-1">
    <?php
    require_once('template_menu.php');
    renderMenuToHTML('index');
    ?>

    <div class="content p-4 bg-white shadow-sm rounded flex-grow-1">
        <h2 class="mb-4">Présentation</h2>
        <p>Je suis <strong>Hamid Haoua</strong>, étudiant en deuxième année à <strong>IMT Nord Europe</strong> et à
            <strong>Académie Internationale Mohammed VI de l'Aviation Civile</strong>.</p>
        <p>Dans ce site, vous trouverez mon CV détaillé et mes projets académiques.</p>
    </div>
</div>


<?php
require_once('template_footer.php');
?>