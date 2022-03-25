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
         
         $pincode_type = $db->escapeString($fn->xss_clean('all'));
        
        //$pincode_type = (isset($_POST['product_pincodes']) && $_POST['product_pincodes'] != '') ? $db->escapeString($fn->xss_clean($_POST['product_pincodes'])) : "";
        if ($pincode_type == "all") {
            $pincode_ids = NULL;
        } else {

            if (empty($_POST['pincode_ids_exc'])) {
                $error['pincode_ids_exc'] = "<label class='label label-danger'>Select pincodes!.</label>";
            } else {
                $pincode_ids = $fn->xss_clean_array($_POST['pincode_ids_exc']);
                $pincode_ids = implode(",", $pincode_ids);
            }
        }
        $name = $db->escapeString($fn->xss_clean($_POST['name']));
        $seller_id = $db->escapeString($fn->xss_clean($_POST['seller_id']));
        $tax_id = (isset($_POST['tax_id']) && $_POST['tax_id'] != '') ? $db->escapeString($fn->xss_clean($_POST['tax_id'])) : 0;
        $return_days = (isset($_POST['return_days']) && $_POST['return_days'] != '') ? $db->escapeString($fn->xss_clean($_POST['return_days'])) : 0;
        $slug = $function->slugify($db->escapeString($fn->xss_clean($_POST['name'])));
        $category_id = $db->escapeString($fn->xss_clean($_POST['category_id']));
        $subcategory_id = (isset($_POST['subcategory_id']) && $_POST['subcategory_id'] != '') ? $db->escapeString($fn->xss_clean($_POST['subcategory_id'])) : 0;
        $serve_for = $db->escapeString($fn->xss_clean($_POST['serve_for']));
        $description = $db->escapeString($fn->xss_clean($_POST['description']));
        $manufacturer = (isset($_POST['manufacturer']) && $_POST['manufacturer'] != '') ? $db->escapeString($fn->xss_clean($_POST['manufacturer'])) : '';
        $made_in = (isset($_POST['made_in']) && $_POST['made_in'] != '') ? $db->escapeString($fn->xss_clean($_POST['made_in'])) : '';
        $indicator = (isset($_POST['indicator']) && $_POST['indicator'] != '') ? $db->escapeString($fn->xss_clean($_POST['indicator'])) : '0';
        $return_status = (isset($_POST['return_status']) && $_POST['return_status'] != '') ? $db->escapeString($fn->xss_clean($_POST['return_status'])) : '0';
        $cancelable_status = (isset($_POST['cancelable_status']) && $_POST['cancelable_status'] != '') ? $db->escapeString($fn->xss_clean($_POST['cancelable_status'])) : '0';
        $till_status = (isset($_POST['till_status']) && $_POST['till_status'] != '') ? $db->escapeString($fn->xss_clean($_POST['till_status'])) : '';
        $is_approved = (isset($_POST['is_approved']) && $_POST['is_approved'] != '') ? $db->escapeString($fn->xss_clean($_POST['is_approved'])) : 1;
        $is_cod_allowed = (isset($_POST['is_cod_allowed']) && $_POST['is_cod_allowed'] != '') ? $db->escapeString($fn->xss_clean($_POST['is_cod_allowed'])) : 1;
        $total_allowed_quantity = (isset($_POST['max_allowed_quantity']) && !empty($_POST['max_allowed_quantity'])) ? $db->escapeString($fn->xss_clean($_POST['max_allowed_quantity'])) : 0;

        // get image info
        $image = $db->escapeString($fn->xss_clean($_FILES['image']['name']));
        $image_error = $db->escapeString($fn->xss_clean($_FILES['image']['error']));
        $image_type = $db->escapeString($fn->xss_clean($_FILES['image']['type']));

        // create array variable to handle error


        if (empty($name)) {
            $error['name'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($tax_id)) {
            $error['tax_id'] = " <span class='label label-danger'>Required!</span>";
        }

        if ($cancelable_status == 1 && $till_status == '') {
            $error['cancelable'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($category_id)) {
            $error['category_id'] = " <span class='label label-danger'>Required!</span>";
        }

        if (empty($description)) {
            $error['description'] = " <span class='label label-danger'>Required!</span>";
        }


        // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["image"]["name"]));

        if ($image_error > 0) {
            $error['image'] = " <span class='label label-danger'>Not uploaded!</span>";
        } else {
            // $mimetype = mime_content_type($_FILES["image"]["tmp_name"]);
            // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
            //     $error['image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
            // }
            $result = $fn->validate_image($_FILES["image"]);
            if (!$result) {
                $error['image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!!!</span>";
            }
        }
        $error['other_images'] = '';
        if ($_FILES["other_images"]["error"][0] == 0) {
            for ($i = 0; $i < count($_FILES["other_images"]["name"]); $i++) {
                $_FILES["other_images"]["type"][$i];
                if ($_FILES["other_images"]["error"][$i] > 0) {
                    $error['other_images'] = " <span class='label label-danger'>Images not uploaded!</span>";
                } else {
                    // $mimetype = mime_content_type($_FILES["other_images"]["tmp_name"][$i]);
                    // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
                    //     $error['other_images'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
                    // }
                    $result = $fn->validate_other_images($_FILES["other_images"]["tmp_name"][$i], $_FILES["other_images"]["type"][$i]);
                    if (!$result) {
                        $error['other_images'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
                    }
                }
            }
        }

        if (!empty($name) && !empty($category_id) && !empty($serve_for) && empty($error['other_images']) && empty($error['image']) && empty($error['cancelable']) && !empty($description) && empty($error['pincode_ids_inc'])) {

            // create random image file name
            $string = '0123456789';
            $file = preg_replace("/\s+/", "_", $_FILES['image']['name']);

            $image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

            // upload new image
            $upload = move_uploaded_file($_FILES['image']['tmp_name'], 'upload/images/' . $image);
            $other_images = '';
            if (isset($_FILES['other_images']) && ($_FILES['other_images']['size'][0] > 0)) {
                //Upload other images
                $file_data = array();
                $target_path = 'upload/other_images/';
                for ($i = 0; $i < count($_FILES["other_images"]["name"]); $i++) {

                    $filename = $_FILES["other_images"]["name"][$i];
                    $temp = explode('.', $filename);
                    $filename = microtime(true) . '-' . rand(100, 999) . '.' . end($temp);
                    $file_data[] = $target_path . '' . $filename;
                    if (!move_uploaded_file($_FILES["other_images"]["tmp_name"][$i], $target_path . '' . $filename))
                        echo "{$_FILES['image']['name'][$i]} not uploaded<br/>";
                }
                $other_images = json_encode($file_data);
            }

            $upload_image = 'upload/images/' . $image;

            // insert new data to product table
            $sql = "INSERT INTO products (name,tax_id,seller_id,slug,category_id,subcategory_id,image,other_images,description,indicator,manufacturer,made_in,return_status,cancelable_status, till_status,type,pincodes,is_approved,return_days,cod_allowed,total_allowed_quantity) VALUES('$name','$tax_id','$seller_id','$slug','$category_id','$subcategory_id','$upload_image','$other_images','$description','$indicator','$manufacturer','$made_in','$return_status','$cancelable_status','$till_status','$pincode_type','$pincode_ids','$is_approved','$return_days','$is_cod_allowed','$total_allowed_quantity')";
            // echo $sql;
            $db->sql($sql);
            $product_result = $db->getResult();
            if (!empty($product_result)) {
                $product_result = 0;
            } else {
                $product_result = 1;
            }

            $sql = "SELECT id from products ORDER BY id DESC";
            $db->sql($sql);
            $res_inner = $db->getResult();
            if ($product_result == 1) {
                if ($_POST['type'] == 'packet') {
                    for ($i = 0; $i < count($_POST['packate_measurement']); $i++) {
                        $product_id = $db->escapeString($res_inner[0]['id']);
                        $type = $db->escapeString($fn->xss_clean($_POST['type']));
                        $measurement = $db->escapeString($fn->xss_clean($_POST['packate_measurement'][$i]));
                        $measurement_unit_id = $db->escapeString($fn->xss_clean($_POST['packate_measurement_unit_id'][$i]));

                        $price = $db->escapeString($fn->xss_clean($_POST['packate_price'][$i]));
                        $discounted_price = !empty($_POST['packate_discounted_price'][$i]) ? $db->escapeString($fn->xss_clean($_POST['packate_discounted_price'][$i])) : 0;
                        $serve_for = $db->escapeString($fn->xss_clean($_POST['packate_serve_for'][$i]));
                        $stock = $db->escapeString($fn->xss_clean($_POST['packate_stock'][$i]));
                        $serve_for = ($stock == 0 || $stock <= 0) ? 'Sold Out' : $serve_for;
                        $stock_unit_id = $db->escapeString($fn->xss_clean($_POST['packate_stock_unit_id'][$i]));

                        $sql = "INSERT INTO product_variant (product_id,type,measurement,measurement_unit_id,price,discounted_price,serve_for,stock,stock_unit_id) VALUES('$product_id','$type','$measurement','$measurement_unit_id','$price','$discounted_price','$serve_for','$stock','$stock_unit_id')";
                        $db->sql($sql);
                        $product_variant = $db->getResult();
                    }
                    if (!empty($product_variant)) {
                        $product_variant = 0;
                    } else {
                        $product_variant = 1;
                    }
                } elseif ($_POST['type'] == "loose") {
                    for ($i = 0; $i < count($_POST['loose_measurement']); $i++) {
                        $product_id = $db->escapeString($res_inner[0]['id']);
                        $type = $db->escapeString($fn->xss_clean($_POST['type']));
                        $measurement = $db->escapeString($fn->xss_clean($_POST['loose_measurement'][$i]));
                        $measurement_unit_id = $db->escapeString($fn->xss_clean($_POST['loose_measurement_unit_id'][$i]));
                        $price = $db->escapeString($fn->xss_clean($_POST['loose_price'][$i]));
                        $discounted_price = !empty($_POST['loose_discounted_price'][$i]) ? $db->escapeString($fn->xss_clean($_POST['loose_discounted_price'][$i])) : 0;
                        $serve_for = $db->escapeString($fn->xss_clean($_POST['serve_for']));
                        $stock = $db->escapeString($fn->xss_clean($_POST['loose_stock']));
                        $serve_for = ($stock == 0 || $stock <= 0) ? 'Sold Out' : $serve_for;
                        $stock_unit_id = $db->escapeString($fn->xss_clean($_POST['loose_stock_unit_id']));

                        $sql = "INSERT INTO product_variant (product_id,type,measurement,measurement_unit_id,price,discounted_price,serve_for,stock,stock_unit_id) VALUES('$product_id','$type','$measurement','$measurement_unit_id','$price','$discounted_price','$serve_for','$stock','$stock_unit_id')";
                        $db->sql($sql);
                        $product_variant = $db->getResult();
                    }
                    if (!empty($product_variant)) {
                        $product_variant = 0;
                    } else {
                        $product_variant = 1;
                    }
                }
            }
            if ($product_result == 1 && $product_variant == 1) {
                $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Product Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
            } else {
                $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
            }
        }
}
?>
<section class="content-header">
    <h1>Add Student</h1>
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
                    <h3 class="box-title">Add Student</h3>
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
                                    <label for="exampleInputEmail1">Student Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Student Roll No.</label> <i class="text-danger asterik">*</i><?php echo isset($error['roll_no']) ? $error['roll_no'] : ''; ?>
                                    <input type="number" class="form-control" name="roll_no" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Email</label> <i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Mobile</label> <i class="text-danger asterik">*</i><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                    <input type="number" class="form-control" name="mobile" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Password</label> <i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                                <div class='col-md-4'>
                                    <label for="">Select Department</label> <i class="text-danger asterik">*</i> <?php echo isset($error['department']) ? $error['department'] : ''; ?><br>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select</option>
                                        <option value="ECE">ECE</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                            <label class="control-label">Gender</label>
                                <div class="form-group">
                                    
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="is_approved" value="M"> Male
                                        </label>
                                        <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="is_approved" value="F"> Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class='col-md-4'>
                                    <label for="">Select Community</label> <i class="text-danger asterik">*</i> <?php echo isset($error['community']) ? $error['community'] : ''; ?><br>
                                    <select id="community" name="community" class="form-control">
                                        <option value="MBC">MBC</option>
                                        <option value="BC">BC</option>
                                        <option value="SC">SC</option>
                                        <option value="OC">OC</option>
                                    </select>
                                </div>
                                <div class='col-md-4'>
                                    <label for="exampleInputEmail1">Caste</label> <i class="text-danger asterik">*</i><?php echo isset($error['caste']) ? $error['caste'] : ''; ?>
                                    <input type="number" class="form-control" name="caste" required>
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
    $('#seller_id').on('change', function(e) {
        var seller_id = $('#seller_id').val();
        $.ajax({
            type: 'POST',
            url: "public/db-operation.php",
            data: 'get_categories_by_seller=1&seller_id=' + seller_id,
            beforeSend: function() {
                $('#category_id').html('<option>Please wait..</option>');
            },
            success: function(result) {
                $('#category_id').html(result);
            }
        });
    });

    var changeCheckbox = document.querySelector('#return_status_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#return_status').val(1);
            $('#return_day').show();
        } else {
            $('#return_status').val(0);
            $('#return_day').hide();
            $('#return_day').val('');
        }
    };
    // $('.pincodes').hide();
    // $('#pincode_ids_exc').prop('disabled', true);

    // // $('#product_pincodes').on('change', function() {
    // //     var val = $('#product_pincodes').val();
    // //     if (val == "included" || val == "excluded") {
    // //         $('#pincode_ids_exc').prop('disabled', false);
    // //     } else {
    // //         $('#pincode_ids_exc').prop('disabled', true);
    // //     }
    // // });
    // $('#pincode_ids_exc').select2({
    //     width: 'element',
    //     placeholder: 'type in category name to search',

    // });
</script>

<script>
    var changeCheckbox = document.querySelector('#cancelable_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#cancelable_status').val(1);
            $('#till-status').show();

        } else {
            $('#cancelable_status').val(0);
            $('#till-status').hide();
            $('#till_status').val('');
        }
    };
