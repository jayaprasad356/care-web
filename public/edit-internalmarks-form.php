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
    $roll_no = $db->escapeString($fn->xss_clean($_POST['roll_no']));
    $department = $db->escapeString($fn->xss_clean($_POST['department']));
    $test_type= $db->escapeString($fn->xss_clean($_POST['test_type']));
    $number = $db->escapeString($fn->xss_clean($_POST['number']));
    $semester= $db->escapeString($fn->xss_clean($_POST['semester']));
    $subject_code = $db->escapeString($fn->xss_clean($_POST['subject_code']));
    $regulation = $db->escapeString($fn->xss_clean($_POST['regulation']));
    $marks = $db->escapeString($fn->xss_clean($_POST['marks']));
    
    if (empty($roll_no)) {
        $error['roll_no'] = " <span class='label label-danger'>Required!</span>";
    }
   
    if (empty($department)) {
        $error['department'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($test_type)) {
        $error['test_type'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($number)) {
        $error['number'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($semester)) {
        $error['semester'] = " <span class='label label-danger'>Required!</span>";
    }

    if (empty($subject_code)) {
        $error['subject_code'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($regulation)) {
        $error['regulation'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($marks)) {
        $error['marks'] = " <span class='label label-danger'>Required!</span>";
    }

    if ( !empty($roll_no) && !empty($department)&& !empty($test_type)&& !empty($number)&& !empty($semester) && !empty($subject_code) && !empty($regulation) && !empty($marks))
    {
        $sql = "UPDATE internalmarks SET  roll_no='$roll_no',department='$department',test_type='$test_type',number='$number',semester='$semester',subject_code='$subject_code',regulation='$regulation',marks='$marks' WHERE id='$ID'";
        $db->sql($sql);
        $internalmarks_result = $db->getResult();
        if (!empty($internalmarks_result)) {
            $internalmarks_result = 0;
        } else {
            $internalmarks_result = 1;
        }
        if ($internalmarks_result == 1) {
            $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>Internal marks Updated Successfully</span>
                                            <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                             </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

    }
}
$data = array();
$sql = "SELECT * FROM internalmarks WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
foreach ($res as $row)
    $data = $row;
?>
<section class="content-header">
    <h1>Edit Internal Marks</h1>
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
                    <h3 class="box-title">Edit Internal Mark</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='edit_internalmarks_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="">Roll.No</label> <i class="text-danger asterik">*</i> <?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?><br>
                                    <select id="roll_no" name="roll_no" class="form-control">
                                        <option value="810718106001" <?=$data['roll_no'] == '810718106001' ? ' selected="selected"' : '';?> >810718106001</option>
                                        <option value="810718106002" <?=$data['roll_no'] == '810718106002' ? ' selected="selected"' : '';?> >810718106002</option>
                                        <option value="810718106003" <?=$data['roll_no'] == '810718106003' ? ' selected="selected"' : '';?> >810718106003</option>
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
                            <div class="col-md-4">
                                  <label for="exampleInputEmail1">Test Type</label> <i class="text-danger asterik">*</i> <?php echo isset($error['test_type']) ? $error['test_type'] : ''; ?><br>
                                    <select id="test_type" name="test_type" class="form-control">
                                        <option value="Unit test"<?=$data['test_type'] == 'Unit test' ? ' selected="selected"' : '';?> >Unit test</option>
                                        <option value="Cycle test"<?=$data['test_type'] == 'Cycle test' ? ' selected="selected"' : '';?> >Cycle test</option>
                                    </select>
                                </div>
                        </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                
                                <div class='col-md-4'>
                                  <label for="exampleInputEmail1">Number</label> <i class="text-danger asterik">*</i> <?php echo isset($error['number']) ? $error['number'] : ''; ?><br>
                                  <input type="text" class="form-control" name="number" value="<?php echo $res[0]['number'] ?>"> 
                               </div>
                               <div class='col-md-4'>
                                  <label for="exampleInputEmail1">Semester</label> <i class="text-danger asterik">*</i> <?php echo isset($error['semester']) ? $error['semester'] : ''; ?><br>
                                    <select id="semester" name="semester" class="form-control">
                                        <option value="1"<?=$data['semester'] == '1' ? ' selected="selected"' : '';?> >1</option>
                                        <option value="2"<?=$data['semester'] == '2' ? ' selected="selected"' : '';?> >2</option>
                                        <option value="3"<?=$data['semester'] == '3' ? ' selected="selected"' : '';?> >3</option>
                                        <option value="4"<?=$data['semester'] == '4' ? ' selected="selected"' : '';?> >4</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                        <label for="">Subject Code</label> <i class="text-danger asterik">*</i> <?php echo isset($error['subject_code']) ? $error['subject_code'] : ''; ?><br>
                                        <input type="text" class="form-control" name="subject_code" value="<?php echo $res[0]['subject_code'] ?>">
                                </div>
                           </div> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                        <label for="">Regulation</label> <i class="text-danger asterik">*</i> <?php echo isset($error['regulation']) ? $error['regulation'] : ''; ?><br>
                                                        <select id="regulation" name="regulation" class="form-control">
                                                            
                                                            <option value="R2013"<?=$data['regulation'] == 'R2013' ? ' selected="selected"' : '';?> >R2013</option>
                                                            <option value="R2017"<?=$data['regulation'] == 'R2017' ? ' selected="selected"' : '';?> >R2017</option>
                                                            <option value="R2022"<?=$data['regulation'] == 'R2022' ? ' selected="selected"' : '';?> >R2022</option>
                                                        </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Marks</label> <i class="text-danger asterik">*</i> <?php echo isset($error['marks']) ? $error['marks'] : ''; ?><br>
                                    <input type="text" class="form-control" name="marks" value="<?php echo $res[0]['marks'] ?>">                         
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
    $('#edit_internalmarks_form').validate({

        ignore: [],
        debug: false,
        rules: {
           roll_no: "required",
            department:"required",
            test_type: "required",
            number: "required",
            semester: "required",
            subject_code: "required",
            regulation: "required",
           marks: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>