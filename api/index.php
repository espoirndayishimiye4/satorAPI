<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: *');
header("Access-Control-Max-Age: 4600");
header('Access-Control-Allow-Headers: *');

use Src\Controller\MDeviceController;
use Src\Controller\MTruckingController;

require "bootstrap.php";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

switch ($uri[3]) {
    
    case 'truck':
        $serialnumber = null;
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $redirect = explode('/',$_SERVER['REDIRECT_QUERY_STRING']);
       
        // Routing
        $productRoute = explode('/',"/product/:id");
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
        $serialnumber = $redirect[2];
        $controller = new MTruckingController($dbConnection, $requestMethod, $serialnumber);
        $controller->processRequest();
        break;
    


    default:
        echo "Api is ready!";
        break;
}
?>