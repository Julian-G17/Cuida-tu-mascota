<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/eventos.php';
 //include_once '../token/validatetoken.php';
// instantiate database and eventos object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$eventos = new Eventos($db);
 
// read eventos will be here

// query eventos
$stmt = $eventos->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    //eventos array
    $eventos_arr=array();
    $eventos_arr["records"]=array();
 
    // retrieve our table contents
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $eventos_item=array(
            
"id_eventos" => $id_eventos,
"nombre" => $nombre,
"descripción" => html_entity_decode($descripción),
"fecha" => $fecha,
"hora" => $hora,
"id_mascota" => $id_mascota
        );
 
        array_push($eventos_arr["records"], $eventos_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show eventos data in json format
	echo json_encode(array("status" => "success", "code" => 1,"message"=> "eventos found","document"=> $eventos_arr));
    
}else{
 // no eventos found will be here

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no eventos found
	echo json_encode(array("status" => "error", "code" => 0,"message"=> "No eventos found.","document"=> ""));
    
}
 


