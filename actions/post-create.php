<?php
require_once '../data/bootstrap.php';
require_once '../libraries/posts.php';
require_once '../libraries/auth.php';

$id_user            = trim($_POST['id_user']);
$type            = trim($_POST['type']);
$title            = trim($_POST['title']);
$content            = trim($_POST['content']);
$rating            = trim($_POST['rating']);

$errors = [];

if (empty($title)) {
    $errors['title'] = "El titulo no puede estar vacío.";
}

if (empty($type)) {
    $errors['type'] = "El tipo no puede estar vacío.";
}

if (empty($content)) {
    $errors['content'] = "El contenido no puede estar vacío.";
}

if (empty($rating)) {
    $errors['rating'] = "El rating no puede estar vacío.";
}

if (!empty($errors)) {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ../index.php?s=profile");
    exit;
}

$idUser = createPost($db, [
    'id_user'     => $id_user,
    'title'  => $title,
    'type'  => $type,
    'content'      => $content,
    'rating'      => $content,
]);

if ($idUser !== false) {
    authSetLogin([
        'id_user'     => $id_user,
        'title'  => $title,
        'type'  => $type,
        'content'      => $content,
        'rating'      => $content,
    ]);

    $_SESSION['status_success'] = "Post enviado con éxito!";
    header('Location: ../index.php?s=profile');
    exit;
} else {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['status_error'] = "Hubo un error al enviar el post. Por favor, intentá de nuevo más tarde. Si el problema continúa comunicate con el soporte.";
    header("Location: ../index.php?s=profile");
    exit;
}
