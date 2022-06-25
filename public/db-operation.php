<?php
session_start();
// include_once('../api-firebase/send-email.php');
include('../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");

include_once('../includes/custom-functions.php');
$fn = new custom_functions;
include_once('../includes/functions.php');
$function = new functions;


// upload bulk product - upload products in bulk using  a CSV file
if (isset($_POST['bulk_upload']) && $_POST['bulk_upload'] == 1) {
    $count = 0;
    $count1 = 0;
    $error = false;
    $filename = $_FILES["upload_file"]["tmp_name"];
    $result = $fn->validate_image($_FILES["upload_file"], false);
    if (!$result) {
        $error = true;
    }
    $allowed_status = array("received", "processed", "shipped");
    if ($_FILES["upload_file"]["size"] > 0  && $error == false) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // print_r($emapData);
            if ($count1 != 0) {
                $emapData[0] = trim($db->escapeString($emapData[0]));
                $emapData[1] = trim($db->escapeString($emapData[1]));          
                $emapData[2] = trim($db->escapeString($emapData[2]));
                $emapData[3] = trim($db->escapeString($emapData[3]));
                $emapData[4] = trim($db->escapeString($emapData[4]));
                $emapData[5] = trim($db->escapeString($emapData[5]));
                $emapData[6] = trim($db->escapeString($emapData[6]));
                $emapData[7] = trim($db->escapeString($emapData[7]));
                $emapData[8] = trim($db->escapeString($emapData[8]));
                $emapData[9] = trim($db->escapeString($emapData[9]));
                $emapData[10] = trim($db->escapeString($emapData[10]));
                $emapData[11] = trim($db->escapeString($emapData[11]));
                $emapData[12] = trim($db->escapeString($emapData[12]));
                $emapData[13] = trim($db->escapeString($emapData[13]));
                $emapData[14] = trim($db->escapeString($emapData[14]));
                $emapData[15] = trim($db->escapeString($emapData[15]));
                $emapData[16] = trim($db->escapeString($emapData[16]));
                $emapData[17] = trim($db->escapeString($emapData[17]));
                $emapData[18] = trim($db->escapeString($emapData[18]));
                $emapData[19] = trim($db->escapeString($emapData[19]));
                $emapData[20] = trim($db->escapeString($emapData[20]));
                $emapData[21] = trim($db->escapeString($emapData[21]));          
                $emapData[22] = trim($db->escapeString($emapData[22]));
                $emapData[23] = trim($db->escapeString($emapData[23]));
                $emapData[24] = trim($db->escapeString($emapData[24]));
                $emapData[25] = trim($db->escapeString($emapData[25]));
                $emapData[26] = trim($db->escapeString($emapData[26]));
                $emapData[27] = trim($db->escapeString($emapData[27]));
                $emapData[28] = trim($db->escapeString($emapData[28]));
                $emapData[29] = trim($db->escapeString($emapData[29]));
                $emapData[30] = trim($db->escapeString($emapData[30]));
                $emapData[31] = trim($db->escapeString($emapData[31]));
                $emapData[32] = trim($db->escapeString($emapData[32]));
                $emapData[33] = trim($db->escapeString($emapData[33]));
                $emapData[34] = trim($db->escapeString($emapData[34]));
                $emapData[35] = trim($db->escapeString($emapData[35]));
                $emapData[36] = trim($db->escapeString($emapData[36]));
                $emapData[37] = trim($db->escapeString($emapData[37]));
                $emapData[38] = trim($db->escapeString($emapData[38]));
                $emapData[39] = trim($db->escapeString($emapData[39]));
                $emapData[40] = trim($db->escapeString($emapData[40]));
                $emapData[41] = trim($db->escapeString($emapData[41]));          
                $emapData[42] = trim($db->escapeString($emapData[42]));
                $emapData[43] = trim($db->escapeString($emapData[43]));
                $emapData[44] = trim($db->escapeString($emapData[44]));
                $emapData[45] = trim($db->escapeString($emapData[45]));
                $emapData[46] = trim($db->escapeString($emapData[46]));
                $emapData[47] = trim($db->escapeString($emapData[47]));
                $emapData[48] = trim($db->escapeString($emapData[48]));
                $emapData[49] = trim($db->escapeString($emapData[49]));
                $emapData[50] = trim($db->escapeString($emapData[50]));
                $emapData[51] = trim($db->escapeString($emapData[51]));          
                $emapData[52] = trim($db->escapeString($emapData[52]));
                $emapData[53] = trim($db->escapeString($emapData[53]));
                $emapData[54] = trim($db->escapeString($emapData[54]));
                $emapData[55] = trim($db->escapeString($emapData[55]));

                $data = array(
                    'batch'=>$emapData[0],
                    'degree'=>$emapData[1],
                    'department' => $emapData[2],
                    'section' => $emapData[3],
                    'roll_no' => $emapData[4],
                    'reg_no' => $emapData[5],
                    'name' => $emapData[6],
                    'quota' => $emapData[7],
                    'mode' => $emapData[8],
                    'gender' => $emapData[9],
                    'dob' => $emapData[10],
                    'religion' => $emapData[11],
                    'community' => $emapData[12],
                    'sub_caste' => $emapData[13],
                     'blood_group' => $emapData[14],
                     'mother_tongue' => $emapData[15],
                     'nationality' => $emapData[16],
                     'aadhaar_number' => $emapData[17],
                     'father_name' => $emapData[18],
                    'father_occupation' => $emapData[19],
                    'mother_name' => $emapData[20],
                    'mother_occupation' => $emapData[21],
                    'parent_income' => $emapData[22],
                    'address' => $emapData[23],
                    'district' => $emapData[24],
                    'mobile' => $emapData[25],
                    'parent_mobile' => $emapData[26],
                    'email' => $emapData[27],
                    'sslc_school' => $emapData[28],
                    'sslc_percentage' => $emapData[29],
                    'sslc_medium' => $emapData[30],
                    'sslc_board' => $emapData[31],
                     'sslc_year' => $emapData[32],
                     'group'=>$emapData[33],
                    'hsc_school' => $emapData[34],
                    'hsc_percentage' => $emapData[35],
                    'hsc_medium' => $emapData[36],
                    'hsc_board' => $emapData[37],
                    'hsc_year' => $emapData[38],
                    'maths' => $emapData[39],
                    'physics' => $emapData[40],
                    'chemistry' => $emapData[41],
                    'average' => $emapData[42],
                    'cut_off' => $emapData[43],
                    'total' => $emapData[44],
                    'type_of_stay' => $emapData[45],
                     'bus_route_no' => $emapData[46],
                    'boarding_point' => $emapData[47],
                    'reference' => $emapData[48],
                     'fg' => $emapData[49],
                    'pstm_sch' => $emapData[50],
                    'nsp' => $emapData[51],
                    'bc_mbc_sch' => $emapData[52],
                    'tnea_no' => $emapData[53],
                    'consortium_no' => $emapData[54],
                    'consortium_marks' => $emapData[55],
                                 
                );
                
                $sql = "SELECT * FROM `students` WHERE `reg_no` = '$emapData[5]'";
                $db->sql($sql);
                $res = $db->getResult();
                $num = $db->numRows($res);
                if ($num == 1){
                    // $sql = "UPDATE students SET batch='$emapData[0]',degree='$emapData[1]',department='$emapData[2]', 
                    // section='$emapData[3]',roll_no='$emapData[4]',name='$emapData[6]', quota='$emapData[7]', 
                    // mode='$emapData[8]',gender='$emapData[9]',dob='$emapData[10]',religion='$emapData[11]',community='$emapData[12]',
                    // sub_caste='$emapData[13]',blood_group='$emapData[14]',mother_tongue='$emapData[15]',
                    // nationality='$emapData[16]',aadhaar_number='$emapData[17]',father_name='$emapData[18]',
                    // father_occupation='$emapData[19]',mother_name='$emapData[20]',mother_occupation='$emapData[21]',
                    // parent_income='$emapData[22]',address='$emapData[23]',district='$emapData[24]',mobile='$emapData[25]',
                    // parent_mobile='$emapData[26]',email='$emapData[27]',sslc_school='$emapData[28]',sslc_percentage='$emapData[29]',
                    // sslc_medium='$emapData[30]',sslc_board='$emapData[31]',sslc_year='$emapData[32]',group='$emapData[33]',hsc_school='$emapData[34]',
                    // hsc_percentage='$emapData[35]',hsc_medium='$emapData[36]',hsc_board='$emapData[37]',hsc_year='$emapData[38]',
                    // maths='$emapData[39]',physics='$emapData[40]',chemistry='$emapData[41]',average='$emapData[42]',cut_off='$emapData[43]',
                    // total='$emapData[44]',type_of_stay='$emapData[45]',bus_route_no='$emapData[46]',boarding_point='$emapData[47]',
                    // reference='$emapData[48]',fg='$emapData[49]',pstm_sch='$emapData[50]',nsp='$emapData[51]',bc_mbc_sch='$emapData[52]',tnea_no='$emapData[53]',
                    // consortium_no='$emapData[54]',consortium_marks='$emapData[55]' WHERE reg_no='$emapData[5]'";
                    // $db->sql($sql);
                }
                else{
                    $db->insert('students', $data);
                }
                


            }

            $count1++;
        }
        fclose($file);
        echo "<p class='alert alert-success'>CSV file is successfully imported!</p><br>";
    } else {
        echo "<p class='alert alert-danger'>Invalid file format! Please upload data in CSV file!</p><br>";
    }
}

