<?php 
require '../bootstrap.php';

use Src\Controller\ViewController\CarouselViewController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if($uri[2] == 'carousel'){
    $id = null;
    $short_url = null;
    if (isset($uri[3])) {
        if ($requestMethod == "GET") {
            // $short_url = (intval($uri[3]) == 0) ? (String) $uri[3] : null;
            // $id = ($short_url == null) ? (int) $uri[3] : null;
            $short_url = (String) $uri[3];
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
    exit();
    }
    
    // pass the request method and user ID to the CarouselController and process the HTTP request:
    $controller = new CarouselViewController($short_url, $id, "../../");
    echo($controller->showView());
}
else{
    header("HTTP/1.1 404 Not Found");
    exit();
}