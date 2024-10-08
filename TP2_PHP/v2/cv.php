<?php
require_once('template_header.php');
?>
    <header class="bg-info text-white text-center py-4 position-relative">
        <h1>Mon CV</h1>
        <img src="image.png" alt="Hamid Haoua" class="position-absolute end-0 top-50 translate-middle-y" width="100" height="150">
    </header>

    <div class="container-fluid d-flex flex-grow-1">
    <?php
require_once('template_menu.php');
?>

        <div class="content p-4 bg-white shadow-sm rounded flex-grow-1">
            <h2 class="mb-4">Informations Personnelles</h2>
            <ul class="list-unstyled">
                <li><strong>Nom:</strong> HAOUA Hamid</li>
                <li><strong>Email:</strong> hamid.haoua@etu.imt-nord-europe.fr</li>
                <li><strong>GitHub:</strong> <a href="http://github.com/HAOUA-Hamid">github.com/HAOUA-Hamid</a></li>
            </ul>

            <h2 class="mt-4 mb-3">Expérience Professionnelle</h2>
            <ul>
                <li><strong>Stage Technique</strong> - Observatoire National de la Recherche Scientifique et Technologique (Mai - Septembre 2024)</li>
                <li><strong>Projet Ansible Playbook</strong> - Automatisation des logs réseau (Août 2022)</li>
            </ul>

            <h2 class="mt-4 mb-3">Formation</h2>
            <ul>
                <li><strong>Double Diplôme Ingénieur</strong> (2021-2025) - IMT Nord Europe et Académie Internationale Mohammed VI</li>
                <li><strong>CPGE</strong> - Lycée d'Excellence (2019-2021)</li>
                <li><strong>Baccalauréat</strong> - Mention Très Bien (2019)</li>
            </ul>

            <h2 class="mt-4 mb-3">Compétences Techniques</h2>
            <ul>
                <li>Langages: Java, Python, C/C++, PHP, JavaScript, HTML & CSS</li>
                <li>Frameworks: React, Angular, Springboot, Django</li>
                <li>Bases de Données: MySQL, PostgreSQL, MongoDB</li>
                <li>OS: Linux, Windows</li>
            </ul>

            <h2 class="mt-4 mb-3">Langues</h2>
            <ul class="list-unstyled">
                <li>Arabe: Natif</li>
                <li>Français: Courant</li>
                <li>Anglais: B2+</li>
                <li>Japonais: Débutant</li>
            </ul>

            <h2 class="mt-4 mb-3">Centres d'Intérêt</h2>
            <p>E-sport, Football, Basketball, Montage vidéo, Lecture de romans et bandes dessinées.</p>
        </div>
    </div>

<?php
require_once('template_footer.php');
?>
