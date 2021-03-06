<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/mascota.php';
 //include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mascota object
$mascota = new Mascota($db);
 
// get mascota id
$data = json_decode(file_get_contents("php://input"));
 
// set mascota id to be deleted
$mascota->id_mascota = $data->id_mascota;
 
// delete the mascota
if($mascota->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Mascota was deleted","document"=> ""));
    
}
 
// if unable to delete the mascota
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to delete mascota.","document"=> ""));
}
?>
