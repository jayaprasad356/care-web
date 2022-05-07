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
    $tt_name = $db->escapeString($_POST['tt_name']);
    $department = $db->escapeString($_POST['department']);
    $batch = $db->escapeString($_POST['batch']);
   
   

    // get image info
    $menu_image = $db->escapeString($_FILES['time_table_file']['name']);
    $image_error = $db->escapeString($_FILES['time_table_file']['error']);
    $image_type = $db->escapeString($_FILES['time_table_file']['type']);

    // create array variable to handle error
    $error = array();

    if (empty($tt_name)) {
        $error['tt_name'] = " <span class='label label-danger'>Required!</span>";
    }
    


    error_reporting(E_ERROR | E_PARSE);
    $extension = end(explode(".", $_FILES["time_table_file"]["name"]));

    if(!empty($tt_name)) {
        // create random image file name
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['time_table_file']['name']);
        $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

        // upload new image
        $upload = move_uploaded_file($_FILES['time_table_file']['tmp_name'], 'upload/timetables/' . $menu_image);

        // insert new data to menu table
        $upload_image = 'upload/timetables/' . $menu_image;
        $sql_query = "INSERT INTO timetables (name,department,batch,file,status)VALUES('$tt_name','$department','$batch', '$upload_image',1)";
        $db->sql($sql_query);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }

        if ($result == 1) {
            $error['add_menu'] = " <section class='content-header'><span class='label label-success'>TimeTable Added Successfully</span></section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed add category</span>";
        }

    

    }
}
?>
<section class="content-header">
    <h1>Add Timetable</h1>
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
                    <h3 class="box-title">Add Timetable</h3>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label><i class="text-danger asterik">*</i><?php echo isset($error['tt_name']) ? $error['tt_name'] : ''; ?>
                                        <input type="text" class="form-control" name="tt_name" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="form-group col-md-3">
                            <h4 class="box-title">Choose Department</h4>
                            <select name='department' id='department' class='form-control'  >
                                <option value="">ALL</option>
                                        <?php
                                        $department = $_SESSION['department'];
                                        $sql = "SELECT department FROM `department` WHERE department IN ('$department') ";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
                                        <?php } ?>

                            </select>
                          </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-3">
                            <h4 class="box-title">Choose Batch</h4>
                            <select name='batch' id='batch' class='form-control' >
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
                            </select>
                           </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Time Table File</label><i class="text-danger asterik">*</i><?php echo isset($error['time_table_file']) ? $error['time_table_file'] : ''; ?>
                                        <input type="file" name="time_table_file"  id="time_table_file" required />
                                    </div>
                                </div>
                            </div>

</div>

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
    $('#add_timetable_form').validate({

        ignore: [],
        debug: false,
        rules: {
           subject_name: "required",
            day: "required",
            duration: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>