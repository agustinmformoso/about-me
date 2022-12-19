<?php
require_once '../data/bootstrap.php';
require_once '../data/conection.php';
require_once '../libraries/users.php';

$email = $_POST['email'];

$user = userSearchByEmail($db, $email);

if (!$user) {
    $_SESSION['status_error'] = "There is no account associated with this email. Please check that it is correct.";
    header('Location: ../index.php?s=forgot-password');
    exit;
}

$token = userGenerateResetToken($db, $user['id_user']);

$body = file_get_contents(__DIR__ . '/../emails/reset-password.html');

$link = "http://localhost/www/aboutdotme/index.php?s=reset-password&token=" . $token . "&email=" . $email;

$body = str_replace('@@EMAIL@@', $email, $body);
$body = str_replace('@@URL@@', $link, $body);

$subject = "About Me | Forgot password";

$headers  = "From: noreply@aboutme.com" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: text/html; charset=utf-8" . "\r\n";

if (!mail($email, $subject, $body, $headers)) {
    $fileName = date('Ymd_His') . "_reset-password.html";
    file_put_contents(__DIR__ . "/../emails/sent/" . $fileName, $body);
}

$_SESSION['status_success'] = "We will send an email to your mailbox with the steps to recover the password. If you don't see the email, check your spam/junk mail.";
header('Location: ../index.php?s=forgot-password');
