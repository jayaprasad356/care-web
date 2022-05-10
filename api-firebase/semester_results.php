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
    $response['message'] = "Student ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['semester'])) {
    $response['success'] = false;
    $response['message'] = "Semester is Empty";
    print_r(json_encode($response));
    return false;
}
$student_id = $db->escapeString($_POST['student_id']);
$semester = $db->escapeString($_POST['semester']);
$sql = "SELECT * FROM students WHERE id ='$student_id'";
$db->sql($sql);
$res = $db->getResult();
$roll_no = $res[0]['roll_no'];
$sql = "SELECT *,universityresults.id AS id FROM universityresults,subjects WHERE universityresults.roll_no ='$roll_no' AND universityresults.semester = '$semester' AND subjects.subject_code = universityresults.subject_code";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){

    $response['success'] = true;
    $response['message'] = "Results Retrived Successfully";
    $response['data'] = $res;
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] = "Result Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>