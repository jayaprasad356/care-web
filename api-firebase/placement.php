<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../includes/crud.php');

$db = new Database();
$db->connect();
if (empty($_POST['student_id'])) {
    $response['success'] = false;
    $response['message'] = "student ID is Empty";
    print_r(json_encode($response));
    return false;
}
$student_id = $db->escapeString($_POST['student_id']);
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$db->sql($sql);
$res = $db->getResult();
$sslc_percentage=$res[0]['sslc_percentage'];
$hsc_percentage=$res[0]['hsc_percentage'];
$ug_percentage=$res[0]['ug_percentage'];
$sql = "SELECT * FROM companies WHERE sslc_percentage <= '$sslc_percentage' AND hsc_percentage <='$hsc_percentage' AND ug_percentage <='$ug_percentage'";
$db->sql($sql);
$res = $db->getResult();


$response['success'] = true;
$response['message'] = "placements list Retrieved Successfullly";
$response['data'] = $res;
print_r(json_encode($response));

?>