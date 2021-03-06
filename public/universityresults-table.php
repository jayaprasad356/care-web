<section class="content-header">
    <h1>
        University Results /
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
                    <!-- <div class="col-xs-6"> -->
                    <div class="box-header">
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Department</h4>
                            <select name='department[]' id='department' class='form-control' placeholder='Enter the department you want to assign Seller' >
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
                                            <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
                                        <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Roll.No</h4>
                            <select id='reg_no' name="reg_no[]" class='form-control'>
                                        <?php
                                        $role = $_SESSION['role'];
                                        if($role == 'Exam Cell'){
                                            $sql = "SELECT reg_no FROM `students` GROUP BY reg_no";
                                        }
                                        else{
                                            $department = $_SESSION['department'];
                                            $batch = $_SESSION['batch'];
                                            $sql = "SELECT reg_no FROM `students` WHERE department IN ('$department') AND batch IN ($batch) GROUP BY reg_no";
                                        }
                                        $db->sql($sql);

                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['reg_no'] ?>'><?= $value['reg_no'] ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Semester</h4>
                            <select id='semester' name="semester" class='form-control'>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='universityresults_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=universityresults" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","excel"]' data-export-options='{
                            "fileName": "students-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="reg_no" data-sortable="true">Roll.No</th>
                                    <th data-field="semester" data-sortable="true">Semester</th>
                                    <th data-field="department" data-sortable="true">Department</th>
                                    <th data-field="subject_code" data-sortable="true">Subject code</th>
                                    <th data-field="regulation" data-sortable="true">Regulation</th>
                                    <th data-field="grade" data-sortable="true">Grade</th>
                                    <?php if($_SESSION['role'] == 'Exam Cell'){?>
                                    <th data-field="operate" data-events="actionEvents">Action</th>
                                    <?php }?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
        $('#universityresults_table').bootstrapTable('refresh');
    });
    $('#semester').on('change', function() {
        $('#universityresults_table').bootstrapTable('refresh');
    });

    function queryParams(p) {
        return {
            "department": $('#department').val(),
            "reg_no": $('#reg_no').val(),
            "semester": $('#semester').val(),
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