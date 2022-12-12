<?php
require 'data/bootstrap.php';
require 'data/routes.php';

$section = $_GET['s'] ?? "home";

$title = $sections[$section]['title'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title; ?></title>

    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/9939576bbf.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar">
        <ul class="navbar__ul">
            <li class="navbar__li"><a href="index.php?s=home"><i class="fa-solid fa-house fa-xl navbar__icon"></i></a></li>
            <li class="navbar__li"><a href="index.php?s=profile"><i class="fa-solid fa-user fa-xl navbar__icon"></i></a></li>
            <li class="navbar__li"><a href="#"><i class="fa-solid fa-gear fa-xl navbar__icon"></i></a></li>
        </ul>

        <div class="navbar__profile-picture">
            <img src="http://localhost/www/aboutdotme/img/profile.jpg" alt="profile_picture" />
        </div>
    </nav>

    <main class="main">
        <?php
        require 'sections/' .  $section . '.php';
        ?>
    </main>

    <script src="./js/script.js"></script>
</body>

</html>