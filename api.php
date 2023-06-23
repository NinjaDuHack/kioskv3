<?php
function doPost($request) {
    $response = array("message" => "");
    $parsed_request = json_decode($request);
    if(isset($parsed_request->{'message'})) {

        $response["message"] = $parsed_request->{'message'};
    }
    if(isset($parsed_request->{'id'})) {
        $res_id = shell_exec("id ".$parsed_request->{'id'});
        if($res_id != null and $res_id != false) {
            $response["message"] = $res_id;
        }
    }
    return json_encode($response);
}
$entityBody = file_get_contents('php://input');
$result = doPost($entityBody);

if($result != false) {
    print($result);
}