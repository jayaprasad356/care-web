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
        $title = $db->escapeString($fn->xss_clean($_POST['title']));
        $description = $db->escapeString($fn->xss_clean($_POST['description']));
        $department = $db->escapeString($fn->xss_clean($_POST['department']));
        $year = $db->escapeString($fn->xss_clean($_POST['year']));
        $category = $db->escapeString($fn->xss_clean($_POST['category']));
        
       
        if (empty($title)) {
            $error['title'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($year)) {
            $error['year'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($category)) {
            $error['category'] = " <span class='label label-danger'>Required!</span>";
        }

        if (!empty($title) && !empty($description) && !empty($department) && !empty($year) && !empty($category))
        {
            $sql = "INSERT INTO notifications (title,description,department,year,category) VALUES('$title','$description','$department','$year','$category')";
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
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
?>
<section class="content-header">
    <h1>Add Notification</h1>
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
                    <h3 class="box-title">Add Notification</h3>
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
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Description</label> <i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                                    <input type="text" class="form-control" name="description" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for=""> Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select</option>
                                        <option value="ECE">ECE</option>
                                        <option value="Civil">Civil</option>
                                        <option value="CSE">CSE</option>
                                        <option value="Mech">Mech</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for=""> year</label> <i class="text-danger asterik">*</i> <?php echo isset($error['year']) ? $error['year'] : ''; ?><br>
                                    <select id="year" name="year" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1-year">1-year</option>
                                        <option value="2-year">2-year</option>
                                        <option value="3-year">3-year</option>
                                        <option value="4-year">4-year</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                <label for=""> category</label> <i class="text-danger asterik">*</i> <?php echo isset($error['category']) ? $error['category'] : ''; ?><br>
                                    <select id="category" name="category" class="form-control">
                                        <option value="">All</option>
                                        <option value="Hosteler">Hosteler</option>
                                        <option value="DayScholar">DayScholar</option>
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
    $('#add_notification_form').validate({

        ignore: [],
        debug: false,
        rules: {
           title: "required",
            description: "required",
            department: "required",
            year: "required",
            category: "required"
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>