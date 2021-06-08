<?php
session_start();
require 'vendor/autoload.php';

use Src\System\DatabaseConnector;
use Src\System\Token;

$dbConnection = (new DatabaseConnector())->getConnection();
$token = (new Token());

?>