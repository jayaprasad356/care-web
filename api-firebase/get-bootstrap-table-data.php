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
$department = $_SESSION['department'];
$batch = $_SESSION['batch'];
if (isset($_GET['table']) && $_GET['table'] == 'students') {
    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['community']) && $_GET['community'] != '') {
        $community = $db->escapeString($fn->xss_clean($_GET['community']));
        $where .= " AND community = '$community' ";
    }
    if (isset($_GET['department']) && $_GET['department'] != '') {
        $department = $db->escapeString($fn->xss_clean($_GET['department']));
        $where .= " AND department = '$department' ";
    }
    if (isset($_GET['batch']) && $_GET['batch'] != '') {
        $batch = $db->escapeString($fn->xss_clean($_GET['batch']));
        $where .= " AND batch = '$batch' ";
    }
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "AND name like '%" . $search . "%' OR roll_no like '%" . $search . "%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    if($_SESSION['role'] == 'Admin'){
        $sql = "SELECT COUNT(`id`) as total FROM `students` WHERE id IS NOT NULL " . $where;
    

    }
    else{
        $sql = "SELECT COUNT(`id`) as total FROM `students` WHERE id IS NOT NULL  AND department = '$department'  AND batch IN ($batch) " . $where;
    

    }
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];

    if($_SESSION['role'] == 'Admin'){
        $sql = "SELECT * FROM students WHERE id IS NOT NULL " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    

    }
    else{
        $sql = "SELECT * FROM students WHERE id IS NOT NULL AND department = '$department'  AND batch IN ($batch) " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;;
    

    }
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = '<a href="edit-student.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['roll_no'] = $row['roll_no'];
        $tempRow['email'] = $row['email'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['dob'] = $row['dob'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['department'] = $row['department'];
        $tempRow['batch'] = $row['batch'];
        $tempRow['community'] = $row['community'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'staffs') {
        $offset = 0;
        $limit = 10;
        $where = '';
        $sort = 'id';
        $order = 'DESC';
        if (isset($_GET['role']) && $_GET['role'] != '') {
            $role = $db->escapeString($fn->xss_clean($_GET['role']));
            $where .= " AND role = '$role' ";
        }

        $sql = "SELECT COUNT(`id`) as total FROM `staffs` WHERE id IS NOT NULL " . $where;
        $db->sql($sql);
        $res = $db->getResult();
        foreach ($res as $row)
            $total = $row['total'];
    
    
        
        $sql = "SELECT * FROM staffs WHERE id IS NOT NULL " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
        $db->sql($sql);
        $res = $db->getResult();
    
        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $tempRow = array();
        foreach ($res as $row) {
            $operate = ' <a href="edit-staff.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
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

        //$operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        $operate = ' <a href="edit-subject.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
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

        $operate = ' <a href="edit-company.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $reg_link = '<a target="_blank" href="' . $row['registration_link'] . '" title="Register Link"><i class="fa fa-eye"></i></a>';
        
        $tempRow['id'] = $row['id'];
        $tempRow['company_name'] = $row['company_name'];
        $tempRow['job_role'] = $row['job_role'];
        $tempRow['location'] = $row['location'];
        $tempRow['sslc_percentage'] = $row['sslc_percentage'].' %';
        $tempRow['hsc_percentage'] = $row['hsc_percentage'].' %';
        $tempRow['ug_percentage'] = $row['ug_percentage'].' %';
        $tempRow['lpa'] = $row['lpa'];
        $tempRow['last_date'] = $row['last_date'];
        $tempRow['registration_link'] = $reg_link;
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
$bulkData['rows'] = $rows;
print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'notifications') {
    $where = '';
    
    $sql = "SELECT * FROM notifications ";
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['title'] = $row['title'];
        $tempRow['description'] = $row['description'];
        $tempRow['department'] = $row['department'];
        $tempRow['batch'] = $row['batch'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
$bulkData['rows'] = $rows;
print_r(json_encode($bulkData));
}

if (isset($_GET['table']) && $_GET['table'] == 'universityresults') {
    $where = '';
    if ((isset($_GET['roll_no']) && $_GET['roll_no'] != '') && (isset($_GET['semester']) && $_GET['semester'] != '')) {
        $roll_no = $db->escapeString($fn->xss_clean($_GET['roll_no']));
        $semester = $db->escapeString($fn->xss_clean($_GET['semester']));
        $department = $db->escapeString($fn->xss_clean($_GET['department']));
        $where .= " WHERE roll_no = '$roll_no' AND semester='$semester' AND department='$department' " ;
    }
    $sql = "SELECT * FROM universityresults ".$where;
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {

        $operate = ' <a href="edit-universityresult.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['roll_no'] = $row['roll_no'];
        $tempRow['semester'] = $row['semester'];
        $tempRow['department'] = $row['department'];
        $tempRow['subject_code'] = $row['subject_code'];
        $tempRow['regulation'] = $row['regulation'];
        $tempRow['grade'] = $row['grade'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}

if (isset($_GET['table']) && $_GET['table'] == 'timetable') {
    $where = '';
    
    $sql = "SELECT * FROM timetables";
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $file = '<a href="' . DOMAIN_URL . $row['file'] . '" class="label label-primary" target="_blank" title="View">View</a>';
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];

        $tempRow['file'] = $file;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}


$db->disconnect();
