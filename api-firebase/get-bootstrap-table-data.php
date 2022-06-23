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
    if (isset($_GET['batch']) && $_GET['batch'] != '') {
        $batch = $db->escapeString($fn->xss_clean($_GET['batch']));
        $where .= " AND batch = '$batch' ";
    }
    if (isset($_GET['degree']) && $_GET['degree'] != '') {
        $degree = $db->escapeString($fn->xss_clean($_GET['degree']));
        $where .= " AND degree = '$degree' ";
    }
    if (isset($_GET['department']) && $_GET['department'] != '') {
        $department = $db->escapeString($fn->xss_clean($_GET['department']));
        $where .= " AND department = '$department' ";
    }
    if (isset($_GET['section']) && $_GET['section'] != '') {
        $section = $db->escapeString($fn->xss_clean($_GET['section']));
        $where .= " AND section = '$section' ";
    }
    if (isset($_GET['quota']) && $_GET['quota'] != '') {
        $quota = $db->escapeString($fn->xss_clean($_GET['quota']));
        $where .= " AND quota = '$quota' ";
    }
    if (isset($_GET['mode']) && $_GET['mode'] != '') {
        $mode = $db->escapeString($fn->xss_clean($_GET['mode']));
        $where .= " AND mode = '$mode' ";
    }
    if (isset($_GET['gender']) && $_GET['gender'] != '') {
        $gender = $db->escapeString($fn->xss_clean($_GET['gender']));
        $where .= " AND gender = '$gender' ";
    }
   
    if (isset($_GET['religion']) && $_GET['religion'] != '') {
        $religion = $db->escapeString($fn->xss_clean($_GET['religion']));
        $where .= " AND religion= '$religion' ";
    }
    if (isset($_GET['community']) && $_GET['community'] != '') {
        $community = $db->escapeString($fn->xss_clean($_GET['community']));
        $where .= " AND community = '$community' ";
    }
    if (isset($_GET['blood_group']) && $_GET['blood_group'] != '') {
        $blood_group= $db->escapeString($fn->xss_clean($_GET['blood_group']));
        $where .= " AND blood_group = '$blood_group' ";
    }
    if (isset($_GET['mother_tongue']) && $_GET['mother_tongue'] != '') {
        $mother_tongue = $db->escapeString($fn->xss_clean($_GET['mother_tongue']));
        $where .= " AND mother_tongue = '$mother_tongue' ";
    }
    if (isset($_GET['nationality']) && $_GET['nationality'] != '') {
        $nationality = $db->escapeString($fn->xss_clean($_GET['nationality']));
        $where .= " AND nationality = '$nationality' ";
    }
    if (isset($_GET['sslc_medium']) && $_GET['sslc_medium'] != '') {
        $sslc_medium = $db->escapeString($fn->xss_clean($_GET['sslc_medium']));
        $where .= " AND sslc_medium = '$sslc_medium' ";
    }
    if (isset($_GET['sslc_board']) && $_GET['sslc_board'] != '') {
        $sslc_board = $db->escapeString($fn->xss_clean($_GET['sslc_board']));
        $where .= " AND sslc_board = '$sslc_board' ";
    }
    if (isset($_GET['sslc_year']) && $_GET['sslc_year'] != '') {
        $sslc_year = $db->escapeString($fn->xss_clean($_GET['sslc_year']));
        $where .= " AND sslc_year = '$sslc_year' ";
    }
    if (isset($_GET['group']) && $_GET['group'] != '') {
        $group = $db->escapeString($fn->xss_clean($_GET['group']));
        $where .= " AND group = '$group' ";
    }
    if (isset($_GET['hsc_medium']) && $_GET['hsc_medium'] != '') {
        $hsc_medium= $db->escapeString($fn->xss_clean($_GET['hsc_medium']));
        $where .= " AND hsc_medium = '$hsc_medium' ";
    }
    if (isset($_GET['hsc_board']) && $_GET['hsc_board'] != '') {
        $hsc_board = $db->escapeString($fn->xss_clean($_GET['hsc_board']));
        $where .= " AND hsc_board = '$hsc_board' ";
    }
    if (isset($_GET['hsc_year']) && $_GET['hsc_year'] != '') {
        $hsc_year = $db->escapeString($fn->xss_clean($_GET['hsc_year']));
        $where .= " AND hsc_year = '$hsc_year' ";
    }
    if (isset($_GET['type_of_stay']) && $_GET['type_of_stay'] != '') {
        $type_of_stay= $db->escapeString($fn->xss_clean($_GET['type_of_stay']));
        $where .= " AND type_of_stay = '$type_of_stay' ";
    }
    if (isset($_GET['bus_route_no']) && $_GET['bus_route_no'] != '') {
        $bus_route_no = $db->escapeString($fn->xss_clean($_GET['bus_route_no']));
        $where .= " AND bus_route_no = '$bus_route_no' ";
    }
    if (isset($_GET['boarding_point']) && $_GET['boarding_point'] != '') {
        $boarding_point = $db->escapeString($fn->xss_clean($_GET['boarding_point']));
        $where .= " AND boarding_point = '$boarding_point' ";
    }
    if (isset($_GET['fg']) && $_GET['fg'] != '') {
        $fg = $db->escapeString($fn->xss_clean($_GET['fg']));
        $where .= " AND fg = '$fg' ";
    }
    if (isset($_GET['pstm_sch']) && $_GET['pstm_sch'] != '') {
        $pstm_sch = $db->escapeString($fn->xss_clean($_GET['pstm_sch']));
        $where .= " AND pstm_sch = '$pstm_sch' ";
    }
    if (isset($_GET['nsp']) && $_GET['nsp'] != '') {
        $nsp = $db->escapeString($fn->xss_clean($_GET['nsp']));
        $where .= " AND nsp = '$nsp' ";
    }
    if (isset($_GET['bc_mbc_sch']) && $_GET['bc_mbc_sch'] != '') {
        $bc_mbc_sch = $db->escapeString($fn->xss_clean($_GET['bc_mbc_sch']));
        $where .= " AND bc_mbc_sch = '$bc_mbc_sch' ";
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
        $where .= "AND name like '%" . $search . "%' OR roll_no like '%" . $search . "%' OR register_number like '%" . $search . "%'";
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

        //$operate = '<a href="edit-student.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $operate = '<a href="view-student.php?id='. $row['id'] . '" class="label label-primary" title="View">View</a>'; 
        $tempRow['id'] = $row['id'];
        $tempRow['batch'] = $row['batch'];
        $tempRow['degree'] = $row['degree'];
        $tempRow['department'] = $row['department'];
        $tempRow['section'] = $row['section'];
        $tempRow['roll_no'] = $row['roll_no'];
        $tempRow['register_number'] = $row['register_number'];
        $tempRow['name'] = $row['name'];
        $tempRow['quota'] = $row['quota'];
        $tempRow['mode'] = $row['mode'];
        $tempRow['gender'] = $row['gender'];
        $tempRow['dob'] = $row['dob'];
        $tempRow['religion'] = $row['religion'];
        $tempRow['community'] = $row['community'];
        $tempRow['sub_caste'] = $row['sub_caste'];
        $tempRow['blood_group'] = $row['blood_group'];
        $tempRow['mother_tongue'] = $row['mother_tongue'];
        $tempRow['nationality'] = $row['nationality'];
        $tempRow['aadhaar_number'] = $row['aadhaar_number'];
        $tempRow['father_name'] = $row['father_name'];
        $tempRow['father_occupation'] = $row['father_occupation'];
        $tempRow['mother_name'] = $row['mother_name'];
        $tempRow['mother_occupation'] = $row['mother_occupation'];
        $tempRow['parent_income'] = $row['parent_income']; 
        $tempRow['address'] = $row['address'];
        $tempRow['district'] = $row['district'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['parent_mobile'] = $row['parent_mobile'];
        $tempRow['email'] = $row['email'];
        $tempRow['sslc_school'] = $row['sslc_school'];
        $tempRow['sslc_percentage'] = $row['sslc_percentage'];
        $tempRow['sslc_medium'] = $row['sslc_medium'];
        $tempRow['sslc_board'] = $row['sslc_board'];
        $tempRow['sslc_year'] = $row['sslc_year'];
        $tempRow['group'] = $row['group'];
        $tempRow['hsc_school'] = $row['hsc_school'];
        $tempRow['hsc_percentage'] = $row['hsc_percentage'];
        $tempRow['hsc_medium'] = $row['hsc_medium'];
        $tempRow['hsc_board'] = $row['hsc_board'];
        $tempRow['hsc_year'] = $row['hsc_year'];
        $tempRow['maths'] = $row['maths'];
        $tempRow['physics'] = $row['physics'];
        $tempRow['chemistry'] = $row['chemistry'];
        $tempRow['average'] = $row['average'];
        $tempRow['cut_off'] = $row['cut_off'];
        $tempRow['total'] = $row['total'];
        $tempRow['type_of_stay'] = $row['type_of_stay'];
        $tempRow['bus_route_no'] = $row['bus_route_no'];
        $tempRow['boarding_point'] = $row['boarding_point'];
        $tempRow['reference'] = $row['reference'];
        $tempRow['fg'] = $row['fg'];
        $tempRow['pstm_sch'] = $row['pstm_sch'];
        $tempRow['nsp'] = $row['nsp'];
        $tempRow['bc_mbc_sch'] = $row['bc_mbc_sch'];
        $tempRow['tnea_no'] = $row['tnea_no'];
        $tempRow['consortium_no'] = $row['consortium_no'];
        $tempRow['consortium_marks'] = $row['consortium_marks'];
        $tempRow['operate'] = $operate;
        //$tempRow['action'] = $operate1;
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
if (isset($_GET['table']) && $_GET['table'] == 'internalmarks') {
    $where = '';
    if ((isset($_GET['batch']) && $_GET['batch'] != '') && (isset($_GET['department']) && $_GET['department'] != '') && (isset($_GET['semester']) && $_GET['semester'] != '') && (isset($_GET['testtype']) && $_GET['testtype'] != '')) {
        $batch = $db->escapeString($fn->xss_clean($_GET['batch']));
        $department = $db->escapeString($fn->xss_clean($_GET['department']));
        $semester = $db->escapeString($fn->xss_clean($_GET['semester']));
        $testtype = $db->escapeString($fn->xss_clean($_GET['testtype']));
        $where .= " WHERE batch = '$batch' AND department = '$department' AND semester = $semester AND test_type = '$testtype' " ;
    }
    $sql = "SELECT * FROM internalmarks ".$where;
    $db->sql($sql);
    $res = $db->getResult();
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {
        $roll_no = $row['roll_no'];
        $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
        $db->sql($sql1);
        $res1 = $db->getResult();
        foreach ($res1 as $row1) {
            $subjectname = $row1['subject_code'];
            $marks = $row1['marks'];
            $tempRow[$subjectname] = $marks;

        }

        //$operate = ' <a href="edit-internalmark.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['roll_no'] = $row['roll_no'];


        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'internalanalysis') {
    $where = '';
    if ((isset($_GET['batch']) && $_GET['batch'] != '') && (isset($_GET['department']) && $_GET['department'] != '') && (isset($_GET['semester']) && $_GET['semester'] != '') && (isset($_GET['testtype']) && $_GET['testtype'] != '')) {
        $batch = $db->escapeString($fn->xss_clean($_GET['batch']));
        $department = $db->escapeString($fn->xss_clean($_GET['department']));
        $semester = $db->escapeString($fn->xss_clean($_GET['semester']));
        $testtype = $db->escapeString($fn->xss_clean($_GET['testtype']));
        $where .= " WHERE batch = '$batch' AND department = '$department' AND semester = $semester AND test_type = '$testtype' " ;
    }
    $sql = "SELECT * FROM internalmarks ".$where;
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    $rows = array();
    $tempRow = array();
    for ($i = 0; $i < 7; $i++) {
        
        if($i == 0){
            $tempRow['title'] = 'Total No. of Students';
            
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $tempRow[$subjectname] = $num;
                }

            }
            

        }
        elseif($i == 1){
            $tempRow['title'] = 'Total No. of Pass for 50';

            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT * FROM internalmarks ". $where ."  AND subject_code = '$subjectname' AND marks >= 50";
                    $db->sql($sql);
                    $res = $db->getResult();
                    $passfnum = $db->numRows($res);
                    $tempRow[$subjectname] = $passfnum;
                }
            }
            
        
            

        }elseif($i == 2){
            $tempRow['title'] = 'Total Absentees';
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT * FROM internalmarks ". $where ."  AND subject_code = '$subjectname' AND marks = 'AB'";
                    $db->sql($sql);
                    $res = $db->getResult();
                    $abnum = $db->numRows($res);
                    $tempRow[$subjectname] = $abnum;
                }
            }
            
        }elseif($i == 3){
            $tempRow['title'] = 'Pass Percentage % for 50';
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT * FROM internalmarks ". $where ."  AND subject_code = '$subjectname' AND marks >= 50";
                    $db->sql($sql);
                    $res = $db->getResult();
                    $passfnum = $db->numRows($res);
                    $passpercentf = $passfnum / $num * 100;
                    $tempRow[$subjectname] = round($passpercentf, 2);
                }
            }

        }elseif($i == 4){
            $tempRow['title'] = 'Mean of Marks';
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT AVG(marks) AS mean FROM internalmarks ". $where ."  AND subject_code = '$subjectname'";
                    $db->sql($sql);
                    $meanres = $db->getResult();
                    $tempRow[$subjectname] = round($meanres[0]['mean'], 2);
                }
            }

            
        }elseif($i == 5){
            $tempRow['title'] = 'Total No. of Pass for 70';
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT * FROM internalmarks ". $where ."  AND subject_code = '$subjectname' AND marks >= 70 ";
                    $db->sql($sql);
                    $res = $db->getResult();
                    $passsenum = $db->numRows($res);
                    $tempRow[$subjectname] = $passsenum;
                }
            }
           
        }elseif($i == 6){
            $tempRow['title'] = 'Pass Percentage % for 70';
            $sql = "SELECT * FROM internalmarks ".$where;
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            foreach ($res as $row) {
                $roll_no = $row['roll_no'];
                $sql1 = "SELECT * FROM internalmarks ". $where ." AND roll_no = '$roll_no'";
                $db->sql($sql1);
                $res1 = $db->getResult();
                foreach ($res1 as $row1) {
                    $subjectname = $row1['subject_code'];
                    $sql = "SELECT * FROM internalmarks ". $where ."  AND subject_code = '$subjectname' AND marks >= 70 ";
                    $db->sql($sql);
                    $res = $db->getResult();
                    $passsenum = $db->numRows($res);
                    $passpercents = $passsenum / $num * 100;
                    $tempRow[$subjectname] = round($passpercents, 2);
                }
            }
            
        }
        
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
