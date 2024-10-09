<?php
function renderMenuToHTML($currentPageId) {
    $mymenu = array(
        'index' => 'Accueil',
        'cv' => 'CV',
        'projets' => 'Projets',
        'infos-technique' => 'Infos Technique' 
    );
    echo '<nav class="nav flex-column bg-light p-3 border-end">';
    foreach($mymenu as $pageId => $label) {
        $active = ($currentPageId == $pageId) ? 'active' : '';
        echo '<a href="' . $pageId . '.php" class="nav-link ' . $active . '">' . $label . '</a>';
    }
    echo '</nav>';
}
?>
