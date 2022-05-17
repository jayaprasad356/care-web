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

if (empty($_POST['roll_no'])) {
    $response['success'] = false;
    $response['message'] = "Roll Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['department'])) {
    $response['success'] = false;
    $response['message'] = "Department is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['test_type'])) {
    $response['success'] = false;
    $response['message'] = "Type of test is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['number'])) {
    $response['success'] = false;
    $response['message'] = "Number is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['semester'])) {
    $response['success'] = false;
    $response['message'] = "Semester is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['regulation'])) {
    $response['success'] = false;
    $response['message'] = "Regulation is Empty";
    print_r(json_encode($response));
    return false;
}
$roll_no = $db->escapeString($_POST['roll_no']);
$department = $db->escapeString($_POST['department']);
$test_type = $db->escapeString($_POST['test_type']);
$number = $db->escapeString($_POST['number']);
$semester = $db->escapeString($_POST['semester']);
$regulation = $db->escapeString($_POST['regulation']);
$sql = "SELECT * FROM internalmarks WHERE roll_no ='$roll_no'AND department='$department'AND test_type='$test_type'AND number='$number'AND semester='$semester'AND regulation='$regulation'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1){
    $response['success'] = true;
    $response['message'] = "Internal marks Retrived Successfully";
    $response['data'] = $res;
    print_r(json_encode($response));
}
else{
    $response['success'] = false;
    $response['message'] = "Student Not Found";
    print_r(json_encode($response));

}
?>