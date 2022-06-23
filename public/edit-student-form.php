<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_GET['id'])) {
    $ID = $db->escapeString($fn->xss_clean($_GET['id']));
} else {
    // $ID = "";
    return false;
    exit(0);
}

if (isset($_POST['btnUpdate'])){
    $error = array();
    $batch = $db->escapeString($fn->xss_clean($_POST['batch']));
    $degree = $db->escapeString($fn->xss_clean($_POST['degree']));
    $department = $db->escapeString($fn->xss_clean($_POST['department']));
    $section = $db->escapeString($fn->xss_clean($_POST['section']));
    $roll_no= $db->escapeString($fn->xss_clean($_POST['roll_no']));
    $register_number = $db->escapeString($fn->xss_clean($_POST['register_number']));
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $quota = $db->escapeString($fn->xss_clean($_POST['quota']));
    $mode = $db->escapeString($fn->xss_clean($_POST['mode']));
    $gender= $db->escapeString($fn->xss_clean($_POST['gender']));
    $dob = $db->escapeString($fn->xss_clean($_POST['dob']));
    $religion = $db->escapeString($fn->xss_clean($_POST['religion']));
    $community = $db->escapeString($fn->xss_clean($_POST['community']));
    $sub_caste = $db->escapeString($fn->xss_clean($_POST['sub_caste']));
    $blood_group = $db->escapeString($fn->xss_clean($_POST['blood_group']));
    $mother_tongue = $db->escapeString($fn->xss_clean($_POST['mother_tongue']));
    $nationality = $db->escapeString($fn->xss_clean($_POST['nationality']));
    $aadhaar_number = $db->escapeString($fn->xss_clean($_POST['aadhaar_number']));
    $father_name = $db->escapeString($fn->xss_clean($_POST['father_name']));
    $father_occupation = $db->escapeString($fn->xss_clean($_POST['father_occupation']));
    $mother_name = $db->escapeString($fn->xss_clean($_POST['mother_name']));
    $mother_occupation = $db->escapeString($fn->xss_clean($_POST['mother_occupation']));
    $parent_income = $db->escapeString($fn->xss_clean($_POST['parent_income']));
    $address= $db->escapeString($fn->xss_clean($_POST['address']));
    $district = $db->escapeString($fn->xss_clean($_POST['district']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $parent_mobile = $db->escapeString($fn->xss_clean($_POST['parent_mobile']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $sslc_school= $db->escapeString($fn->xss_clean($_POST['sslc_school']));
    $sslc_percentage = $db->escapeString($fn->xss_clean($_POST['sslc_percentage']));
    $sslc_medium = $db->escapeString($fn->xss_clean($_POST['sslc_medium']));
    $sslc_board = $db->escapeString($fn->xss_clean($_POST['sslc_board']));
    $sslc_year = $db->escapeString($fn->xss_clean($_POST['sslc_year']));
   
    $hsc_school = $db->escapeString($fn->xss_clean($_POST['hsc_school']));
    $hsc_percentage = $db->escapeString($fn->xss_clean($_POST['hsc_percentage']));
    $hsc_medium = $db->escapeString($fn->xss_clean($_POST['hsc_medium']));
    $hsc_board = $db->escapeString($fn->xss_clean($_POST['hsc_board']));
    $hsc_year = $db->escapeString($fn->xss_clean($_POST['hsc_year']));
    $maths = $db->escapeString($fn->xss_clean($_POST['maths']));
    $physics = $db->escapeString($fn->xss_clean($_POST['physics']));
    $chemistry = $db->escapeString($fn->xss_clean($_POST['chemistry']));
    $average= $db->escapeString($fn->xss_clean($_POST['average']));
    $cut_off = $db->escapeString($fn->xss_clean($_POST['cut_off']));
    $total = $db->escapeString($fn->xss_clean($_POST['total']));
    $type_of_stay = $db->escapeString($fn->xss_clean($_POST['type_of_stay']));
    $bus_route_no = $db->escapeString($fn->xss_clean($_POST['bus_route_no']));
    $boarding_point= $db->escapeString($fn->xss_clean($_POST['boarding_point']));
    $reference = $db->escapeString($fn->xss_clean($_POST['reference']));
    $fg = $db->escapeString($fn->xss_clean($_POST['fg']));
    $pstm_sch = $db->escapeString($fn->xss_clean($_POST['pstm_sch']));
    $nsp = $db->escapeString($fn->xss_clean($_POST['nsp']));
    $bc_mbc_sch = $db->escapeString($fn->xss_clean($_POST['bc_mbc_sch']));
    $tnea_no = $db->escapeString($fn->xss_clean($_POST['tnea_no']));
    $consortium_no = $db->escapeString($fn->xss_clean($_POST['consortium_no']));
    $consortium_marks = $db->escapeString($fn->xss_clean($_POST['consortium_marks']));
    $image_error = $db->escapeString($_FILES['profile']['error']);
    
    
    if (empty($batch)) {
        $error['batch'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($degree)) {
        $error['degree'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($department)) {
        $error['department'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($section)) {
        $error['section'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($roll_no)) {
        $error['roll_no'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($register_number)) {
        $error['register_number'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($name)) {
        $error['name'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($quota)) {
        $error['quota'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($mode)) {
        $error['mode'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($gender)) {
        $error['gender'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($dob)) {
        $error['dob'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($religion)) {
        $error['religion'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($community)) {
        $error['community'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sub_caste)) {
        $error['sub_caste'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($blood_group)) {
        $error['blood_group'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($mother_tongue)) {
        $error['mother_tongue'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($nationality)) {
        $error['nationality'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($aadhaar_number)) {
        $error['aadhaar_number'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($father_name)) {
        $error['father_name'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($father_occupation)) {
        $error['father_occupation'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($mother_name)) {
        $error['mother_name'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($mother_occupation)) {
        $error['mother_occupation'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($parent_income)) {
        $error['parent_income'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($address)) {
        $error['address'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($district)) {
        $error['district'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($mobile)) {
        $error['mobile'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($parent_mobile)) {
        $error['parent_mobile'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($email)) {
        $error['email'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sslc_school)) {
        $error['sslc_school'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sslc_percentage)) {
        $error['sslc_percentage'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sslc_medium)) {
        $error['sslc_medium'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sslc_board)) {
        $error['sslc_board'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($sslc_year)) {
        $error['sslc_year'] = " <span class='label label-danger'>Required!</span>";
    }
    
    if (empty($hsc_school)) {
        $error['hsc_school'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($hsc_percentage)) {
        $error['hsc_percentage'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($hsc_medium)) {
        $error['hsc_medium'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($hsc_board)) {
        $error['hsc_board'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($hsc_year)) {
        $error['hsc_year'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($maths)) {
        $error['maths'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($physics)) {
        $error['physics'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($chemistry)) {
        $error['chemistry'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($average)) {
        $error['average'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($cut_off)) {
        $error['cut_off'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($total)) {
        $error['total'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($type_of_stay)) {
        $error['type_of_stay'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($bus_route_no)) {
        $error['bus_route_no'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($boarding_point)) {
        $error['boarding_point'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($reference)) {
        $error['reference'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($fg)) {
        $error['fg'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($pstm_sch)) {
        $error['pstm_sch'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($nsp)) {
        $error['nsp'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($bc_mbc_sch)) {
        $error['bc_mbc_sch'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($tnea_no)) {
        $error['tnea_no'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($consortium_no)) {
        $error['consortium_no'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($consortium_marks)) {
        $error['consortium_marks'] = " <span class='label label-danger'>Required!</span>";
    }
    if ($image_error > 0) {
        $error['profile'] = " <span class='label label-danger'>Required!</span>";

    }
   


    if (!empty($batch) && !empty($degree) && !empty($department) && !empty($section) && !empty($roll_no) && !empty($register_number) && !empty($name) && !empty($quota) && !empty($mode) && !empty($gender) && !empty($dob) && !empty($religion) && !empty($community) && !empty($sub_caste) && !empty($blood_group) && !empty($mother_tongue) && !empty($nationality) && !empty($aadhaar_number) && !empty($father_name) && !empty($father_occupation) && !empty($mother_name) && !empty($mother_occupation) && !empty($parent_income) && !empty($address) && !empty($district) && !empty($mobile) && !empty($parent_mobile) && !empty($email) && !empty($sslc_school) && !empty($sslc_percentage) && !empty($sslc_medium) && !empty($sslc_board) && !empty($sslc_year) && !empty($hsc_school) && !empty($hsc_percentage) && !empty($hsc_medium) && !empty($hsc_board) && !empty($hsc_year) && !empty($maths) && !empty($physics) && !empty($chemistry) && !empty($average) && !empty($cut_off) && !empty($total) && !empty($type_of_stay) && !empty($bus_route_no) && !empty($boarding_point) && !empty($reference) && !empty($fg) && !empty($pstm_sch) && !empty($nsp) && !empty($bc_mbc_sch) && !empty($tnea_no) && !empty($consortium_no) && !empty($consortium_marks)) {
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["profile"]["name"]));
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['profile']['name']);
        $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;
        // upload new image
        $upload = move_uploaded_file($_FILES['profile']['tmp_name'], 'upload/profile/' . $menu_image);

        // insert new data to menu table
        $upload_image = 'upload/profile/' . $menu_image;

        $sql = "UPDATE students SET batch='$batch',degree='$degree',department='$department', section='$section',roll_no='$roll_no',register_number='$register_number',name='$name', quota='$quota', mode='$mode',gender='$gender',dob='$dob',religion='$religion',community='$community',sub_caste='$sub_caste',blood_group='$blood_group',mother_tongue='$mother_tongue',nationality='$nationality',aadhaar_number='$aadhaar_number',father_name='$father_name',father_occupation='$father_occupation',mother_name='$mother_name',mother_occupation='$mother_occupation',parent_income='$parent_income',address='$address',district='$district',mobile='$mobile',parent_mobile='$parent_mobile',email='$email',sslc_school='$sslc_school',sslc_percentage='$sslc_percentage',sslc_medium='$sslc_medium',sslc_board='$sslc_board',sslc_year='$sslc_year',hsc_school='$hsc_school',hsc_percentage='$hsc_percentage',hsc_medium='$hsc_medium',hsc_board='$hsc_board',hsc_year='$hsc_year',maths='$maths',physics='$physics',chemistry='$chemistry',average='$average',cut_off='$cut_off',total='$total',type_of_stay='$type_of_stay',bus_route_no='$bus_route_no',boarding_point='$boarding_point',reference='$reference',fg='$fg',pstm_sch='$pstm_sch',nsp='$nsp',bc_mbc_sch='$bc_mbc_sch',tnea_no='$tnea_no',consortium_no='$consortium_no',consortium_marks='$consortium_marks',profile='$upload_image' WHERE id='$ID'";
        $db->sql($sql);
        $student_result = $db->getResult();
        if (!empty($student_result)) {
            $student_result = 0;
        } else {
            $student_result = 1;
        }
        if ($student_result == 1) {
            $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>Student details Updated Successfully</span>
                                            <h4><small><a  href='students.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Students</a></small></h4>
                                             </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

    }
}
$data = array();
$sql = "SELECT * FROM students WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
foreach ($res as $row)
    $data = $row;
?>
<section class="content-header">
    <h1>Student Details</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Student</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='edit_student_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Profile</label>
                                        
                                        <input type="file" accept="image/png,  image/jpeg" onchange="readURL(this);"  name="profile" id="profile">
                                        <p class="help-block"><img id="blah" src="<?php echo DOMAIN_URL . $res[0]['profile']; ?>" style="max-width:100%" /></p>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Batch</label> <i class="text-danger asterik">*</i><?php echo isset($error['batch']) ? $error['batch'] : ''; ?>
                                    <input type="text" class="form-control" name="batch" value="<?php echo $data['batch']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Degree</label> <i class="text-danger asterik">*</i><?php echo isset($error['degree']) ? $error['degree'] : ''; ?>
                                    <input type="text" class="form-control" name="degree" value="<?php echo $data['degree']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Department</label> <i class="text-danger asterik">*</i><?php echo isset($error['department']) ? $error['department'] : ''; ?>
                                    <input type="text" class="form-control" name="department" value="<?php echo $data['department']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Section</label> <i class="text-danger asterik">*</i><?php echo isset($error['section']) ? $error['section'] : ''; ?>
                                    <input type="text" class="form-control" name="section" value="<?php echo $data['section']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Roll Number</label> <i class="text-danger asterik">*</i><?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?>
                                    <input type="text" class="form-control" name="roll_no" value="<?php echo $data['roll_no']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Register Number</label> <i class="text-danger asterik">*</i><?php echo isset($error['register_number']) ? $error['register_number'] : ''; ?>
                                    <input type="text" class="form-control" name="register_number" value="<?php echo $data['register_number']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Quota</label> <i class="text-danger asterik">*</i><?php echo isset($error['quota']) ? $error['quota'] : ''; ?>
                                    <input type="text" class="form-control" name="quota" value="<?php echo $data['quota']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mode</label> <i class="text-danger asterik">*</i><?php echo isset($error['mode']) ? $error['mode'] : ''; ?>
                                    <input type="text" class="form-control" name="mode" value="<?php echo $data['mode']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Gender</label> <i class="text-danger asterik">*</i><?php echo isset($error['gender']) ? $error['gender'] : ''; ?>
                                    <input type="text" class="form-control" name="gender" value="<?php echo $data['gender']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">DOB</label> <i class="text-danger asterik">*</i><?php echo isset($error['dob']) ? $error['dob'] : ''; ?>
                                    <input type="text" class="form-control" name="dob" value="<?php echo $data['dob']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Religion</label> <i class="text-danger asterik">*</i><?php echo isset($error['religion']) ? $error['religion'] : ''; ?>
                                    <input type="text" class="form-control" name="religion" value="<?php echo $data['religion']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Community</label> <i class="text-danger asterik">*</i><?php echo isset($error['community']) ? $error['community'] : ''; ?>
                                    <input type="text" class="form-control" name="community" value="<?php echo $data['community']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Sub Caste</label> <i class="text-danger asterik">*</i><?php echo isset($error['sub_caste']) ? $error['sub_caste'] : ''; ?>
                                    <input type="text" class="form-control" name="sub_caste" value="<?php echo $data['sub_caste']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Blood Group</label> <i class="text-danger asterik">*</i><?php echo isset($error['blood_group']) ? $error['blood_group'] : ''; ?>
                                    <input type="text" class="form-control" name="blood_group" value="<?php echo $data['blood_group']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                           <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mother Tongue</label> <i class="text-danger asterik">*</i><?php echo isset($error['mother_tongue']) ? $error['mother_tongue'] : ''; ?>
                                    <input type="text" class="form-control" name="mother_tongue" value="<?php echo $data['mother_tongue']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Nationality</label> <i class="text-danger asterik">*</i><?php echo isset($error['nationality']) ? $error['nationality'] : ''; ?>
                                    <input type="text" class="form-control" name="nationality" value="<?php echo $data['nationality']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Aadhaar Number</label> <i class="text-danger asterik">*</i><?php echo isset($error['aadhaar_number']) ? $error['aadhaar_number'] : ''; ?>
                                    <input type="text" class="form-control" name="aadhaar_number" value="<?php echo $data['aadhaar_number']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Father Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['father_name']) ? $error['father_name'] : ''; ?>
                                    <input type="text" class="form-control" name="father_name" value="<?php echo $data['father_name']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Father's Occupation</label> <i class="text-danger asterik">*</i><?php echo isset($error['father_occupation']) ? $error['father_occupation'] : ''; ?>
                                    <input type="text" class="form-control" name="father_occupation" value="<?php echo $data['father_occupation']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mother Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['mother_name']) ? $error['mother_name'] : ''; ?>
                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $data['mother_name']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mother's Occupation</label> <i class="text-danger asterik">*</i><?php echo isset($error['mother_occupation']) ? $error['mother_occupation'] : ''; ?>
                                    <input type="text" class="form-control" name="mother_occupation" value="<?php echo $data['mother_occupation']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Parent's Income</label> <i class="text-danger asterik">*</i><?php echo isset($error['parent_income']) ? $error['parent_income'] : ''; ?>
                                    <input type="text" class="form-control" name="parent_income" value="<?php echo $data['parent_income']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Addrees</label> <i class="text-danger asterik">*</i><?php echo isset($error['address']) ? $error['address'] : ''; ?>
                                    <input type="text" class="form-control" name="address" value="<?php echo $data['address']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">District</label> <i class="text-danger asterik">*</i><?php echo isset($error['district']) ? $error['district'] : ''; ?>
                                    <input type="text" class="form-control" name="district" value="<?php echo $data['district']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="text" class="form-control" name="mobile" value="<?php echo $data['mobile']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Parent Contact.No</label> <i class="text-danger asterik">*</i><?php echo isset($error['parent_mobile']) ? $error['parent_mobile'] : ''; ?>
                                    <input type="text" class="form-control" name="parent_mobile" value="<?php echo $data['parent_mobile']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                    <input type="email" class="form-control" name="email" value="<?php echo $data['email']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC-School</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_school']) ? $error['sslc_school'] : ''; ?>
                                    <input type="text" class="form-control" name="sslc_school" value="<?php echo $data['sslc_school']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC-Percentage</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_percentage']) ? $error['sslc_percentage'] : ''; ?>
                                    <input type="text" class="form-control" name="sslc_percentage" value="<?php echo $data['sslc_percentage']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC-Medium</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_medium']) ? $error['sslc_medium'] : ''; ?>
                                    <input type="text" class="form-control" name="sslc_medium" value="<?php echo $data['sslc_medium']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC-Board</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_board']) ? $error['sslc_board'] : ''; ?>
                                    <input type="text" class="form-control" name="sslc_board" value="<?php echo $data['sslc_board']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC-Year</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_year']) ? $error['sslc_year'] : ''; ?>
                                    <input type="text" class="form-control" name="sslc_year" value="<?php echo $data['sslc_year']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                               
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC-School</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_school']) ? $error['hsc_school'] : ''; ?>
                                    <input type="text" class="form-control" name="hsc_school" value="<?php echo $data['hsc_school']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC-Percentage</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_percentage']) ? $error['hsc_percentage'] : ''; ?>
                                    <input type="text" class="form-control" name="hsc_percentage" value="<?php echo $data['hsc_percentage']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC-Medium</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_medium']) ? $error['hsc_medium'] : ''; ?>
                                    <input type="text" class="form-control" name="hsc_medium" value="<?php echo $data['hsc_medium']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC-Board</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_board']) ? $error['hsc_board'] : ''; ?>
                                    <input type="text" class="form-control" name="hsc_board" value="<?php echo $data['hsc_board']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC-Year</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_year']) ? $error['hsc_year'] : ''; ?>
                                    <input type="text" class="form-control" name="hsc_year" value="<?php echo $data['hsc_year']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Maths</label> <i class="text-danger asterik">*</i><?php echo isset($error['maths']) ? $error['maths'] : ''; ?>
                                    <input type="text" class="form-control" name="maths" value="<?php echo $data['maths']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Physics</label> <i class="text-danger asterik">*</i><?php echo isset($error['physics']) ? $error['physics'] : ''; ?>
                                    <input type="text" class="form-control" name="physics" value="<?php echo $data['physics']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Chemistry</label> <i class="text-danger asterik">*</i><?php echo isset($error['chemistry']) ? $error['chemistry'] : ''; ?>
                                    <input type="text" class="form-control" name="chemistry" value="<?php echo $data['chemistry']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Average</label> <i class="text-danger asterik">*</i><?php echo isset($error['average']) ? $error['average'] : ''; ?>
                                    <input type="text" class="form-control" name="average" value="<?php echo $data['average']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Cut Off</label> <i class="text-danger asterik">*</i><?php echo isset($error['cut_off']) ? $error['cut_off'] : ''; ?>
                                    <input type="text" class="form-control" name="cut_off" value="<?php echo $data['cut_off']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Total</label> <i class="text-danger asterik">*</i><?php echo isset($error['total']) ? $error['total'] : ''; ?>
                                    <input type="text" class="form-control" name="total" value="<?php echo $data['total']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Hosteler/Dayscholar</label> <i class="text-danger asterik">*</i><?php echo isset($error['type_of_stay']) ? $error['type_of_stay'] : ''; ?>
                                    <input type="text" class="form-control" name="type_of_stay" value="<?php echo $data['type_of_stay']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Bus Route No</label> <i class="text-danger asterik">*</i><?php echo isset($error['bus_route_no']) ? $error['bus_route_no'] : ''; ?>
                                    <input type="text" class="form-control" name="bus_route_no" value="<?php echo $data['bus_route_no']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Boarding Point</label> <i class="text-danger asterik">*</i><?php echo isset($error['boarding_point']) ? $error['boarding_point'] : ''; ?>
                                    <input type="text" class="form-control" name="boarding_point" value="<?php echo $data['boarding_point']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Reference</label> <i class="text-danger asterik">*</i><?php echo isset($error['reference']) ? $error['reference'] : ''; ?>
                                    <input type="text" class="form-control" name="reference" value="<?php echo $data['reference']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">First Graduate</label> <i class="text-danger asterik">*</i><?php echo isset($error['fg']) ? $error['fg'] : ''; ?>
                                    <input type="text" class="form-control" name="fg" value="<?php echo $data['fg']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">PSTM-Scholarship</label> <i class="text-danger asterik">*</i><?php echo isset($error['pstm_sch']) ? $error['pstm_sch'] : ''; ?>
                                    <input type="text" class="form-control" name="pstm_sch" value="<?php echo $data['pstm_sch']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">NSP</label> <i class="text-danger asterik">*</i><?php echo isset($error['nsp']) ? $error['nsp'] : ''; ?>
                                    <input type="text" class="form-control" name="nsp" value="<?php echo $data['nsp']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">BC&MBC-Scholarship</label> <i class="text-danger asterik">*</i><?php echo isset($error['bc_mbc_sch']) ? $error['bc_mbc_sch'] : ''; ?>
                                    <input type="text" class="form-control" name="bc_mbc_sch" value="<?php echo $data['bc_mbc_sch']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">TNEA Allotment Number</label> <i class="text-danger asterik">*</i><?php echo isset($error['tnea_no']) ? $error['tnea_no'] : ''; ?>
                                    <input type="text" class="form-control" name="tnea_no" value="<?php echo $data['tnea_no']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Consortium No.</label> <i class="text-danger asterik">*</i><?php echo isset($error['consortium_no']) ? $error['consortium_no'] : ''; ?>
                                    <input type="text" class="form-control" name="consortium_no" value="<?php echo $data['consortium_no']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Consortium Marks</label> <i class="text-danger asterik">*</i><?php echo isset($error['consortium_marks']) ? $error['consortium_marks'] : ''; ?>
                                    <input type="text" class="form-control" name="consortium_marks" value="<?php echo $data['consortium_marks']?>" required>
                                </div>
                            </div>
                        </div>
                        <hr>


                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
                
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<?php $db->disconnect(); ?>

