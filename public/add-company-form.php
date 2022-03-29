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
        $company_name = $db->escapeString($fn->xss_clean($_POST['company_name']));
        $job_role = $db->escapeString($fn->xss_clean($_POST['job_role']));
        $location = $db->escapeString($fn->xss_clean($_POST['location']));
        $sslc_mark = $db->escapeString($fn->xss_clean($_POST['sslc_mark']));
        $hsc_mark = $db->escapeString($fn->xss_clean($_POST['hsc_mark']));
        $cgpa = $db->escapeString($fn->xss_clean($_POST['cgpa']));
        $salary = $db->escapeString($fn->xss_clean($_POST['salary']));
        $registration_link = $db->escapeString($fn->xss_clean($_POST['registration_link']));
        
        if (empty($company_name)) {
            $error['company_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($job_role)) {
            $error['job_role'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($sslc_mark)) {
            $error['sslc_mark'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($hsc_mark)) {
            $error['hsc_mark'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($cgpa)) {
            $error['cgpa'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($salary)) {
            $error['salary'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($registration_link)) {
            $error['registration_link'] = " <span class='label label-danger'>Required!</span>";
        }

        if ( !empty($company_name) && !empty($job_role)&& !empty($location) && !empty($sslc_mark) && !empty($hsc_mark) && !empty($cgpa) && !empty($salary) && !empty($registration_link))
        {
            $sql = "INSERT INTO companies (company_name,job_role,location,sslc_mark,hsc_mark,cgpa,salary,registration_link) VALUES('$company_name','$job_role','$location','$sslc_mark','$hsc_mark','$cgpa','$salary','$registration_link')";
            $db->sql($sql);
            $companies_result = $db->getResult();
            if (!empty($companies_result)) {
                $companies_result = 0;
            } else {
                $companies_result = 1;
            }
            if ($companies_result == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Company Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }

        }
    }
?>
<section class="content-header">
    <h1>Add Company</h1>
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
                    <h3 class="box-title">Add Company</h3>
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
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Company Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['company_name']) ? $error['company_name'] : ''; ?>
                                    <input type="text" class="form-control" name="company_name" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Job Role</label> <i class="text-danger asterik">*</i><?php echo isset($error['job_role']) ? $error['job_role'] : ''; ?>
                                    <input type="text" class="form-control" name="job_role" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">location</label> <i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC Mark</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_mark']) ? $error['sslc_mark'] : ''; ?>
                                    <input type="number" class="form-control" name="sslc_mark" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC Mark</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_mark']) ? $error['hsc_mark'] : ''; ?>
                                    <input type="number" class="form-control" name="hsc_mark" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">CGPA</label> <i class="text-danger asterik">*</i><?php echo isset($error['cgpa']) ? $error['cgpa'] : ''; ?>
                                    <input type="number" class="form-control" name="cgpa" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Salary</label> <i class="text-danger asterik">*</i><?php echo isset($error['salary']) ? $error['salary'] : ''; ?>
                                    <input type="text" class="form-control" name="salary" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Registration Link</label> <i class="text-danger asterik">*</i><?php echo isset($error['registration_link']) ? $error['registration_link'] : ''; ?>
                                    <input type="text" class="form-control" name="registration_link" required>
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
    $('#add_staff_form').validate({

        ignore: [],
        debug: false,
        rules: {
           company_name: "required",
            job_role: "required",
            location: "required",
            sslc_mark: "required",
           hsc_mark: "required",
            cgpa: "required",
           salary: "required",
        registration_link: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>