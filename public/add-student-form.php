<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

$sql_query = "SELECT id, name FROM category ORDER BY id ASC";
$db->sql($sql_query);

$res = $db->getResult();
$sql_query = "SELECT value FROM settings WHERE variable = 'Currency'";
$pincode_ids_exc = "";
$db->sql($sql_query);

$res_cur = $db->getResult();
if (isset($_POST['btnAdd'])) {
        $error = array();
        $name = $db->escapeString($fn->xss_clean($_POST['name']));
        $roll_no = $db->escapeString($fn->xss_clean($_POST['roll_no']));
        $email = $db->escapeString($fn->xss_clean($_POST['email']));
        $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
        $password = $db->escapeString($fn->xss_clean($_POST['password']));
        $department = $db->escapeString($fn->xss_clean($_POST['department']));
        $gender = $db->escapeString($fn->xss_clean($_POST['gender']));
        $community = $db->escapeString($fn->xss_clean($_POST['community']));
        $caste = $db->escapeString($fn->xss_clean($_POST['caste']));
        
       
        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($roll_no)) {
            $error['roll_no'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($email)) {
            $error['email'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($mobile)) {
            $error['mobile'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($password)) {
            $error['password'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($gender)) {
            $error['gender'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($community)) {
            $error['community'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($caste)) {
            $error['caste'] = " <span class='label label-danger'>Required!</span>";
        }

        if (!empty($name) && !empty($roll_no) && !empty($mobile) && !empty($password) && !empty($department) && !empty($gender) && !empty($community) && !empty($caste))
        {
            $sql = "INSERT INTO students (name,roll_no,mobile,password,department,gender,community) VALUES('$name','$roll_no','$mobile','$password','$department','$gender','$community')";
            $db->sql($sql);
            $student_result = $db->getResult();
            if (!empty($student_result)) {
                $student_result = 0;
            } else {
                $student_result = 1;
            }
            if ($student_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Student Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
?>
<section class="content-header">
    <h1>Add Student</h1>
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
                    <h3 class="box-title">Add Student</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_student_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Student Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Student Roll No.</label> <i class="text-danger asterik">*</i><?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?>
                                    <input type="number" class="form-control" name="roll_no" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="number" class="form-control" name="mobile" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Password</label> <i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Select Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select</option>
                                        <option value="ECE">ECE</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                            <label class="control-label">Gender</label>
                                <div class="form-group">
                                    
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="M"> Male
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="F"> Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="">Select Community</label> <i class="text-danger asterik">*</i> <?php echo isset($error['community']) ? $error['community'] : ''; ?><br>
                                    <select id="community" name="community" class="form-control">
                                        <option value="MBC">MBC</option>
                                        <option value="BC">BC</option>
                                        <option value="SC">SC</option>
                                        <option value="OC">OC</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Caste</label> <i class="text-danger asterik">*</i><?php echo isset($error['caste']) ? $error['caste'] : ''; ?>
                                    <input type="text" class="form-control" name="caste" required>
                                </div>

                            </div>

                        </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
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
    $('#add_student_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            roll_no: "required",
            email: "required",
            mobile: "required",
            password: "required",
            department: "required",
            gender: "required",
            caste: "required",

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>