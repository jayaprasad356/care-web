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
$department=$res[0]['department'];
$batch=$res[0]['batch'];
$sql = "SELECT * FROM timetables WHERE department = '$department' AND batch ='$batch'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['name'] = $row['name'];
        $temp['file'] = DOMAIN_URL  .$row['file'];
        $rows[] = $temp;
        
    }
    $response['success'] = true;
    $response['message'] = "TimeTables list Retrieved Successfullly";
    $response['data'] = $rows;

}
else{
    $response['success'] = false;
    $response['message'] = "Not Found";

}



print_r(json_encode($response));

?>