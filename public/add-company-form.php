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
        $sslc_percentage = $db->escapeString($fn->xss_clean($_POST['sslc_percentage']));
        $hsc_percentage = $db->escapeString($fn->xss_clean($_POST['hsc_percentage']));
        $ug_percentage = $db->escapeString($fn->xss_clean($_POST['ug_percentage']));
        $lpa = $db->escapeString($fn->xss_clean($_POST['lpa']));
        $registration_link = $db->escapeString($fn->xss_clean($_POST['registration_link']));
        $last_date = $db->escapeString($fn->xss_clean($_POST['last_date']));
        
        if (empty($company_name)) {
            $error['company_name'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($job_role)) {
            $error['job_role'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($location)) {
            $error['location'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($sslc_percentage)) {
            $error['sslc_percentage'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($hsc_percentage)) {
            $error['hsc_percentage'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($ug_percentage)) {
            $error['ug_percentage'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($lpa)) {
            $error['lpa'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($registration_link)) {
            $error['registration_link'] = " <span class='label label-danger'>Required!</span>";
        }
        if (empty($last_date)) {
            $error['last_date'] = " <span class='label label-danger'>Required!</span>";
        }

        if ( !empty($company_name) && !empty($job_role)&& !empty($location) && !empty($sslc_percentage) && !empty($hsc_percentage) && !empty($ug_percentage) && !empty($lpa) && !empty($registration_link) && !empty($last_date))
        {
            $sql = "INSERT INTO companies (company_name,job_role,location,sslc_percentage,hsc_percentage,ug_percentage,lpa,registration_link,last_date) VALUES('$company_name','$job_role','$location','$sslc_percentage','$hsc_percentage','$ug_percentage','$lpa','$registration_link','$last_date')";
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
                                                <h4><small><a  href='companies.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Companies</a></small></h4>
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
                                    <label for="exampleInputEmail1">Location</label> <i class="text-danger asterik">*</i><?php echo isset($error['location']) ? $error['location'] : ''; ?>
                                    <input type="text" class="form-control" name="location" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">SSLC Percentage</label> <i class="text-danger asterik">*</i><?php echo isset($error['sslc_percentage']) ? $error['sslc_mark'] : ''; ?>
                                    <input type="number" class="form-control" name="sslc_percentage" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">HSC Percentage</label> <i class="text-danger asterik">*</i><?php echo isset($error['hsc_percentage']) ? $error['hsc_mark'] : ''; ?>
                                    <input type="number" class="form-control" name="hsc_percentage" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">UG Percentage</label> <i class="text-danger asterik">*</i><?php echo isset($error['ug_percentage']) ? $error['ug_percentage'] : ''; ?>
                                    <input type="number" class="form-control" name="ug_percentage" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">LPA</label> <i class="text-danger asterik">*</i><?php echo isset($error['lpa']) ? $error['lpa'] : ''; ?>
                                    <input type="text" class="form-control" name="lpa" required>
                                </div>
                                <div class='col-md-8'>
                                    <label for="exampleInputEmail1">Registration Link</label> <i class="text-danger asterik">*</i><?php echo isset($error['registration_link']) ? $error['registration_link'] : ''; ?>
                                    <input type="url" class="form-control" name="registration_link" required>
                                </div>
                            </div> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                            <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Last Date of Apply</label> <i class="text-danger asterik">*</i><?php echo isset($error['last_date']) ? $error['last_date'] : ''; ?>
                                    <input type="date" class="form-control" name="last_date" required>
                                </div>
                            </div> 
                        </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
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
    $('#add_staff_form').validate({

        ignore: [],
        debug: false,
        rules: {
           company_name: "required",
            job_role: "required",
            location: "required",
            sslc_percentage: "required",
            hsc_percentage: "required",
            cgpa: "required",
            salary: "required",
            last_date: "required"
         }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>