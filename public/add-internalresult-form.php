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
    $batchspin = $_POST['batch'];
    $departmentspin = $_POST['department'];
    $semesterselect = $_POST['semester'];
    $testtypeselect = $_POST['testtype'];
    $subselect = $_POST['subject_code'];
    $error = array();
    
    $marks = $fn->xss_clean_array($_POST['marks']);
    $reg_no = $fn->xss_clean_array($_POST['reg_no']);
    for ($i = 0; $i < count($reg_no); $i++) {
        $sql = "INSERT INTO internalmarks (reg_no,department,batch,test_type,semester,subject_code,marks) VALUES ('" . $reg_no[$i] . "','$departmentspin','$batchspin','$testtypeselect','$semesterselect','$subselect', '" . $marks[$i] . "')";
        $db->sql($sql);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }
        if ($result == 1) {
            $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>Internals Added Successfully</span>
                                            
                                            </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

    }
        
}
if (isset($_POST['btnUpdate'])) {
    $batchspin = $_POST['batch'];
    $departmentspin = $_POST['department'];
    $semesterselect = $_POST['semester'];
    $testtypeselect = $_POST['testtype'];
    $subselect = $_POST['subject_code'];
    $error = array();
    
    $marks = $fn->xss_clean_array($_POST['marks']);
    $reg_no = $fn->xss_clean_array($_POST['reg_no']);
    for ($i = 0; $i < count($reg_no); $i++) {
        $sql = "UPDATE internalmarks SET marks = '" . $marks[$i] . "' WHERE reg_no = '" . $reg_no[$i] . "' AND department = '$departmentspin' AND batch = '$batchspin' AND test_type = '$testtypeselect' AND semester = '$semesterselect' AND subject_code = '$subselect'";
        $db->sql($sql);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }
        if ($result == 1) {
            $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>Internals Updated Successfully</span>
                                            
                                            </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }

    }
        
}
if (isset($_POST['btnView'])) {
    $batchspin = $_POST['batch'];
    $departmentspin = $_POST['department'];
    $semesterselect = $_POST['semester'];
    $testtypeselect = $_POST['testtype'];
    $subselect = $_POST['subject_code'];

}
$batchspin = isset($batchspin) ? $batchspin : '';
$departmentspin = isset($departmentspin) ? $departmentspin : '';
$semesterselect = isset($semesterselect) ? $semesterselect : '';
$testtypeselect = isset($testtypeselect) ? $testtypeselect : '';
$subselect = isset($subselect) ? $subselect : '';
?>
<style>
    .form-control {
  margin:0 5px; 
  margin:5px 0; 
 }
</style>
<section class="content-header">
    <h1>Add/Update Internal Result</h1>
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
                    <h3 class="box-title">Add/Update Internal Result</h3>
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
                            <div class='col-md-2'>
                            <label for="">Batch</label>
                            <select name='batch' id='batch' class='form-control'>
                                            <option value="">ALL</option>
                                                    <?php
                                                    $batch = $_SESSION['batch'];
                                                    $sql = "SELECT year FROM `batch` WHERE  year IN ($batch) ";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['year'] ?>' <?=$batchspin == $value['year'] ? ' selected="selected"' : '';?>><?= $value['year'] ?></option>
                                                    <?php } ?>

                                                </select>
                            </div>
                            <div class='col-md-2'>
                                <label for="">Semester</label>
                                <select id='semester' name="semester" class='form-control'>
                                        <?php
                                        $sql = "SELECT semester FROM `semester`";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['semester'] ?>' <?=$semesterselect == $value['semester'] ? ' selected="selected"' : '';?> ><?= $value['semester'] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class='col-md-2'>
                                <label for="">Department</label>
                                <select name='department' id='department' class='form-control' placeholder='Enter the department you want to assign Seller' >
                                        <?php
                                        $department = $_SESSION['department'];
                                        $sql = "SELECT department FROM `department` WHERE department IN ('$department') ";
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['department'] ?>' <?=$departmentspin == $value['department'] ? ' selected="selected"' : '';?>><?= $value['department'] ?></option>
                                        <?php } ?>

                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="">Choose Test</label>
                            <select id='testtype' name="testtype" class='form-control'>
                            
                                        <?php
                                        $sql = "SELECT test_type FROM `test_type`";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['test_type'] ?>' <?=$testtypeselect == $value['test_type'] ? ' selected="selected"' : '';?>><?= $value['test_type'] ?></option>
                                        <?php } ?>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Subject</label>
                            
                            <select id='subject_code' name="subject_code" class='form-control'>
                                        <?php
                                        $subject_code = $_SESSION['subject_code'];
                                        $role = $_SESSION['role'];
                                        if ($role == 'Faculty') {
                                            $sql = "SELECT * FROM `subjects` WHERE  subject_code IN ('$subject_code') ";

                                        }
                                        else{
                                            $sql = "SELECT * FROM `subjects`";

                                        }
                                        
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['subject_code'] ?>' <?=$subselect == $value['subject_code'] ? ' selected="selected"' : '';?>><?= $value['subject_code'] ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                        <br>
                            <input type="submit" class="btn-primary btn" value="View" name="btnView" />&nbsp;
                        </div>
                        
                        </div>

                        </div>
                        
                                <?php
                                $sql = "SELECT * FROM `students` WHERE batch = '$batchspin' AND department = '$departmentspin'";
                                $db->sql($sql);

                                $result = $db->getResult();
                                $num = isset($batchspin) ? $db->numRows($result) : 0;
                                if($num != 0){
                                    $sql = "SELECT * FROM `internalmarks` WHERE batch = '$batchspin' AND department = '$departmentspin' AND semester = '$semesterselect' AND test_type = '$testtypeselect' AND subject_code = '$subselect'";
                                    $db->sql($sql);
                                    $result2 = $db->getResult();
                                    $num2 = $db->numRows($result2);
                                    ?>
                                    <div class="row">
                                        <div class="form-group">
                                        <div class='col-md-4'>
                                            <label for="exampleInputEmail1">Student Roll No</label>
                                            
                                        </div>
                                        <div class='col-md-4'>
                                            <label for="exampleInputEmail1">Marks</label>
                                            
                                        </div>

                                    </div>


                                </div>
                                <?php
                                foreach ($result as $value) {
                                    $marks = '';
                                    foreach ($result2 as $val) {
                                        if($value['reg_no'] == $val['reg_no']){
                                            $marks = $val['marks'];
                                            break;
                                        }
                                        else{
                                            $marks = '';
                                        }
                                    }
                                    
                                ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class='col-md-4'>
                                           
                                            <input type="text" class="form-control" name="reg_no[]" value="<?php echo $value['reg_no'] ?>" readonly >
                                        </div>
                                        <div class='col-md-4'>
                                            <input type="text" class="form-control" name="marks[]" value="<?php echo $marks ?>">
                                        </div>
                                    </div>
                                </div>
                             
                                <?php }
                                if($num2 == 0){
                                    ?>
                                    <div class="box-footer">
                                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
                                    </div>
                                    <?php }
                                    else{
                                        ?>
                                        <div class="box-footer">
                                            <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
                                        </div>
                                        <?php
                                    }
                                ?>

                    <?php } ?>
                    
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
    $('#subject_code').select2({
        width: 'element',
        placeholder: 'Type in subject to search',

    });
</script>