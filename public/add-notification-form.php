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
$department = $_SESSION['department'];
$batch = $_SESSION['batch'];
if (isset($_POST['btnAdd'])) {
        $error = array();
        $title = $db->escapeString($fn->xss_clean($_POST['title']));
        $description = $db->escapeString($fn->xss_clean($_POST['description']));
        $department = $fn->xss_clean_array($_POST['department']);
        $departments = implode(",", $department);
        $batch = $fn->xss_clean_array($_POST['batch']);
        $batchs = implode(",", $batch);
        
       
        if (empty($title)) {
            $error['title'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($batch)) {
            $error['batch'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($category)) {
            $error['category'] = " <span class='label label-danger'>Required!</span>";
        }

        if (!empty($title) && !empty($description) && !empty($department) && !empty($batch))
        {   
            $sql="SELECT id FROM staffs WHERE email = '" . $_SESSION['email'] . "'";
            $db->sql($sql);
            $res = $db->getResult();
            $num = $db->numRows($res);
            $staff_id=$res[0]['id'];
            $sql = "INSERT INTO notifications (staff_id,title,description,department,batch) VALUES('$staff_id','$title','$description','$departments','$batchs')";
            $db->sql($sql);
            $notification_result = $db->getResult();
            if (!empty($notification_result)) {
                $notification_result = 0;
            } else {
                $notification_result = 1;
            }
            if ($notification_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Notification Added Successfully</span>
                                                <h4><small><a  href='notifications.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Notifications</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
?>
<section class="content-header">
    <h1>Send Notification</h1>
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
                    <h3 class="box-title">Send Notification</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_subject_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Title</label> <i class="text-danger asterik">*</i><?php echo isset($error['title']) ? $error['title'] : ''; ?>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description">Description :</label><i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                </div>

                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <label for='department'>Select Department</label><i class="text-danger asterik">*</i>
                                    <select name='department[]' id='department' class='form-control' placeholder='Enter the department you want to assign Seller' required multiple="multiple">
                                        <?php $sql = "SELECT department FROM `department` WHERE department IN ('$department') ";
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <label for='batch'>Select Batch</label><i class="text-danger asterik">*</i>
                                    <select name='batch[]' id='batch' class='form-control' placeholder='Enter the category IDs you want to assign Seller' required multiple="multiple">
                                        <?php $sql = "SELECT year FROM `batch` WHERE  year IN ($batch) ";
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Send" name="btnAdd" />&nbsp;
                        <!-- <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" /> -->
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
    $('#department').select2({
        width: 'element',
        placeholder: 'Type in department to search',

    });
    $('#batch').select2({
        width: 'element',
        placeholder: 'Type in batch to search',

    });
</script>