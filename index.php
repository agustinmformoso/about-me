<?php
require 'data/bootstrap.php';
require 'data/routes.php';

$section = $_GET['s'] ?? "home";

if (!isset($sections[$section])) {
    $section = 404;
}

if ($environmentState === ENVIRONMENT_MAINTENANCE) {
    $section = "maintenance";
}

$title = $sections[$section]['title'];

$statusSuccess  = sessionGetFlashValue('status_success');
$statusError    = sessionGetFlashValue('status_error');
$statusInfo     = sessionGetFlashValue('status_info');


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

            <?php
            if (authIsAutenticated()) : ?>
                <li class="navbar__li"><a href="index.php?s=profile"><i class="fa-solid fa-user fa-xl navbar__icon"></i></a></li>
                <li class="navbar__li"><a href="actions/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl navbar__icon"></i></a></li>
            <?php endif; ?>
        </ul>

        <?php
        if (!authIsAutenticated()) : ?>
            <div class="navbar__unauthorized">
                <a class="button navbar__button navbar__button--login" href="index.php?s=login">Login</a>
                <a class="button navbar__button navbar__button--sign-up" href="index.php?s=sign-up">Sign Up</a>
            </div>
        <?php
        else : ?>
            <div class="navbar__profile-picture">
                <img src="http://localhost/www/aboutdotme/img/profile.jpg" alt="profile_picture" />
            </div>
        <?php
        endif; ?>
    </nav>

    <main class="main">
        <?php
        require 'sections/' .  $section . '.php';
        ?>

        <?php
        if ($statusSuccess !== null) : ?>
            <div class="card status-message" role="alert"><?= $statusSuccess; ?></div>
        <?php
        endif; ?>
        <?php
        if ($statusError !== null) : ?>
            <div class="card status-message" role="alert"><?= $statusError; ?></div>
        <?php
        endif; ?>
        <?php
        if ($statusInfo !== null) : ?>
            <div class="card status-message" role="alert"><?= $statusInfo; ?></div>
        <?php
        endif; ?>

    </main>

    <?php
    if (isset($sections[$section]['js'])) :
        foreach ($sections[$section]['js'] as $script) :
    ?>
            <script src="<?= $script; ?>"></script>
    <?php
        endforeach;
    endif; ?>

    <script src="./js/script.js"></script>
</body>

</html>