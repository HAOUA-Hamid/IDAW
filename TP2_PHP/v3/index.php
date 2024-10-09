<?php
$currentLang = 'fr';
if (isset($_GET['lang'])) {
    $currentLang = $_GET['lang'];
}

require_once("template_header.php");
require_once("template_menu.php");

$currentPageId = 'accueil';
if (isset($_GET['page'])) {
    $currentPageId = $_GET['page'];
}
?>
<div class="container-fluid d-flex flex-grow-1">
<?php
    renderMenuToHTML($currentPageId, $currentLang);
    $pageToInclude = $currentLang . "/" . $currentPageId . ".php";
    if (is_readable($pageToInclude)) {
        require_once($pageToInclude);
    } else {
        require_once("error.php");
    }
?>
</div>
<?php
require_once("template_footer.php");
?>
