<?php
require 'bootstrap.php';

use Src\TableGateWays\PersonGateway;

$personGateway = new PersonGateway($dbConnection);


// return all records
$result = $personGateway->findAll();
// echo "findall: ".$result["firstname"]."\n";
// return the record with id = 1
if($result = $personGateway->find(4)){
    echo "found\n";
};

// insert a new record
// update the record with id = 10
$result = $personGateway->update(4, [
    'firstname' => 'OBA',
    'lastname' => 'JOHN',
    'firstparent_id' => 3,
    'secondparent_id' => 4,
]);
echo "update: ".$result."\n";
// delete the record with id = 10
$result = $personGateway->delete(10);
$result = $personGateway->delete(11);
$result = $personGateway->delete(12);
$result = $personGateway->delete(13);
$result = $personGateway->delete(14);
$result = $personGateway->delete(15);
$result = $personGateway->delete(16);
$result = $personGateway->delete(17);
echo "delete: ".$result."\n";
