<?php
session_start();
require 'vendor/autoload.php';
require 'config/base.config.php';

define('APPPATH', __DIR__);

if (PROD) {

} else {
    $dsn      = 'mysql:dbname=journal;host=localhost';
    $user     = 'root';
    $password = '';
}
\FW\Orm\DB::init($dsn, $user, $password);