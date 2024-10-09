<?php
require_once('template_header.php');
?>
<header class="bg-info text-white text-center py-4 position-relative">
    <h1>Mes Projets</h1>
</header>

<div class="container-fluid d-flex flex-grow-1">
    <?php
    require_once('template_menu.php');
    renderMenuToHTML('projets');
    ?>

    <div class="content p-4 bg-white shadow-sm rounded flex-grow-1">
        <h2 class="mb-4">Projets Académiques</h2>
        <ul>
            <li><strong>Automatisation des feux de circulation</strong> - Utilisation de capteurs LIDAR et de la
                modélisation YOLOv7.</li>
            <li><strong>CHICKEN HOME</strong> - Automatisation des fermes avec Raspberry Pi et Node.js.</li>
        </ul>

        <h2 class="mt-4 mb-3">Projets Personnels</h2>
        <ul>
            <li><strong>Application Web Décentralisée</strong> - Développement d’une application sécurisée avec API.
            </li>
            <li><strong>Projet Ansible</strong> - Automatisation des logs réseau avec Ansible.</li>
        </ul>
    </div>
</div>

<?php
require_once('template_footer.php');
?>