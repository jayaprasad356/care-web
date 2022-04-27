<section class="content-header">
    <h1>
        Students /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-student.php"><i class="fa fa-plus-square"></i> Add New Student</a>
    </ol> -->
    
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
                                <option value="">ALL</option>
                                        <?php
                                        $department = $_SESSION['department'];
                                        $sql = "SELECT department FROM `department` WHERE department IN ('$department') ";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
                                        <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Community </h4>
                            <select id='community' name="community" class='form-control'>
                                <option value="">ALL</option>
                                <option value="MBC">MBC</option>
                                <option value="BC">BC</option>
                                <option value="SC">SC</option>
                                <option value="OC">OC</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter by Batch</h4>
                            <select name='batch[]' id='batch' class='form-control' placeholder='Enter the Batch'>
                                <option value="">ALL</option>
                                        <?php
                                        $batch = $_SESSION['batch'];
                                        $sql = "SELECT year FROM `batch` WHERE  year IN ($batch) ";
                                        $db->sql($sql);
                                        $result = $db->getResult();
                                        foreach ($result as $value) {
                                        ?>
                                            <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                        <?php } ?>

                                    </select>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id='students_table' class="table table-hover" data-toggle="table" data-url="api-firebase/get-bootstrap-table-data.php?table=students" data-page-list="[5, 10, 20, 50, 100, 200]" data-show-refresh="true" data-show-columns="true" data-side-pagination="server" data-pagination="true" data-search="true" data-trim-on-search="false" data-filter-control="true" data-query-params="queryParams" data-sort-name="id" data-sort-order="desc" data-show-export="true" data-export-types='["txt","excel"]' data-export-options='{
                            "fileName": "students-list-<?= date('d-m-Y') ?>",
                            "ignoreColumn": ["operate"] 
                        }'>
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th data-field="roll_no" data-sortable="true">Roll No.</th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="email" data-sortable="true">Email</th>
                                    <th data-field="mobile" data-sortable="true">Mobile</th>
                                    <th data-field="dob" data-sortable="true">DOB</th>
                                    <th data-field="batch" data-sortable="true">Batch</th>
                                    <th data-field="department" data-sortable="true">Department</th>
                                    <th data-field="community" data-sortable="true">Community</th>
                                    <th data-field="operate" data-events="actionEvents">Action</th>
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
    $('#community').on('change', function() {
        id = $('#community').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#department').on('change', function() {
        id = $('#department').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#batch').on('change', function() {
        id = $('#batch').val();
        $('#students_table').bootstrapTable('refresh');
    });
    function queryParams(p) {
        return {
            "community": $('#community').val(),
            "department": $('#department').val(),
            "batch": $('#batch').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }

</script>