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
    $name = $db->escapeString($fn->xss_clean($_POST['name']));
    $roll_no = $db->escapeString($fn->xss_clean($_POST['roll_no']));
    $email = $db->escapeString($fn->xss_clean($_POST['email']));
    $dob = $db->escapeString($fn->xss_clean($_POST['dob']));
    $father_name = $db->escapeString($fn->xss_clean($_POST['father_name']));
    $mother_name= $db->escapeString($fn->xss_clean($_POST['mother_name']));
    $doorno = $db->escapeString($fn->xss_clean($_POST['doorno']));
    $street_name = $db->escapeString($fn->xss_clean($_POST['street_name']));
    $city_name = $db->escapeString($fn->xss_clean($_POST['city_name']));
    $district = $db->escapeString($fn->xss_clean($_POST['district']));
    $pin_code= $db->escapeString($fn->xss_clean($_POST['pin_code']));
    $aadhaar_number = $db->escapeString($fn->xss_clean($_POST['aadhaar_number']));
    $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
    $password = $db->escapeString($fn->xss_clean($_POST['password']));
    $department = $db->escapeString($fn->xss_clean($_POST['department']));
    $gender = $db->escapeString($fn->xss_clean($_POST['gender']));
    $community = $db->escapeString($fn->xss_clean($_POST['community']));
    $caste = $db->escapeString($fn->xss_clean($_POST['caste']));
    $internship = $db->escapeString($fn->xss_clean($_POST['internship']));
    $activities = $db->escapeString($fn->xss_clean($_POST['activities']));
    $sslc_percentage = $db->escapeString($fn->xss_clean($_POST['sslc_percentage']));
    $hsc_percentage = $db->escapeString($fn->xss_clean($_POST['hsc_percentage']));
    $ug_percentage = $db->escapeString($fn->xss_clean($_POST['ug_percentage']));
    
   
    if (empty($name)) {
        $error['name'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($roll_no)) {
        $error['roll_no'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($email)) {
        $error['email'] = " <span class='label label-danger'>Required!</span>";
    }


    if (!empty($name)&& !empty($roll_no) && !empty($email))
    {
        $sql = "UPDATE students SET name='$name',roll_no='$roll_no',email='$email',dob='$dob',father_name='$father_name',mother_name='$mother_name',doorno='$doorno',street_name='$street_name',city_name='$city_name',district='$district',pin_code='$pin_code',aadhaar_number='$aadhaar_number', mobile='$mobile',password='$password',department='$department',gender='$gender',community='$community',caste='$caste',email='$email',internship='$internship',activities='$activities',sslc_percentage='$sslc_percentage',hsc_percentage='$hsc_percentage',ug_percentage='$ug_percentage' WHERE id=$ID";
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
    <h1>Edit Student</h1>
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
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Student Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Student Roll No.</label> <i class="text-danger asterik">*</i><?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?>
                                    <input type="number" class="form-control" name="roll_no" value="<?php echo $data['roll_no']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                    <input type="email" class="form-control" name="email"value="<?php echo $data['email']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="number" class="form-control" name="mobile" value="<?php echo $data['mobile']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Password</label> <i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                                    <input type="text" class="form-control" name="password" value="<?php echo $data['password']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Select Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department"   class="form-control">
                                        <option value="">Select</option>
                                        <option  value="ECE" <?=$data['department'] == 'ECE' ? ' selected="selected"' : '';?> >ECE</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">DOB</label>
                                    <input type="date" class="form-control" name="dob" value="<?php echo $data['dob']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Father's Name</label>
                                    <input type="text" class="form-control" name="father_name" value="<?php echo $data['father_name']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mother's Name</label>
                                    <input type="text" class="form-control" name="mother_name"value="<?php echo $data['mother_name']?>">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Door No.</label>
                                    <input type="text" class="form-control" name="doorno" value="<?php echo $data['doorno']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Street Name</label>
                                    <input type="text" class="form-control" name="street_name" value="<?php echo $data['street_name']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Village/ City Name</label>
                                    <input type="text" class="form-control" name="city_name"value="<?php echo $data['city_name']?>">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">District</label>
                                    <input type="text" class="form-control" name="district" value="<?php echo $data['district']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1"> Pincode</label>
                                    <input type="text" class="form-control" name="pin_code" value="<?php echo $data['pin_code']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Aadhaar Number</label>
                                    <input type="text" class="form-control" name="aadhaar_number"value="<?php echo $data['aadhaar_number']?>">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC %</label>
                                    <input type="text" class="form-control" name="sslc_percentage" value="<?php echo $data['sslc_percentage']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC %</label>
                                    <input type="text" class="form-control" name="hsc_percentage" value="<?php echo $data['hsc_percentage']?>">
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">UG %</label>
                                    <input type="text" class="form-control" name="ug_percentage"value="<?php echo $data['ug_percentage']?>">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="">Select Community</label>
                                    <select id="community" name="community" class="form-control">
                                        <option value="MBC" <?=$data['community'] == 'MBC' ? ' selected="selected"' : '';?>>MBC</option>
                                        <option value="BC" <?=$data['community'] == 'BC' ? ' selected="selected"' : '';?>>BC</option>
                                        <option value="SC" <?=$data['community'] == 'SC' ? ' selected="selected"' : '';?>>SC</option>
                                        <option value="OC" <?=$data['community'] == 'OC' ? ' selected="selected"' : '';?>>OC</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Caste</label>
                                    <input type="text" class="form-control" name="caste" value="<?php echo $data['caste']?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Gender</label>
                                    <div class="form-group">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="M" <?=$data['gender'] == 'M' ? ' checked="checked"' : '';?> > Male
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="F" <?=$data['gender'] == 'F' ? ' checked="checked"' : '';?>> Female
                                        </label>

                                    </div>


                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="internship">Internship Details:</label>
                            <textarea name="internship" id="internship" class="form-control" rows="8"><?php echo $res[0]['internship']; ?></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="activities">Activities Details:</label>
                            <textarea name="activities" id="activities" class="form-control" rows="8"><?php echo $res[0]['activities']; ?></textarea>
                        </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
                        <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" />
                        <!--<div  id="res"></div>-->
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
    $('#edit_student_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            roll_no: "required",
            email: "required",
            mobile: "required",
            password: "required",

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>