</script>
<script>
    var changeCheckbox = document.querySelector('#cod_allowed_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#cod_allowed_status').val(1);
        } else {
            $('#cod_allowed_status').val(0);
        }
    };
</script>
<script>
    $('#pincode_ids_inc').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });

    if ($('#packate').prop('checked')) {
        $('#packate_div').show();
        $('#packate_server_hide').hide();
        $('.loose_div').children(":input").prop('disabled', true);
        $('#loose_stock_div').children(":input").prop('disabled', true);
    }

    $.validator.addMethod('lessThanEqual', function(value, element, param) {
        return this.optional(element) || parseInt(value) < parseInt($(param).val());
    }, "Discounted Price should be lesser than Price");
</script>

<script>
    var num = 2;
    $('#add_packate_variation').on('click', function() {
        html = '<div class="row"><div class="col-md-2"><div class="form-group"><label for="measurement">Measurement</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" class="form-control" name="packate_measurement[]" required="" step="any" min="0"></div></div>' +
            '<div class="col-md-1"><div class="form-group">' +
            '<label for="measurement_unit">Unit</label><select class="form-control" name="packate_measurement_unit_id[]">' +
            '<?php
                foreach ($res_unit as $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="price">Price(<?= $settings['currency'] ?>):</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_price[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="discounted_price">Discounted Price(<?= $settings['currency'] ?>):</label>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_discounted_price[]" /></div></div>' +
            '<div class="col-md-1"><div class="form-group"><label for="stock">Stock:</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_stock[]" /></div></div>' +
            '<div class="col-md-1"><div class="form-group"><label for="unit">Unit:</label>' +
            '<select class="form-control" name="packate_stock_unit_id[]">' +
            '<?php
                foreach ($res_unit as  $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select>' +
            '</div></div>' +
            '<div class="col-md-2"><div class="form-group packate_div"><label for="qty">Status:</label><select name="packate_serve_for[]" class="form-control" required><option value="Available">Available</option><option value="Sold Out">Sold Out</option></select></div></div>' +
            '<div class="col-md-1" style="display: grid;"><label>Remove</label><a class="remove_variation text-danger" title="Remove variation of product" style="cursor: pointer;"><i class="fa fa-times fa-2x"></i></a></div>' +
            '</div>';

        $('#variations').append(html);
        $('#add_product_form').validate();
    });

    $('#add_loose_variation').on('click', function() {
        html = '<div class="row"><div class="col-md-4"><div class="form-group"><label for="measurement">Measurement</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="loose_measurement[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group loose_div">' +
            '<label for="unit">Unit:</label><select class="form-control" name="loose_measurement_unit_id[]">' +
            '<?php
                foreach ($res_unit as  $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select></div></div>' +
            '<div class="col-md-3"><div class="form-group"><label for="price">Price  (<?= $settings['currency'] ?>):</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="loose_price[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="discounted_price">Discounted Price(<?= $settings['currency'] ?>):</label>' +
            '<input type="number" step="any"  min="0" class="form-control" name="loose_discounted_price[]" /></div></div>' +
            '<div class="col-md-1" style="display: grid;"><label>Remove</label><a class="remove_variation text-danger" title="Remove variation of product" style="cursor: pointer;"><i class="fa fa-times fa-2x"></i></a></div>' +
            '</div>';
        $('#variations').append(html);
    });
</script>
<script>
    $('#add_student_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            measurement: "required",
            price: "required",
            quantity: "required",
            image: "required",
            category_id: "required",
            stock: "required",
            discounted_price: {
                lessThanEqual: "#price"
            },
            description: {
                required: function(textarea) {
                    CKEDITOR.instances[textarea.id].updateElement();
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                    return editorcontent.length === 0;
                }
            },
            pincode_ids_inc: {
                empty: {
                    depends: function(element) {
                        return $("#pincode_ids_exc").is(":blank");
                    }
                }
            }

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>