<?php
define('DB_HOST','sua host');
define('DB_USER','usuario da host');
define('DB_PASS','');
define('DB_NAME','nome do banco de dados');

function db_conecta()
{
    $PDO = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}
