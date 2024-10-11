<form id="style_form" action="index.php" method="GET">
   <select name="css">
      <option value="style1">Style 1</option>
      <option value="style2">Style 2</option>
   </select>
   <input type="submit" value="Appliquer" />
</form>
<?php
if (isset($_GET['css'])) {
    $selectedStyle = $_GET['css'];
    setcookie('style', $selectedStyle, time() + (86400 * 30), "/"); // 30 days
}
$style = isset($_COOKIE['style']) ? $_COOKIE['style'] : 'style1';

echo '<link rel="stylesheet" type="text/css" href="' . $style . '.css">';
?>
