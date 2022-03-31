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
        $department = $db->escapeString($fn->xss_clean($_POST['department']));
        $subject_name = $db->escapeString($fn->xss_clean($_POST['subject_name']));
        $subject_code = $db->escapeString($fn->xss_clean($_POST['subject_code']));
        $regulation = $db->escapeString($fn->xss_clean($_POST['regulation']));
        
       
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($subject_name)) {
            $error['subject_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($subject_code)) {
            $error['subject_code'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($regulation)) {
            $error['regulation'] = " <span class='label label-danger'>Required!</span>";
        }

        if (!empty($department) && !empty($subject_name) && !empty($subject_code) && !empty($regulation))
        {
            $sql = "UPDATE subjects SET department='$department',subject_name='$subject_name,subject_code='$subject_code',regulation='$regulation' WHERE id=$ID";
            $db->sql($sql);
            $subject_result = $db->getResult();
            if (!empty($subject_result)) {
                $subject_result = 0;
            } else {
                $subject_result = 1;
            }
            if ($subject_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Subject Details Updated Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
    $data = array();
$sql = "SELECT * FROM subjects WHERE id = '$ID'";
$db->sql($sql);
$res = $db->getResult();
foreach ($res as $row)
    $data = $row;
?>
<section class="content-header">
    <h1>Edit Subject</h1>
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
                    <h3 class="box-title">Edit Subject</h3>
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
                                    <label for="">Select Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select</option>
                                        <option value="ECE" <?=$data['department'] == 'ECE' ? ' selected="selected"' : '';?> >ECE</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Subject Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['subject_name']) ? $error['subject_name'] : ''; ?>
                                    <input type="text" class="form-control" name="subject_name" value="<?php echo $data['subject_name']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Subject Code</label> <i class="text-danger asterik">*</i><?php echo isset($error['subject_code']) ? $error['subject_code'] : ''; ?>
                                    <input type="text" class="form-control" name="subject_code" value="<?php echo $data['subject_code']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Regulation</label> <i class="text-danger asterik">*</i><?php echo isset($error['regulation']) ? $error['regulation'] : ''; ?>
                                    <input type="text" class="form-control" name="regulation" value="<?php echo $data['regulation']?>" required>
                                </div>
                            </div>

                        </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
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
    $('#edit_subject_form').validate({

        ignore: [],
        debug: false,
        rules: {
            department: "required",
            subject_name: "required",
            subject_code: "required",
            regulation: "required"
        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>