<?php
session_start();

// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;

// if session not set go to login page
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once('../includes/custom-functions.php');
$fn = new custom_functions;
include_once('../includes/crud.php');
include_once('../includes/variables.php');
$db = new Database();
$db->connect();
$config = $fn->get_configurations();
if (isset($config['system_timezone']) && isset($config['system_timezone_gmt'])) {
    date_default_timezone_set($config['system_timezone']);
    $db->sql("SET `time_zone` = '" . $config['system_timezone_gmt'] . "'");
} else {
    date_default_timezone_set('Asia/Kolkata');
    $db->sql("SET `time_zone` = '+05:30'");
}
if (isset($_GET['table']) && $_GET['table'] == 'students') {
    $where = '';
    if (isset($_GET['community']) && $_GET['community'] != '') {
        $community = $db->escapeString($fn->xss_clean($_GET['community']));
        $where .= " WHERE community = '$community' ";
    }
    $sql = "SELECT * FROM students $where";
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['roll_no'] = $row['roll_no'];
        $tempRow['department'] = $row['department'];
        $tempRow['community'] = $row['community'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
    if (isset($_GET['table']) && $_GET['table'] == 'staffs') {
        $where = '';
        
        $sql = "SELECT * FROM staffs";
        $db->sql($sql);
        $res = $db->getResult();
        $rows = array();
        $tempRow = array();
        foreach ($res as $row) {
    
            $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
            $tempRow['id'] = $row['id'];
            $tempRow['name'] = $row['name'];
            $tempRow['mobile'] = $row['mobile'];
            $tempRow['department'] = $row['department'];
            $tempRow['role'] = $row['role'];
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
        }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'subjects') {
    $where = '';
    
    $sql = "SELECT * FROM subjects";
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['department'] = $row['department'];
        $tempRow['subject_name'] = $row['subject_name'];
        $tempRow['subject_code'] = $row['subject_code'];
        $tempRow['regulation'] = $row['regulation'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
$bulkData['rows'] = $rows;
print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'companies') {
    $where = '';
    
    $sql = "SELECT * FROM companies";
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['company_name'] = $row['company_name'];
        $tempRow['job_role'] = $row['job_role'];
        $tempRow['location'] = $row['location'];
        $tempRow['sslc_mark'] = $row['sslc_mark'];
        $tempRow['hsc_mark'] = $row['hsc_mark'];
        $tempRow['cgpa'] = $row['cgpa'];
        $tempRow['salary'] = $row['salary'];
        $tempRow['registration_link'] = $row['registration_link'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
$bulkData['rows'] = $rows;
print_r(json_encode($bulkData));
}


$db->disconnect();
