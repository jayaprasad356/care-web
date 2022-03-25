<?php
session_start();
// include_once('../api-firebase/send-email.php');
include('../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
$auth_username = $db->escapeString($_SESSION["user"]);

include_once('../includes/custom-functions.php');
$fn = new custom_functions;
include_once('../includes/functions.php');
$function = new functions;
function checkadmin($auth_username)
{
    $db = new Database();
    $db->connect();
    $db->sql("SELECT `username` FROM `admin` WHERE `username`='$auth_username' LIMIT 1");
    $res = $db->getResult();
    if (!empty($res)) {

        return true;
    } else {
        return false;
    }
}


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
                $emapData[0] = trim($db->escapeString($emapData[0])); // roll_no
                $emapData[1] = trim($db->escapeString($emapData[1])); // name                
                $emapData[2] = trim($db->escapeString($emapData[2])); // email
                $emapData[3] = trim($db->escapeString($emapData[3])); // mobile
                $emapData[4] = trim($db->escapeString($emapData[4])); // password
                $emapData[5] = trim($db->escapeString($emapData[5])); // department
                $emapData[6] = trim($db->escapeString($emapData[6])); // batch
                $emapData[7] = trim($db->escapeString($emapData[7])); // course
                $emapData[8] = trim($db->escapeString($emapData[8])); // profile
                $emapData[9] = trim($db->escapeString($emapData[9])); // gender
                $emapData[10] = trim($db->escapeString($emapData[10])); // community
                $emapData[11] = trim($db->escapeString($emapData[11])); // caste
                $emapData[12] = trim($db->escapeString($emapData[12])); // address
                $emapData[13] = trim($db->escapeString($emapData[13])); // place
                $data = array(
                    'roll_no' => $emapData[0],
                    'name' => $emapData[1],
                    'email' => $emapData[2],
                    'mobile' => $emapData[3],
                    'password' => $emapData[4],
                    'department' => $emapData[5],
                    'batch' => $emapData[6],
                    'course' => $emapData[7],
                    'profile' => $emapData[8],
                    'gender' => $emapData[9],
                    'community' => $emapData[10],
                    'caste' => $emapData[11],
                    'address' => $emapData[12],
                    'place' => $emapData[13],
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

