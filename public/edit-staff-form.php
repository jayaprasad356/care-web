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
        $name = $db->escapeString($fn->xss_clean($_POST['name']));
        $email = $db->escapeString($fn->xss_clean($_POST['email']));
        $mobile = $db->escapeString($fn->xss_clean($_POST['mobile']));
        $password = $db->escapeString($fn->xss_clean($_POST['password']));
        $department = $db->escapeString($fn->xss_clean($_POST['department']));
        $role = $db->escapeString($fn->xss_clean($_POST['role']));
        
        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($email)) {
            $error['email'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($mobile)) {
            $error['mobile'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($password)) {
            $error['password'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($department)) {
            $error['department'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($role)) {
            $error['role'] = " <span class='label label-danger'>Required!</span>";
        }

        if ( !empty($name) && !empty($email)&& !empty($mobile) && !empty($password) && !empty($department) && !empty($role))
        {
            $sql = "UPDATE staffs SET name='$name',email='$email',mobile='$mobile',password='$password',department='$department',role='$role' WHERE id=$ID";
            $db->sql($sql);
            $staffs_result = $db->getResult();
            if (!empty($staffs_result)) {
                $staffs_result = 0;
            } else {
                $staffs_result = 1;
            }
            if ($staffs_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Staff Details Updated Successfully</span>
                                                <h4><small><a  href='staffs.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Staffs</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
    $data = array();
    $sql = "SELECT * FROM staffs WHERE id = '$ID'";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $data = $row;
?>
<section class="content-header">
    <h1>Edit Staff</h1>
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
                    <h3 class="box-title">Edit Staff</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_student_form' method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Staff Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="number" class="form-control" name="mobile" value="<?php echo $data['mobile']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                    <input type="email" class="form-control" name="email" value="<?php echo $data['email']?>" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Password</label> <i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                                    <input type="text" class="form-control" name="password" value="<?php echo $data['password']?>" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="">Select Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select</option>
                                        <option value="ECE" <?=$data['department'] == 'ECE' ? ' selected="selected"' : '';?>>ECE</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Select Role</label> <i class="text-danger asterik">*</i> <?php echo isset($error['role']) ? $error['role'] : ''; ?><br>
                                    <select id="role" name="role" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Faculty"<?=$data['role'] == 'Faculty' ? ' selected="selected"' : '';?>>Faculty</option>
                                        <option value="CC"<?=$data['role'] == 'CC' ? ' selected="selected"' : '';?> >CC</option>
                                        <option value="HOD" <?=$data['role'] == 'HOD' ? ' selected="selected"' : '';?>>HOD</option>
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
                                            <?php $sql = 'select year from `batch`  order by year';
                                            $db->sql($sql);

                                            $result = $db->getResult();
                                            foreach ($result as $value) {
                                                $batch = explode(',', $res[0]['batch']);
                                                $selected = in_array($value['id'], $categories) ? 'selected' : '';
                                            ?>
                                                <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                            <?php } ?>

                                        </select>
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
    $('#edit_staff_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            mobile: "required",
            email: "required",
            password: "required",
            department: "required",
            role: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
    $('#batch').select2({
        width: 'element',
        placeholder: 'type in batch to search',

    });
</script>