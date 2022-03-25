<section class="content-header">
    <h1>
        Students /
        <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small>
    </h1>
    <ol class="breadcrumb">
        <a class="btn btn-block btn-default" href="add-student.php"><i class="fa fa-plus-square"></i> Add New Student</a>
    </ol>
    
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
                            <h4 class="box-title">Filter by Community</h4>
                            <form method="post">
                                <select id="community_id" name="community_id" placeholder="Select Community" required class="form-control col-xs-3" style="width: 300px;">
                                    <?php
                                    $Query = "select name, id from students";
                                    $db->sql($Query);
                                    $result = $db->getResult();
                                    if ($result) {
                                    ?>
                                        <option value="">All Students</option>
                                        <option value='<?= $row['id'] ?>'><?= $row['name'] ?></option>
                                    <?php 
                                        
                                    }
                                    ?>
                                </select>
                            </form>
                        </div>
                        <?php
                        $Query = "select id,name from seller where status=1";
                        $db->sql($Query);
                        $sellers = $db->getResult(); ?>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter Products by Seller </h4>
                            <select id='seller_id' name="seller_id" class='form-control'>
                                <option value=''>Select Seller</option>
                                <?php foreach ($sellers as $seller) { ?>
                                    <option value='<?= $seller['id'] ?>'><?= $seller['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <h4 class="box-title">Filter Products by Status </h4>
                            <select id='is_approved' name="is_approved" class='form-control'>
                                <option value=''>Select Status</option>
                                <option value="1">Approved</option>
                                <option value="2">Not-Approved</option>

                            </select>
                        </div>
                    </div>
                    <div class="box-header">
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
                                    <th data-field="department" data-sortable="true" data-visible="false">Department</th>
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
    $('#seller_id').on('change', function() {
        $('#products_table').bootstrapTable('refresh');
    });
    $('#is_approved').on('change', function() {
        $('#products_table').bootstrapTable('refresh');
    });

    function queryParams(p) {
        return {
            "category_id": $('#category_id').val(),
            "seller_id": $('#seller_id').val(),
            "is_approved": $('#is_approved').val(),
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
</script>