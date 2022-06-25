<?php
if (isset($_POST['btnView'])) {
    $batchspin = $_POST['batch'];
    $departmentspin = $_POST['department'];
    $semesterselect = $_POST['semester'];
    $testtypeselect = $_POST['testtype'];

}
$batchspin = isset($batchspin) ? $batchspin : '';
$departmentspin = isset($departmentspin) ? $departmentspin : '';
$semesterselect = isset($semesterselect) ? $semesterselect : '';
$testtypeselect = isset($testtypeselect) ? $testtypeselect : '';
$sql = "SELECT * FROM `internalmarks` WHERE batch = '$batchspin' AND department = '$departmentspin' AND semester = '$semesterselect' AND test_type = '$testtypeselect' GROUP BY subject_code";
$db->sql($sql);
$result = $db->getResult();
$num = isset($batchspin) ? $db->numRows($result) : 0;
?>
<section class="content-header">
    <h1>
        Internal Marks /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
</section>
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-xs-12">
                <div class="box">
                    <form method="post" enctype="multipart/form-data">
                                            <!-- <div class="col-xs-6"> -->
                    <div class="box-header">

                    <div class="form-group col-md-2">
                                        <h4 class="box-title"> Batch</h4>
                                        <select name='batch' id='batch' class='form-control' placeholder='Enter the Batch'>
                                            <option value="">ALL</option>
                                                    <?php
                                                    $batch = $_SESSION['batch'];
                                                    $sql = "SELECT year FROM `batch` WHERE  year IN ($batch) ";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['year'] ?>' <?=$batchspin == $value['year'] ? ' selected="selected"' : '';?>><?= $value['year'] ?></option>
                                                    <?php } ?>

                                                </select>
                                        </select>
                                </div>
                    <div class="form-group col-md-3">
                            <h4 class="box-title">Choose Department</h4>
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
                                            <option value='<?= $value['department'] ?>' <?=$departmentspin == $value['department'] ? ' selected="selected"' : '';?>><?= $value['department'] ?></option>
                                        <?php } ?>

                            </select>
                        </div>
                        
                        <div class="form-group col-md-2">
                                    <h4 class="box-title"> Semester</h4>
                                    <select id='semester' name="semester" class='form-control'>
                                        <?php
                                        $sql = "SELECT semester FROM `semester`";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['semester'] ?>' <?=$semesterselect == $value['semester'] ? ' selected="selected"' : '';?>><?= $value['semester'] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Choose Test</h4>
                            <select id='testtype' name="testtype" class='form-control'>
                            
                                        <?php
                                        $sql = "SELECT test_type FROM `test_type`";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['test_type'] ?>' <?=$testtypeselect == $value['test_type'] ? ' selected="selected"' : '';?>><?= $value['test_type'] ?></option>
                                        <?php } ?>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn-primary btn" value="View" name="btnView" />
                        

                        </div>
                        
                    </div>
                            
                    </form>
                    <?php
                    
                    if($num > 0){
                    ?>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='internalmarks_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=internalmarks" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","excel"]' data-export-options='{
                            "fileName": "students-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="reg_no" data-sortable="true">Roll.No</th>
                                    <?php
                                    $sql = "SELECT * FROM `internalmarks` WHERE batch = '$batchspin' AND department = '$departmentspin' AND semester = '$semesterselect' AND test_type = '$testtypeselect' GROUP BY subject_code";
                                    $db->sql($sql);
                                    $result = $db->getResult();
                                    

                                    foreach ($result as $value) {?>
                                        <th data-field="<?= $value['subject_code'] ?>" data-sortable="true"><?= $value['subject_code'] ?></th> 
                                         <?php   } ?>
                                
                                    <?php if($_SESSION['role'] == 'CC'){?>
                                    <th data-field="operate" data-events="actionEvents">Action</th>
                                    <?php }?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <?php }else{
                        echo "<h3 class='text-center'>No Data Found</h3>";
                    } ?>
                                        <?php
                    
                    if($num > 0){
                    ?>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='analysis_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=internalanalysis"  data-show-refresh="true" data-side-pagination="server" data-pagination="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","excel"]' data-export-options='{
                            "fileName": "students-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="title">Title</th>
                                    <?php
                                    $sql = "SELECT * FROM `internalmarks` WHERE batch = '$batchspin' AND department = '$departmentspin' AND semester = '$semesterselect' AND test_type = '$testtypeselect' GROUP BY subject_code";
                                    $db->sql($sql);
                                    $result = $db->getResult();
                                    

                                    foreach ($result as $value) {?>
                                        <th data-field="<?= $value['subject_code'] ?>" data-sortable="true"><?= $value['subject_code'] ?></th> 
                                         <?php   } ?>
                                
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <?php }?>
                </div>
                <!-- /.box -->
            </div>
            <div class="separator"> </div>
        </div>
        <!-- /.row (main row) -->
    </section>

<script>
    $('#seller_id').on('change', function() {
        $('#products_table').bootstrapTable('refresh');
    });
    $('#reg_no').on('change', function() {
        $('#internalmarks_table').bootstrapTable('refresh');
    });
    $('#department').on('change', function() {
        $('#internalmarks_table').bootstrapTable('refresh');
    });
    $('#number').on('change', function() {
        $('#internalmarks_table').bootstrapTable('refresh');
    });
   
    

    function queryParams(p) {
        return {
            "batch": $('#batch').val(),
            "department": $('#department').val(),
            "semester": $('#semester').val(),
            "testtype": $('#testtype').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }
</script>
<script>
    $('#category_id').on('change', function() {
        id = $('#category_id').val();
        $('#products_table').bootstrapTable('refresh');
    });

    window.actionEvents = {
        'click .set-product-deactive': function(e, value, rows, index) {
            var p_id = $(this).data("id");
            $.ajax({
                url: 'public/db-operation.php',
                type: "get",
                data: 'id=' + p_id + '&product_status=1&type=deactive',
                success: function(result) {
                    if (result == 1)
                        $('#products_table').bootstrapTable('refresh');
                    else
                        alert('Error! Product could not be deactivated.');
                }
            });

        },
        'click .set-product-active': function(e, value, rows, index) {
            var p_id = $(this).data("id");
            $.ajax({
                url: 'public/db-operation.php',
                type: "get",
                data: 'id=' + p_id + '&product_status=1&type=active',
                success: function(result) {
                    if (result == 1)
                        $('#products_table').bootstrapTable('refresh');
                    else
                        alert('Error! Product could not be deactivated.');
                }
            });
        }


    };
    $('#reg_no').select2({
        width: 'element',
        placeholder: 'Type in reg_no to search',

    });
</script>