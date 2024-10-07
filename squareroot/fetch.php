<?php
declare(strict_types=1);
require_once(__DIR__.'/../../config.php');
global $DB, $USER;

//Get data

$data["a"] = round(required_param('a',PARAM_FLOAT),3);
$data["b"] = round(required_param('b',PARAM_FLOAT),3);
$data["c"] = round(required_param('c',PARAM_FLOAT),3);

//Solve
if ($data["a"] == 0) {$result["result"] = "That is not quadratic equation (a=0)"; echo json_encode($result); return;}

$discriminant = pow($data["b"],2)-4*$data["a"]*$data["c"];

if ($discriminant<0) $result["result"] = "No Roots";
elseif ($discriminant == 0){
   $result["result"] = "One Root";
   $result["x1"] = round(-$data["b"]/(2*$data["a"]),5);
}
else {
   $result["result"] = "Two Roots";
   $result["x1"] = round((-$data["b"]-sqrt($discriminant))/(2*$data["a"]),5);
   $result["x2"] = round((-$data["b"]+sqrt($discriminant))/(2*$data["a"]),5);
}

//Update DB
$DBdata["user_id"] = $USER->id;
$DBdata["result"] = $result["result"];
$DBdata["x1"] = $result["x1"];
$DBdata["x2"] = $result["x2"];
$DBdata["a"] = $data["a"];
$DBdata["b"] = $data["b"];
$DBdata["c"] = $data["c"];


$DB->insert_record('block_historysqareroot',$DBdata);
//$DB->insert_record('squareroothistory',$DBdata);
//Send result to client

echo json_encode($result);

