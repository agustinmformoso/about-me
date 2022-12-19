<?php
require_once '../data/bootstrap.php';
require_once '../libraries/comments.php';
require_once '../libraries/auth.php';

$id_user            = trim($_POST['id_user']);
$id_post            = trim($_POST['id_post']);
$comment_content    = trim($_POST['comment_content']);

$errors = [];

if (empty($comment_content)) {
    $errors['comment_content'] = "El contenido no puede estar vacío.";
}

if (!empty($errors)) {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ../index.php?s=profile");
    exit;
}

$idUser = postComment($db, [
    'id_user'     => $id_user,
    'id_post'  => $id_post,
    'comment_content'      => $comment_content,
]);

if ($idUser !== false) {
    authSetLogin([
        'id_user'     => $id_user,
        'id_post'  => $id_post,
        'comment_content'      => $comment_content,
    ]);

    $_SESSION['status_success'] = "Comentario enviado con éxito!";
    header('Location: ../index.php?s=profile');
    exit;
} else {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['status_error'] = "Hubo un error al enviar el comentario. Por favor, intentá de nuevo más tarde. Si el problema continúa comunicate con el soporte.";
    header("Location: ../index.php?s=profile");
    exit;
}
