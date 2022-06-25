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

if (isset($_POST['btnUpdate'])) {
    $error = array();
    $reg_no = $db->escapeString($fn->xss_clean($_POST['reg_no']));
    $semester = $db->escapeString($fn->xss_clean($_POST['semester']));
    $department = $db->escapeString($fn->xss_clean($_POST['department']));
    $subject_code = $db->escapeString($fn->xss_clean($_POST['subject_code']));
    $regulation = $db->escapeString($fn->xss_clean($_POST['regulation']));
    $grade = $db->escapeString($fn->xss_clean($_POST['grade']));
    
    if (empty($reg_no)) {
        $error['reg_no'] = " <span class='label label-danger'>Required!</span>";
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

    if ( !empty($reg_no) && !empty($semester)&& !empty($department) && !empty($subject_code) && !empty($regulation) && !empty($grade))
    {
        $sql = "UPDATE universityresults SET  reg_no='$reg_no',semester='$semester',department='$department',subject_code='$subject_code',regulation='$regulation',grade='$grade' WHERE id='$ID'";
        $db->sql($sql);
        $universityresults_result = $db->getResult();
        if (!empty($universityresults_result)) {
            $universityresults_result = 0;
        } else {
            $universityresults_result = 1;
        }
        if ($universityresults_result == 1) {
            $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>University Results Updated Successfully</span>
                                            <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                             </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

    }
}
$data = array();
$sql = "SELECT * FROM universityresults WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
foreach ($res as $row)
    $data = $row;
?>
<section class="content-header">
    <h1>Edit University Result</h1>
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
                    <h3 class="box-title">Edit University Result</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='edit_universityresults_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="">Roll.No</label> <i class="text-danger asterik">*</i> <?php echo isset($error['reg_no']) ? $error['reg_no'] : ''; ?><br>
                                    <select id="reg_no" name="reg_no" class="form-control">
                                        <option value="810718106001" <?=$data['reg_no'] == '810718106001' ? ' selected="selected"' : '';?> >810718106001</option>
                                        <option value="810718106002" <?=$data['reg_no'] == '810718106002' ? ' selected="selected"' : '';?> >810718106002</option>
                                        <option value="810718106003" <?=$data['reg_no'] == '810718106003' ? ' selected="selected"' : '';?> >810718106003</option>
                                    </select>
                            </div>
                            <div class='col-md-4'>
                                <label for="">Semester</label> <i class="text-danger asterik">*</i> <?php echo isset($error['semester']) ? $error['semester'] : ''; ?><br>
                                    <select id="semester" name="semester" class="form-control">
                                        <option value="1"<?=$data['semester'] == '1' ? ' selected="selected"' : '';?> >1</option>
                                        <option value="2"<?=$data['semester'] == '2' ? ' selected="selected"' : '';?> >2</option>
                                        <option value="3"<?=$data['semester'] == '3' ? ' selected="selected"' : '';?> >3</option>
                                        <option value="4"<?=$data['semester'] == '4' ? ' selected="selected"' : '';?> >4</option>
                                    </select>
                            </div>
                            <div class='col-md-4'>
                                <label for="">Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                       
                                        <option value="ECE" <?=$data['department'] == 'ECE' ? ' selected="selected"' : '';?>>ECE</option>
                                        <option value="CSE"<?=$data['department'] == 'CSE' ? ' selected="selected"' : '';?> >CSE</option>
                                        <option value="CIVIL"<?=$data['department'] == 'CIVIL' ? ' selected="selected"' : '';?> >CIVIL</option>
                                        <option value="MECH"<?=$data['department'] == 'MECH' ? ' selected="selected"' : '';?> >MECH</option>
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
                                                    
                                                    <option value="CS8067"<?=$data['subject_code'] == 'CS8067' ? ' selected="selected"' : '';?> >CS8067</option>
                                                    <option value="EC8654"<?=$data['subject_code'] == 'EC8654' ? ' selected="selected"' : '';?> >EC8654</option>
                                                    <option value="ME7654"<?=$data['subject_code'] == 'ME7654' ? ' selected="selected"' : '';?> >ME7654</option>
                                                    <option value="EC8907"<?=$data['subject_code'] == 'EC8907' ? ' selected="selected"' : '';?> >EC8907</option>
                                                </select>
                                </div>
                                <div class='col-md-4'>
                                        <label for="">Regulation</label> <i class="text-danger asterik">*</i> <?php echo isset($error['regulation']) ? $error['regulation'] : ''; ?><br>
                                                        <select id="regulation" name="regulation" class="form-control">
                                                            
                                                            <option value="R2013"<?=$data['regulation'] == 'R2013' ? ' selected="selected"' : '';?> >R2013</option>
                                                            <option value="R2017"<?=$data['regulation'] == 'R2017' ? ' selected="selected"' : '';?> >R2017</option>
                                                            <option value="R2022"<?=$data['regulation'] == 'R2022' ? ' selected="selected"' : '';?> >R2022</option>
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
                                                                    <option value="O"<?=$data['grade'] == 'O' ? ' selected="selected"' : '';?> >O</option>
                                                                    <option value="A+"<?=$data['grade'] == 'A+' ? ' selected="selected"' : '';?> >A+</option>
                                                                    <option value="A"<?=$data['grade'] == 'A' ? ' selected="selected"' : '';?> >A</option>
                                                                    <option value="B+"<?=$data['grade'] == 'B+' ? ' selected="selected"' : '';?> >B+</option>
                                                                    <option value="B"<?=$data['grade'] == 'B' ? ' selected="selected"' : '';?> >B</option>
                                                                    <option value="RA"<?=$data['grade'] == 'RA' ? ' selected="selected"' : '';?> >RA</option>
                                                                </select>
                                </div>
                            </div>
                        </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate"/>&nbsp;
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
    $('#edit_universityresluts_form').validate({

        ignore: [],
        debug: false,
        rules: {
           reg_no: "required",
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