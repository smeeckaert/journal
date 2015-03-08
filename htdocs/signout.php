<?php
require_once '../bootstrap.php';
\Session\Session::set(null, null); //@todo remove
header('Location: /');
exit;
?>