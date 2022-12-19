<?php
require '../data/bootstrap.php';
require '../libraries/posts.php';

$id = $_GET['id'];

$success = postDelete($db, $id);

if ($success) {
    $_SESSION['status_success'] = "El post fue eliminado exitosamente!";
    header("Location: ../index.php?s=profile");
} else {
    $_SESSION['status_error'] = "Oops! Algo salió mal al tratar de eliminar el post. Probá de nuevo más tarde, o si el problema persiste, comunicate con el soporte.";
    header("Location: ../index.php?s=profile");
}
