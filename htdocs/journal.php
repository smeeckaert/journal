<?php
require_once '../bootstrap.php';
$user = \Session\Session::user();
if (!$user) {
    header('Location: /');
    exit;
}
echo $user->login;
?>