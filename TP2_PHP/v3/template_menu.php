<?php
function renderMenuToHTML($currentPageId, $currentLang) {
    $mymenu = array(
        'accueil' => 'Accueil',
        'cv' => 'CV',
        'projets' => 'Projets',
        'infos-technique' => 'Infos Technique',
        'contact' => 'Contact'
    );
    echo '<nav class="nav flex-column bg-light p-3 border-end">';
    foreach ($mymenu as $pageId => $label) {
        $active = ($currentPageId == $pageId) ? 'active' : '';
        echo '<a href="index.php?page=' . $pageId . '&lang=' . $currentLang . '" class="nav-link ' . $active . '">' . $label . '</a>';
    }
    echo '</nav>';
}
?>

