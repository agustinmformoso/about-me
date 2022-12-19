<?php
require_once '../data/bootstrap.php';
require_once '../libraries/users.php';
require_once '../libraries/auth.php';

$email      = trim($_POST['email']);
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

if (empty($password)) {
    $errors['password'] = "La contraseña es obligatoria.";
}

if (empty($name)) {
    $errors['name'] = "El nombre es obligatorio.";
}

if (empty($username)) {
    $errors['username'] = "El username es obligatorio.";
}

if (empty($location)) {
    $errors['location'] = "La ubicación es obligatoria.";
}

if (empty($biography)) {
    $errors['biography'] = "La biografía es obligatoria.";
}

if (empty($birthdate)) {
    $errors['birthdate'] = "La fecha de nacimiento es obligatoria.";
}

if (!empty($errors)) {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ../index.php?s=sign-up");
    exit;
}

$idUser = userCreate($db, [
    //  'role'    => $idRole, 
    'email'     => $email,
    'password'  => $password,
    'name'      => $name,
    'username'  => $username,
    'location'   => $location,
    'biography'   => $biography,
    'birthdate'   => $birthdate,
]);

if ($idUser !== false) {
    authSetLogin([
        'id_user'        => $idUser,
        'role'        => 1,
        'email'          => $email,
        'name'           => $name,
        'username'       => $username,
        'location'        => $location,
        'biography'   => $biography,
        'birthdate'   => $birthdate,
    ]);

    $_SESSION['status_success'] = "¡Registro exitoso, gracias por registrarte a Hiei Store, " . $email . "!";
    header('Location: ../index.php?s=profile');
    exit;
} else {
    $_SESSION['old_data'] = $_POST;
    $_SESSION['status_error'] = "Hubo un error al guardar el registro en nuestro servidor. Por favor, intentá de nuevo más tarde. Si el problema continúa comunicate con el soporte.";
    header("Location: ../index.php?s=sign-up");
    exit;
}
