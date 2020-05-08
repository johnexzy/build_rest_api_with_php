<?php
require '../bootstrap.php';
use Src\Controller\CommentsController;
use Src\Controller\PersonController;
use Src\Controller\NewsController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER['REQUEST_METHOD'];
//all of the end points starts with person
//everything else results in a 404
if ($uri[1] == 'person') {
    
    //the user ID is, of course optional and must be integer
    $userId = null;
    if (isset($uri[2])) {
        $userId = (int) $uri[2];
    }
    

    // pass the request method and user ID to the PersonController and process the HTTP request:
    $controller = new PersonController($dbConnection, $requestMethod, $userId);
    $controller->processRequest();
    //pass the request Method and user ID to PersonController and process the HTTP request

}
elseif ($uri[1] == 'comments') {
    $comId = null;
    $tag = null;
    if (isset($uri[2])) {
        if ($requestMethod == "GET") {
            $tag = (String) $uri[2];
            $tag = str_replace("%20", " ", $tag);
        }
        if ($requestMethod == "PUT") {
            $comId = (int) $uri[2];
        }
    }

    

    // pass the request method and user ID to the PersonController and process the HTTP request:
    $controller = new CommentsController($dbConnection, $requestMethod, $tag, $comId);
    $controller->processRequest();
}
elseif ($uri[1] == 'news') {
    $id = null;
    $cat = null;
    if (isset($uri[2])) {
        if ($requestMethod == "GET") {
            $cat = (String) $uri[2];
        }
        if ($requestMethod == "PUT") {
            $id = (int) $uri[2];
        }
    }

    

    // pass the request method and user ID to the PersonController and process the HTTP request:
    $controller = new NewsController($dbConnection, $requestMethod, $cat, $id);
    $controller->processRequest();
}
else{
    header("HTTP/1.1 404 Not Found");
    exit();
}