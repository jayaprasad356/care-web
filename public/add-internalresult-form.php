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
        
        $marks = $fn->xss_clean_array($_POST['marks']);
        $roll_no = $fn->xss_clean_array($_POST['roll_no']);
        for ($i = 0; $i < count($roll_no); $i++) {
            $sql = "INSERT INTO internalmarks (roll_no, marks) VALUES ('" . $roll_no[$i] . "', '" . $marks[$i] . "')";
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
?>
<section class="content-header">
    <h1>Add Internal Result</h1>
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
                                                        <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
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
                                            <option value='<?= $value['semester'] ?>' ><?= $value['semester'] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class='col-md-2'>
                                <label for="">Department</label>
                                <select name='department' id='department' class='form-control' placeholder='Enter the department you want to assign Seller' >
                                        <?php
                                        $role = $_SESSION['role'];
                                        if($role == 'Exam Cell'){
                                            
                                            $sql = "SELECT department FROM `department`";
                                            
                                        }
                                        else{
                                            $department = $_SESSION['department'];
                                            $sql = "SELECT department FROM `department` WHERE department IN ('$department') ";
                                        }
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
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
                                            <option value='<?= $value['test_type'] ?>'><?= $value['test_type'] ?></option>
                                        <?php } ?>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Subject</label>
                            
                            <select id='subject' name="subject[]" class='form-control'>
                                        <?php
                                        $sql = "SELECT * FROM `subjects`";
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['subject_code'] ?>'><?= $value['subject_code'] ?></option>
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
                                $sql = "SELECT * FROM `students`";
                                $db->sql($sql);

                                $result = $db->getResult();
                                foreach ($result as $value) {
                                ?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class='col-md-4'>
                                            <label for="exampleInputEmail1">Student Roll No</label>
                                            <input type="text" class="form-control" name="roll_no[]" value="<?php echo $value['roll_no'] ?>" readonly >
                                        </div>
                                        <div class='col-md-4'>
                                            <label for="exampleInputEmail1">Marks</label>
                                            <input type="number" class="form-control" name="marks[]" value="">
                                        </div>

                                    </div>


                                </div>
                                <hr>
                                <?php } ?>


                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
                        
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
    $('#subject').select2({
        width: 'element',
        placeholder: 'Type in subject to search',

    });
</script>