<?php
require_once '../data/bootstrap.php';
require_once '../data/conection.php';
require_once '../libraries/users.php';

$idUser = $_GET['id'];
$password   = trim($_POST['password']);
$name       = trim($_POST['name']);
$username   = trim($_POST['username']);
$location    = trim($_POST['location']);
$biography    = trim($_POST['biography']);
$birthdate    = trim($_POST['birthdate']);

$errors = [];

if (empty($email)) {
    $errors['email'] = "El email esta vacío.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "El formato del email es inválido, revisá que sea: 'nombre@dominio.extension'.";
}

if (empty($name)) {
    $errors['name'] = "El nombre es obligatorio.";
}

if (empty($lastname)) {
    $errors['lastname'] = "El apellido es obligatorio.";
}

if (empty($address)) {
    $errors['address'] = "La dirección es obligatoria.";
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old_data'] = $_POST;

    header('Location: ../index.php?s=profile-edit&id=' . $idUser);
    exit;
}

$success = userEdit($db, $idUser, $name, $lastname, $email, $address);

if ($success) {
    $_SESSION['status_success'] = "El perfil <b>" . $title . "</b> fue actualizado con éxito!";
    header('Location: ../index.php?s=profile');
} else {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['status_error'] = "Oops! Algo salió mal al tratar de editar el perfil. Probá de nuevo más tarde, o si el problema persiste, comunicate con el soporte.";
    header('Location: ../index.php?s=profile-edit&id=' . $idUser);
}
