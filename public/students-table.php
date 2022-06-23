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
                                <div class="form-group col-md-2">
                                        <h4 class="box-title"> Batch</h4>
                                        <select name='batch[]' id='batch' class='form-control' placeholder='Enter the Batch'>
                                            
                                                    <?php
                                                    $batch = $_SESSION['batch'];
                                                    $role = $_SESSION['role'];
                                                    if ($role == 'Admin') {
                                                        $sql = "SELECT year FROM `batch`";
                                                        ?>
                                                        <option value="">ALL</option>
                                                        <?php

                                                    }else{
                                                        $sql = "SELECT year FROM `batch` WHERE  year IN ($batch) ";
                                                    }
                                                    
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                                    <?php } ?>

                                                </select>
                                        </select>
                                </div>

                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Degree </h4>
                                    <select id='degree' name="degree[]" class='form-control'>
                                    <option value="">ALL</option>
                                                    <?php
                                                    
                                                    $sql = "SELECT degree FROM `degree`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['degree'] ?>'><?= $value['degree'] ?></option>
                                                    <?php } ?>
                                    </select>
                               </div>

                                <div class="form-group col-md-2">
                                    <h4 class="box-title"> Department</h4>
                                    <select name='department[]' id='department' class='form-control' placeholder='Enter the department you want to assign Seller' >
                                                <?php
                                                $department = $_SESSION['department'];
                                                $role = $_SESSION['role'];
                                                if ($role == 'Admin') {
                                                    $sql = "SELECT department FROM `department`";
                                                    ?>
                                                    <option value="">ALL</option>
                                                    <?php
                                                } else {
                                                    $sql = "SELECT department FROM `department` WHERE  department IN ('$department') ";
                                                
                                                }
                                                $db->sql($sql);
                                                $result = $db->getResult();
                                                foreach ($result as $value) {
                                                ?>
                                                    <option value='<?= $value['department'] ?>'><?= $value['department'] ?></option>
                                                <?php } ?>

                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <h4 class="box-title"> Section </h4>
                                    <select id='section' name="section[]" class='form-control'>
                                        <option value="">ALL</option>
                                            <?php
                                                    
                                                    $sql = "SELECT section FROM `section`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['section'] ?>'><?= $value['section'] ?></option>
                                           <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Quota</h4>
                                    <select id='quota' name="quota" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="GQ">GQ</option>
                                        <option value="MQ">MQ</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Mode</h4>
                                    <select id='mode' name="mode" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="REGULAR">REGULAR</option>
                                        <option value="LATERAL">LATERAL</option>
                                        <option value="TRANSFER">TRANSFER</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Gender </h4>
                                    <select id='gender' name="gender" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                   </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Religion</h4>
                                    <select id='religion' name="religion[]" class='form-control'>
                                        <option value="">ALL</option>
                                            <?php
                                                        
                                                        $sql = "SELECT religion FROM `religion`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['religion'] ?>'><?= $value['religion'] ?></option>
                                            <?php } ?>
                                   </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Community</h4>
                                    <select id='community' name="community[]" class='form-control'>
                                        <option value="">ALL</option>
                                            <?php
                                                        
                                                        $sql = "SELECT community FROM `community`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['community'] ?>'><?= $value['community'] ?></option>
                                            <?php } ?>
                                   </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Blood Group</h4>
                                    <select id='blood_group' name="blood_group[]" class='form-control'>
                                        <option value="">ALL</option>
                                            <?php
                                                        
                                                        $sql = "SELECT blood_group FROM `blood_group`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['blood_group'] ?>'><?= $value['blood_group'] ?></option>
                                            <?php } ?>
                                   </select>
                               </div>

                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Mother Tongue</h4>
                                    <select id='mother_tongue' name="mother_tongue" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Others">Others</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Nationality</h4>
                                    <select id='nationality' name="nationality" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Others">Others</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> SSLC medium </h4>
                                    <select id='sslc_medium' name="sslc_medium[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                    
                                                    $sql = "SELECT medium FROM `medium`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['medium'] ?>'><?= $value['medium'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">SSLC Board </h4>
                                    <select id='sslc_board' name="sslc_board[]" class='form-control'>
                                        <option value="">ALL</option>
                                                    <?php
                                                                            
                                                        $sql = "SELECT board FROM `board`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['board'] ?>'><?= $value['board'] ?></option>
                                                    <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">SSLC Year </h4>
                                    <select id='sslc_year' name="sslc_year[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                                
                                                    $sql = "SELECT year FROM `year`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Group</h4>
                                    <select id='group' name="group" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Academic">Academic</option>
                                        <option value="Vocational">Vocational</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> HSC medium </h4>
                                    <select id='hsc_medium' name="hsc_medium[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                    
                                                    $sql = "SELECT medium FROM `medium`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['medium'] ?>'><?= $value['medium'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> HSC Board </h4>
                                    <select id='hsc_board' name="hsc_board[]" class='form-control'>
                                        <option value="">ALL</option>
                                                    <?php
                                                                            
                                                        $sql = "SELECT board FROM `board`";
                                                        $db->sql($sql);
                                                        $result = $db->getResult();
                                                        foreach ($result as $value) {
                                                        ?>
                                                            <option value='<?= $value['board'] ?>'><?= $value['board'] ?></option>
                                                    <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">HSC Year </h4>
                                    <select id='hsc_year' name="hsc_year[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                                
                                                    $sql = "SELECT year FROM `year`";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['year'] ?>'><?= $value['year'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Staying Option</h4>
                                    <select id='type_of_stay' name="type_of_stay" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Hostel">Hostel</option>
                                        <option value="DayScholar">DayScholar</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">Bus Route Number </h4>
                                    <select id='bus_route_no' name="bus_route_no[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                                
                                                    $sql = "SELECT * FROM `students` WHERE bus_route_no <> ''  GROUP BY bus_route_no ";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['bus_route_no'] ?>'><?= $value['bus_route_no'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> Boarding point </h4>
                                    <select id='boarding_point' name="boarding_point[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                                
                                                
                                                    $sql = "SELECT * FROM `students` WHERE boarding_point <> ''  GROUP BY boarding_point ";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['boarding_point'] ?>'><?= $value['boarding_point'] ?></option>
                                                <?php } ?>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">First Graduate</h4>
                                    <select id='fg' name="fg" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> PSTM Scholarship</h4>
                                    <select id='pstm_sch' name="pstm_sch" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title"> NSP</h4>
                                    <select id='nsp' name="nsp" class='form-control'>
                                        <option value="">ALL</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                               </div>
                               <div class="form-group col-md-2">
                                    <h4 class="box-title">BC&MBC Sch</h4>
                                    <select id='bc_mbc_sch' name="bc_mbc_sch[]" class='form-control'>
                                        <option value="">ALL</option>
                                                <?php
                                                                
                                                
                                                    $sql = "SELECT * FROM `students` WHERE bc_mbc_sch <> ''  GROUP BY bc_mbc_sch ";
                                                    $db->sql($sql);
                                                    $result = $db->getResult();
                                                    foreach ($result as $value) {
                                                    ?>
                                                        <option value='<?= $value['bc_mbc_sch'] ?>'><?= $value['bc_mbc_sch'] ?></option>
                                                <?php } ?>
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
                                    
                                    <!-- <th data-field="id" data-sortable="true">ID</th> -->
                                    <th data-field="operate" data-events="actionEvents">Action</th>
                                    <th data-field="batch" data-sortable="true">Batch</th>
                                    <th data-field="degree" data-sortable="true">Degree</th>
                                    <th data-field="department" data-sortable="true">Department</th>
                                    <th data-field="section" data-sortable="true">Section</th>
                                    <th data-field="roll_no" data-sortable="true">Roll No.</th>
                                    <th data-field="register_number" data-sortable="true">Register Number</th>
                                    <th data-field="name" data-sortable="true">Name</th>
                                    <th data-field="quota" data-sortable="true">Quota</th>
                                    <th data-field="mode" data-sortable="true">Mode</th>
                                    <th data-field="gender" data-sortable="true">Gender</th>
                                    <th data-field="dob" data-sortable="true">DOB</th>
                                    <th data-field="religion" data-sortable="true">Religion</th>
                                    <th data-field="community" data-sortable="true">Community</th>
                                    <th data-field="sub_caste" data-sortable="true">Sub Caste</th>
                                    <th data-field="blood_group" data-sortable="true">Blood Group</th>
                                    <th data-field="mother_tongue" data-sortable="true">Mother Tongue</th>
                                    <th data-field="nationality" data-sortable="true">Nationality</th>
                                    <th data-field="aadhaar_number" data-sortable="true">Aadhaar Number</th>
                                    <th data-field="father_name" data-sortable="true">Father Name</th>
                                    <th data-field="father_occupation" data-sortable="true">Father's Occupation</th>
                                    <th data-field="mother_name" data-sortable="true">Mother Name</th>
                                    <th data-field="mother_occupation" data-sortable="true">Mother's Occupation</th>
                                    <th data-field="parent_income" data-sortable="true">Parent Income</th>
                                    <th data-field="address" data-sortable="true">Address</th>
                                    <th data-field="district" data-sortable="true">District</th>
                                    <th data-field="mobile" data-sortable="true">Mobile</th>
                                    <th data-field="parent_mobile" data-sortable="true">Parent Contact No</th>
                                    <th data-field="email" data-sortable="true">Email</th>
                                    <th data-field="sslc_school" data-sortable="true">SSLC-School</th>
                                    <th data-field="sslc_percentage" data-sortable="true">SSLC-%</th>
                                    <th data-field="sslc_medium" data-sortable="true">SSLC-Medium</th>
                                    <th data-field="sslc_board" data-sortable="true">SSLC-Board</th>
                                    <th data-field="sslc_year" data-sortable="true">SSLC-Year</th>
                                    <th data-field="group" data-sortable="true">Group</th>
                                    <th data-field="hsc_school" data-sortable="true">HSC-School</th>
                                    <th data-field="hsc_percentage" data-sortable="true">HSC-%</th>
                                    <th data-field="hsc_medium" data-sortable="true">HSC-Medium</th>
                                    <th data-field="hsc_board" data-sortable="true">HSC-Board</th>
                                    <th data-field="hsc_year" data-sortable="true">HSC-Year</th>
                                    <th data-field="maths" data-sortable="true">Maths</th>
                                    <th data-field="physics" data-sortable="true">Physics</th>
                                    <th data-field="chemistry" data-sortable="true">Chemistry</th>
                                    <th data-field="average" data-sortable="true">Average</th>
                                    <th data-field="cut_off" data-sortable="true">Cut Off</th>
                                    <th data-field="total" data-sortable="true">Total</th>
                                    <th data-field="type_of_stay" data-sortable="true">Hostel/Dayscholar</th>
                                    <th data-field="bus_route_no" data-sortable="true">Bus Route No</th>
                                    <th data-field="boarding_point" data-sortable="true">Boarding Point</th>
                                    <th data-field="reference" data-sortable="true">Reference</th> 
                                    <th data-field="fg" data-sortable="true">First Graduate</th>
                                    <th data-field="pstm_sch" data-sortable="true">PSTM Scholarship</th>
                                    <th data-field="nsp" data-sortable="true">NSP</th>
                                    <th data-field="bc_mbc_sch" data-sortable="true">BC&MBC-Scholarship</th>
                                    <th data-field="tnea_no" data-sortable="true">TNEA Allotment No.</th>
                                    <th data-field="consortium_no" data-sortable="true">Consortium No.</th>
                                    <th data-field="consortium_marks" data-sortable="true">Consortium Marks</th>
                                 <!-- <th data-field="operate" data-events="actionEvents">Action</th> -->
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
    $('#batch').on('change', function() {
        id = $('#batch').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#degree').on('change', function() {
        id = $('#degree').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#department').on('change', function() {
        id = $('#department').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#section').on('change', function() {
        id = $('#section').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#quota').on('change', function() {
        id = $('#quota').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#mode').on('change', function() {
        id = $('#mode').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#gender').on('change', function() {
        id = $('#gender').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#religion').on('change', function() {
        id = $('#religion').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#community').on('change', function() {
        id = $('#community').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#blood_group').on('change', function() {
        id = $('#blood_group').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#mother_tongue').on('change', function() {
        id = $('#mother_tongue').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#nationality').on('change', function() {
        id = $('#nationality').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#sslc_medium').on('change', function() {
        id = $('#sslc_medium').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#sslc_board').on('change', function() {
        id = $('#sslc_board').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#sslc_year').on('change', function() {
        id = $('#sslc_year').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#group').on('change', function() {
        id = $('#group').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#hsc_medium').on('change', function() {
        id = $('#hsc_medium').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#hsc_board').on('change', function() {
        id = $('#hsc_board').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#hsc_year').on('change', function() {
        id = $('#hsc_year').val();
        $('#students_table').bootstrapTable('refresh');
    }); $('#type_of_stay').on('change', function() {
        id = $('#type_of_stay').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#bus_route_no').on('change', function() {
        id = $('#bus_route_no').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#boarding_point').on('change', function() {
        id = $('#boarding_point').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#fg').on('change', function() {
        id = $('#fg').val();
        $('#students_table').bootstrapTable('refresh');
    }); $('#pstm_sch').on('change', function() {
        id = $('#pstm_sch').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#nsp').on('change', function() {
        id = $('#nsp').val();
        $('#students_table').bootstrapTable('refresh');
    });
    $('#bc_mbc_sch').on('change', function() {
        id = $('#bc_mbc_sch').val();
        $('#students_table').bootstrapTable('refresh');
    });

    function queryParams(p) {
        return {
            "batch": $('#batch').val(),
            "degree": $('#degree').val(),
            "department": $('#department').val(),
            "section": $('#section').val(),
            "quota": $('#quota').val(),
            "mode": $('#mode').val(),
            "gender": $('#gender').val(),
            "religion": $('#religion').val(),
            "community": $('#community').val(),
            "blood_group": $('#blood_group').val(),
            "mother_tongue": $('#mother_tongue').val(),
            "nationality": $('#nationality').val(),
            "sslc_medium": $('#sslc_medium').val(),
            "sslc_board": $('#sslc_board').val(),
            "sslc_year": $('#sslc_year').val(),
            "group": $('#group').val(),
            "hsc_medium": $('#hsc_medium').val(),
            "hsc_board": $('#hsc_board').val(),
            "hsc_year": $('#hsc_year').val(),
            "type_of_stay": $('#type_of_stay').val(),
            "bus_route_no": $('#bus_route_no').val(),
            "boarding_point": $('#boarding_point').val(),
            "fg": $('#fg').val(),
            "pstm_sch": $('#pstm_sch').val(),
            "nsp": $('#nsp').val(),
            "bc_mbc_sch": $('#bc_mbc_sch').val(),
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search
        };
    }

</script>