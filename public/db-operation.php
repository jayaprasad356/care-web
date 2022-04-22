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
                $data = array(
                    'roll_no' => $emapData[0],
                    'name' => $emapData[1],
                    'email' => $emapData[2],
                    'dob' => $emapData[3],
                    'father_name' => $emapData[4],
                    'mother_name' => $emapData[5],
                    'doorno' => $emapData[6],
                    'street_name' => $emapData[7],
                    'city_name' => $emapData[8],
                    'district' => $emapData[9],
                    'pin_code' => $emapData[10],
                    'aadhaar_number' => $emapData[11],
                    'mobile' => $emapData[12],
                    'password' => $emapData[13],
                    'department' => $emapData[14],
                    'batch' => $emapData[15],
                    'gender' => $emapData[16],
                    'community' => $emapData[17],
                    'caste' => $emapData[18],
                    'internship' => $emapData[19],
                    'activities' => $emapData[20],
                );
                $db->insert('students', $data);

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

