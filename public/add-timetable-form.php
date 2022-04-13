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
        $subject_name = $db->escapeString($fn->xss_clean($_POST['subject_name']));
        $day = $db->escapeString($fn->xss_clean($_POST['day']));
        $duration = $db->escapeString($fn->xss_clean($_POST['duration']));
        
        if (empty($subject_name)) {
            $error['subject_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($day)) {
            $error['day'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($duration)) {
            $error['duration'] = " <span class='label label-danger'>Required!</span>";
        }

        if ( !empty($subject_name) && !empty($day)&& !empty($duration))
        {
            $sql = "INSERT INTO timetable (subject_name,day,duration) VALUES('$subject_name','$day','$duration')";
            $db->sql($sql);
            $timetable_result = $db->getResult();
            if (!empty($timetable_result)) {
                $timetable_result = 0;
            } else {
                $timetable_result = 1;
            }
            if ($timetable_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Timetable Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
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
                                <div class='col-md-8'>
                                    <label for="">Subject</label> <i class="text-danger asterik">*</i> <?php echo isset($error['subject_name']) ? $error['subject_name'] : ''; ?><br>
                                        <select id="subject_name" name="subject_name" class="form-control">
                                            <option value="Wireless Communication">Wireless Communication</option>
                                            <option value="VLSI Design">VLSI Design</option>
                                            <option value="professional Ethics in Engineering">professional Ethics in Engineering</option>
                                            <option value="Engineering physics">Engineering physics</option>
                                        </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Day</label> <i class="text-danger asterik">*</i> <?php echo isset($error['day']) ? $error['day'] : ''; ?><br>
                                            <select id="day" name="day" class="form-control">
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                            </select>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                <label for="">Duration</label> <i class="text-danger asterik">*</i> <?php echo isset($error['duration']) ? $error['duration'] : ''; ?><br>
                                            <select id="duration" name="duration" class="form-control">
                                                <option value="9.00-9.45">9.00-9.45</option>
                                                <option value="9.45-10.30">9.45-10.30</option>
                                                <option value="11.00-11.45">11.00-11.45</option>
                                                <option value="11.45-12.30">11.45-12.30</option>
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