if (isset($_POST['upload_univexam']) && $_POST['upload_univexam'] == 1) {
    $count = 0;
    $count1 = 0;
    $error = false;
    $filename = $_FILES["upload_file"]["tmp_name"];
    $result = $fn->validate_image($_FILES["upload_file"], false);
    if (!$result) {
        $error = true;
    }
    if ($_FILES["upload_file"]["size"] > 0  && $error == false) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // print_r($emapData);
            if ($count1 != 0) {
                $emapData[0] = trim($db->escapeString($emapData[0]));
                $emapData[1] = trim($db->escapeString($emapData[1]));          
                $emapData[2] = trim($db->escapeString($emapData[2]));
                $emapData[3] = trim($db->escapeString($emapData[3]));
                $emapData[4] = trim($db->escapeString($emapData[4]));
                $emapData[5] = trim($db->escapeString($emapData[5]));
                
                $data = array(
                    'reg_no' => $emapData[0],
                    'department' => $emapData[1],
                    'semester' => $emapData[2],
                    'subject_code' => $emapData[3],
                    'regulation' => $emapData[4],
                    'grade' => $emapData[5],
                );
                $db->insert('universityresults', $data);

            }

            $count1++;
        }
        fclose($file);
        echo "<p class='alert alert-success'>CSV file is successfully imported!</p><br>";
    } else {
        echo "<p class='alert alert-danger'>Invalid file format! Please upload data in CSV file!</p><br>";
    }
}
if (isset($_POST['upload_internalform']) && $_POST['upload_internalform'] == 1) {
    $count = 0;
    $count1 = 0;
    $error = false;
    $filename = $_FILES["upload_file"]["tmp_name"];
    $result = $fn->validate_image($_FILES["upload_file"], false);
    if (!$result) {
        $error = true;
    }
    if ($_FILES["upload_file"]["size"] > 0  && $error == false) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // print_r($emapData);
            if ($count1 != 0) {
                $emapData[0] = trim($db->escapeString($emapData[0]));
                $emapData[1] = trim($db->escapeString($emapData[1]));          
                $emapData[2] = trim($db->escapeString($emapData[2]));
                $emapData[3] = trim($db->escapeString($emapData[3]));
                $emapData[4] = trim($db->escapeString($emapData[4]));
                $emapData[5] = trim($db->escapeString($emapData[5]));
                $emapData[6] = trim($db->escapeString($emapData[6]));
                $emapData[7] = trim($db->escapeString($emapData[7]));
                
                $data = array(
                    'reg_no' => $emapData[0],
                    'department' => $emapData[1],
                    'test_type' => $emapData[2],
                    'number' => $emapData[3],
                    'semester' => $emapData[4],
                    'subject_code' => $emapData[5],
                    'regulation' => $emapData[6],
                    'marks' => $emapData[7],
                );
                $db->insert('internalmarks', $data);

            }

            $count1++;
        }
        fclose($file);
        echo "<p class='alert alert-success'>CSV file is successfully imported!</p><br>";
    } else {
        echo "<p class='alert alert-danger'>Invalid file format! Please upload data in CSV file!</p><br>";
    }
}
if (isset($_POST['bulk_update']) && $_POST['bulk_update'] == 1) {
    $count = 0;
    $count1 = 0;
    $error = false;
    $filename = $_FILES["upload_file"]["tmp_name"];
    $result = $fn->validate_image($_FILES["upload_file"], false);
    if (!$result) {
        $error = true;
    }
    if ($_FILES["upload_file"]["size"] > 0  && $error == false) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // print_r($emapData);
            if ($count1 != 0) {
                $emapData[0] = trim($db->escapeString($emapData[0]));
                $emapData[1] = trim($db->escapeString($emapData[1]));          
                $emapData[2] = trim($db->escapeString($emapData[2]));
                $emapData[3] = trim($db->escapeString($emapData[3]));
                $emapData[4] = trim($db->escapeString($emapData[4]));
                $emapData[5] = trim($db->escapeString($emapData[5]));
                $emapData[6] = trim($db->escapeString($emapData[6]));
                $emapData[7] = trim($db->escapeString($emapData[7]));
                $emapData[8] = trim($db->escapeString($emapData[8]));
                $emapData[9] = trim($db->escapeString($emapData[9]));
                $emapData[10] = trim($db->escapeString($emapData[10]));
                $emapData[11] = trim($db->escapeString($emapData[11]));
                $emapData[12] = trim($db->escapeString($emapData[12]));
                $emapData[13] = trim($db->escapeString($emapData[13]));
                $emapData[14] = trim($db->escapeString($emapData[14]));
                $emapData[15] = trim($db->escapeString($emapData[15]));
                $emapData[16] = trim($db->escapeString($emapData[16]));
                $emapData[17] = trim($db->escapeString($emapData[17]));
                $emapData[18] = trim($db->escapeString($emapData[18]));
                $emapData[19] = trim($db->escapeString($emapData[19]));
                $emapData[20] = trim($db->escapeString($emapData[20]));
                $emapData[21] = trim($db->escapeString($emapData[21]));          
                $emapData[22] = trim($db->escapeString($emapData[22]));
                $emapData[23] = trim($db->escapeString($emapData[23]));
                $emapData[24] = trim($db->escapeString($emapData[24]));
                $emapData[25] = trim($db->escapeString($emapData[25]));
                $emapData[26] = trim($db->escapeString($emapData[26]));
                $emapData[27] = trim($db->escapeString($emapData[27]));
                $emapData[28] = trim($db->escapeString($emapData[28]));
                $emapData[29] = trim($db->escapeString($emapData[29]));
                $emapData[30] = trim($db->escapeString($emapData[30]));
                $emapData[31] = trim($db->escapeString($emapData[31]));
                $emapData[32] = trim($db->escapeString($emapData[32]));
                $emapData[33] = trim($db->escapeString($emapData[33]));
                $emapData[34] = trim($db->escapeString($emapData[34]));
                $emapData[35] = trim($db->escapeString($emapData[35]));
                $emapData[36] = trim($db->escapeString($emapData[36]));
                $emapData[37] = trim($db->escapeString($emapData[37]));
                $emapData[38] = trim($db->escapeString($emapData[38]));
                $emapData[39] = trim($db->escapeString($emapData[39]));
                $emapData[40] = trim($db->escapeString($emapData[40]));
                $emapData[41] = trim($db->escapeString($emapData[41]));          
                $emapData[42] = trim($db->escapeString($emapData[42]));
                $emapData[43] = trim($db->escapeString($emapData[43]));
                $emapData[44] = trim($db->escapeString($emapData[44]));
                $emapData[45] = trim($db->escapeString($emapData[45]));
                $emapData[46] = trim($db->escapeString($emapData[46]));
                $emapData[47] = trim($db->escapeString($emapData[47]));
                $emapData[48] = trim($db->escapeString($emapData[48]));
                $emapData[49] = trim($db->escapeString($emapData[49]));
                $emapData[50] = trim($db->escapeString($emapData[50]));
                $emapData[51] = trim($db->escapeString($emapData[51]));          
                $emapData[52] = trim($db->escapeString($emapData[52]));
                $emapData[53] = trim($db->escapeString($emapData[53]));
                $emapData[54] = trim($db->escapeString($emapData[54]));
                $emapData[55] = trim($db->escapeString($emapData[55]));

                $data = array(
                    'batch'=>$emapData[0],
                    'degree'=>$emapData[1],
                    'department' => $emapData[2],
                    'section' => $emapData[3],
                    'roll_no' => $emapData[4],
                    'reg_no' => $emapData[5],
                    'name' => $emapData[6],
                    'quota' => $emapData[7],
                    'mode' => $emapData[8],
                    'gender' => $emapData[9],
                    'dob' => $emapData[10],
                    'religion' => $emapData[11],
                    'community' => $emapData[12],
                    'sub_caste' => $emapData[13],
                     'blood_group' => $emapData[14],
                     'mother_tongue' => $emapData[15],
                     'nationality' => $emapData[16],
                     'aadhaar_number' => $emapData[17],
                     'father_name' => $emapData[18],
                    'father_occupation' => $emapData[19],
                    'mother_name' => $emapData[20],
                    'mother_occupation' => $emapData[21],
                    'parent_income' => $emapData[22],
                    'address' => $emapData[23],
                    'district' => $emapData[24],
                    'mobile' => $emapData[25],
                    'parent_mobile' => $emapData[26],
                    'email' => $emapData[27],
                    'sslc_school' => $emapData[28],
                    'sslc_percentage' => $emapData[29],
                    'sslc_medium' => $emapData[30],
                    'sslc_board' => $emapData[31],
                     'sslc_year' => $emapData[32],
                     'group'=>$emapData[33],
                    'hsc_school' => $emapData[34],
                    'hsc_percentage' => $emapData[35],
                    'hsc_medium' => $emapData[36],
                    'hsc_board' => $emapData[37],
                    'hsc_year' => $emapData[38],
                    'maths' => $emapData[39],
                    'physics' => $emapData[40],
                    'chemistry' => $emapData[41],
                    'average' => $emapData[42],
                    'cut_off' => $emapData[43],
                    'total' => $emapData[44],
                    'type_of_stay' => $emapData[45],
                     'bus_route_no' => $emapData[46],
                    'boarding_point' => $emapData[47],
                    'reference' => $emapData[48],
                     'fg' => $emapData[49],
                    'pstm_sch' => $emapData[50],
                    'nsp' => $emapData[51],
                    'bc_mbc_sch' => $emapData[52],
                    'tnea_no' => $emapData[53],
                    'consortium_no' => $emapData[54],
                    'consortium_marks' => $emapData[55],
                                 
                );
                $db->update('students', $data, 'reg_no=' . $emapData[5]);

            }

            $count1++;
        }
        fclose($file);
        echo "<p class='alert alert-success'>CSV file is successfully imported!</p><br>";
    } else {
        echo "<p class='alert alert-danger'>Invalid file format! Please upload data in CSV file!</p><br>";
    }
}
?>

