<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/usuario.php';
// include_once '../token/validatetoken.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare usuario object
$usuario = new Usuario($db);
 
// get usuario id
$data = json_decode(file_get_contents("php://input"));
 
// set usuario id to be deleted
$usuario->id_usuario = $data->id_usuario;
 
// delete the usuario
if($usuario->delete()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "Usuario was deleted","document"=> ""));
    
}
 
// if unable to delete the usuario
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "Unable to delete usuario.","document"=> ""));
}
?>
