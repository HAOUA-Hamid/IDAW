<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="d-flex flex-column min-vh-100">
<header class="bg-info text-white text-center py-4 position-relative">
    <?php
    $image = '';
    $h1 = array('cv' => 'Mon CV', 'accueil' => 'Bienvenue sur mon site personnel', 'projets' => 'Mes projets', 'infos-technique' => 'Informations techniques', 'contact' => 'Contact');
    if (isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
        if ($currentPageId == 'cv') {
            $image = '<img src="image.png" alt="Hamid Haoua" class="position-absolute end-0 top-50 translate-middle-y" width="100"/>';
        }
    } else {
        $currentPageId = 'accueil';
    }
    echo '<h1>' . $h1[$currentPageId] . '</h1>';
    echo $image;
    ?>
</header>