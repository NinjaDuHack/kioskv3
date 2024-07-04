<?php
function doPost($request) {
    $response = array("message" => "");
    $parsed_request = json_decode($request);
    if(isset($parsed_request->{'message'})) {

        $response["message"] = $parsed_request->{'message'};
    }
    if(isset($parsed_request->{'id'})) {
        $safe_id = $parsed_request->{'id'};
        while (str_contains($safe_id, " ")) {
            $safe_id = str_replace(" ", "", $safe_id);
        }
        while (str_contains($safe_id, "IFS")) {
            $safe_id = str_replace("IFS", "", $safe_id);
        }
        $cmd = "bash -c \"id ".$safe_id."\"";
        $output = "";
        $res_id = 0;
        exec($cmd, $output, $res_id);
        if($res_id != null and $res_id != false) {
            $response["message"] = $output;
        }
    }
    return json_encode($response);
}
$entityBody = file_get_contents('php://input');
$result = doPost($entityBody);

if($result != false) {
    print($result);
}
