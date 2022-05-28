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
                                    <th data-field="department" data-sortable="true">Department</th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="roll_no" data-sortable="true">Roll No.</th>
                                    <th data-field="register_number" data-sortable="true">Register Number</th>
                                    <th data-field="quota" data-sortable="true">Quota</th>
                                    <th data-field="regular" data-sortable="true">Regular</th>
                                    <th data-field="fg" data-sortable="true">FG</th>
                                    <th data-field="sc_sch" data-sortable="true">SC-Scholarship</th>
                                    <th data-field="nsp" data-sortable="true">NSP</th>
                                    <th data-field="bc_mbc_sch" data-sortable="true">BC/MBC-Scholarship</th>
                                    <th data-field="tnea_no" data-sortable="true">TNEA Number</th>
                                    <th data-field="consortium_no" data-sortable="true">Consortium Number</th>
                                    <th data-field="consortium_marks" data-sortable="true">Consortium Marks</th>
                                    <th data-field="gender" data-sortable="true">Gender</th>
                                    <th data-field="dob" data-sortable="true">DOB</th>
                                    <th data-field="age" data-sortable="true">Age</th>
                                    <th data-field="nationality" data-sortable="true">Nationality</th>
                                    <th data-field="religion" data-sortable="true">Religion</th>
                                    <th data-field="community" data-sortable="true">Community</th>
                                    <th data-field="sub_caste" data-sortable="true">Sub Caste</th>
                                    <th data-field="blood_group" data-sortable="true">Blood Group</th>
                                    <th data-field="father_name" data-sortable="true">Father Name</th>
                                    <th data-field="occupation" data-sortable="true">Occupation</th>
                                    <th data-field="income" data-sortable="true">Income</th>
                                    <th data-field="mother_name" data-sortable="true">Mother Name</th>
                                    <th data-field="address" data-sortable="true">Address</th>
                                    <th data-field="district" data-sortable="true">District</th>
                                    <th data-field="mobile" data-sortable="true">Mobile</th>
                                    <th data-field="alternate_student_mobile" data-sortable="true">Alternate Student Mobile</th>
                                    <th data-field="email" data-sortable="true">Email</th>
                                    <th data-field="sslc_school" data-sortable="true">SSLC School</th>
                                    <th data-field="sslc_percentage" data-sortable="true">SSLC Percentage</th>
                                    <th data-field="sslc_medium" data-sortable="true">SSLC Medium</th>
                                    <th data-field="sslc_board" data-sortable="true">SSLC Board</th>
                                    <th data-field="sslc_year" data-sortable="true">SSLC Year</th>
                                    <th data-field="hsc_school" data-sortable="true">HSC School</th>
                                    <th data-field="hsc_percentage" data-sortable="true">HSC percentage</th>
                                    <th data-field="hsc_medium" data-sortable="true">HSC Medium</th>
                                    <th data-field="hsc_board" data-sortable="true">HSC Board</th>
                                    <th data-field="hsc_year" data-sortable="true">HSC Year</th>
                                    <th data-field="year_of_passing" data-sortable="true">Year of Passing</th>
                                    <th data-field="maths" data-sortable="true">Maths</th>
                                    <th data-field="physics" data-sortable="true">Physics</th>
                                    <th data-field="chemistry" data-sortable="true">Chemistry</th>
                                    <th data-field="average" data-sortable="true">Average</th>
                                    <th data-field="cut_off" data-sortable="true">Cut off Marks</th>
                                    <th data-field="total" data-sortable="true">Total</th>
                                    <th data-field="type" data-sortable="true">Type</th>
                                    <th data-field="bus_route_no" data-sortable="true">Bus Route No</th>
                                    <th data-field="boarding_point" data-sortable="true">Boarding Point</th>
                                    <th data-field="date_of_admission" data-sortable="true">Date of Admission</th>
                                    <th data-field="aadhaar_number" data-sortable="true">Aadhaar Number</th>
                                    <th data-field="section" data-sortable="true">Section</th>
                                    <th data-field="mother_tongue" data-sortable="true">Mother Tongue</th>
                                    <th data-field="reference" data-sortable="true">Reference</th>
                                    <th data-field="type_of_city" data-sortable="true">Staying Option</th>
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