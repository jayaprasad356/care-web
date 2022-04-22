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
        $roll_no = $db->escapeString($fn->xss_clean($_POST['roll_no']));
        $semester = $db->escapeString($fn->xss_clean($_POST['semester']));
        $department = $db->escapeString($fn->xss_clean($_POST['department']));
        $subject_code = $db->escapeString($fn->xss_clean($_POST['subject_code']));
        $regulation = $db->escapeString($fn->xss_clean($_POST['regulation']));
        $grade = $db->escapeString($fn->xss_clean($_POST['grade']));
        
        if (empty($roll_no)) {
            $error['roll_no'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($semester)) {
            $error['semester'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($subject_code)) {
            $error['subject_code'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($regulation)) {
            $error['regulation'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($grade)) {
            $error['grade'] = " <span class='label label-danger'>Required!</span>";
        }

        if ( !empty($roll_no) && !empty($semester)&& !empty($department) && !empty($subject_code) && !empty($regulation) && !empty($grade))
        {
            $sql = "INSERT INTO universityresults (roll_no,semester,department,subject_code,regulation,grade) VALUES('$roll_no','$semester','$department','$subject_code','$regulation','$grade')";
            $db->sql($sql);
            $universityresults_result = $db->getResult();
            if (!empty($universityresults_result)) {
                $universityresults_result = 0;
            } else {
                $universityresults_result = 1;
            }
            if ($universityresults_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>University Results Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
?>
<section class="content-header">
    <h1>Add University Result</h1>
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
                    <h3 class="box-title">Add University Result</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_company_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="">Roll.No</label> <i class="text-danger asterik">*</i> <?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?><br>
                                    <select id="roll_no" name="roll_no" class="form-control">
                                        <option value="">All</option>
                                        <option value="810718106001">810718106001</option>
                                        <option value="810718106002">810718106002</option>
                                        <option value="810718106003">810718106003</option>
                                    </select>
                            </div>
                            <div class='col-md-4'>
                                <label for="">Semester</label> <i class="text-danger asterik">*</i> <?php echo isset($error['semester']) ? $error['semester'] : ''; ?><br>
                                    <select id="semester" name="semester" class="form-control">
                                        <option value="">All</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                            </div>
                            <div class='col-md-4'>
                                <label for="">Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="select">SELECT</option>
                                        <option value="ECE">ECE</option>
                                        <option value="CSE">CSE</option>
                                        <option value="CIVIL">CIVIL</option>
                                        <option value="MECH">MECH</option>
                                    </select>
                            </div>
                        </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                        <label for="">Subject Code</label> <i class="text-danger asterik">*</i> <?php echo isset($error['subject_code']) ? $error['subject_code'] : ''; ?><br>
                                                <select id="subject_code" name="subject_code" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="CS8067">CS8067</option>
                                                    <option value="EC8654">EC8654</option>
                                                    <option value="ME7654">ME7654</option>
                                                    <option value="EC8907">EC8907</option>
                                                </select>
                                </div>
                                <div class='col-md-4'>
                                        <label for="">Regulation</label> <i class="text-danger asterik">*</i> <?php echo isset($error['regulation']) ? $error['regulation'] : ''; ?><br>
                                                        <select id="regulation" name="regulation" class="form-control">
                                                            <option value="">All</option>
                                                            <option value="R2013">R2013</option>
                                                            <option value="R2017">R2017</option>
                                                            <option value="R2022">R2022</option>
                                                        </select>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="">Grade</label> <i class="text-danger asterik">*</i> <?php echo isset($error['grade']) ? $error['grade'] : ''; ?><br>
                                                                <select id="grade" name="grade" class="form-control">
                                                                    <option value="select">select</option>
                                                                    <option value="O">O</option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B">B</option>
                                                                    <option value="RA">RA</option>
                                                                </select>
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
    $('#add_universityresluts_form').validate({

        ignore: [],
        debug: false,
        rules: {
           roll_no: "required",
            semester: "required",
            department:"required",
            subject_code: "required",
            regulation: "required",
           grade: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>