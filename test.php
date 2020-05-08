<?php
require 'bootstrap.php';

use Src\TableGateWays\PersonGateway;
use Src\TableGateWays\NewsGateway;
use Src\TableGateWays\CommentsGateway;

$commets = new CommentsGateway($dbConnection);
$personGateway = new PersonGateway($dbConnection);
$newsGateway = new NewsGateway($dbConnection);
$result = $newsGateway->insert(array(
    "headline" => "latest",
    "uploads" => "images/IMG_20191213_1576261414_UN.png",
    "body" => "Latest  newes",
    "tag" => "latest",
    "category" => "NEWS",
    "Dateofpost" => "20200507",
    "Writer" => "JOhn",
));

echo $result."\n";
