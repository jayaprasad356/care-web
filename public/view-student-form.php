<?php

date_default_timezone_set('Asia/Kolkata');

// session_start();

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = '$id'";
$db->sql($sql);
$res = $db->getResult();

?>
<section class="content-header">
    <h1><?php echo $res[0]['name'] ?></h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="p-5">
        <img src="https://www.deltastate.edu/student-success-center/wp-content/uploads/sites/26/2015/02/person-placeholder-300x300.jpg" style="width: 100px; height: 100px;" alt="">
    </div>
<div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td><?php echo $res[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Address</th>
                                <td><?php echo $res[0]['address'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mobile</th>
                                <td><?php echo $res[0]['mobile'] ?></td>
                            </tr>

                            <tr>
                                <th style="width: 200px">Email ID</th>
                                <td><?php echo $res[0]['email'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Parent Mobile</th>
                                <td><?php echo $res[0]['parent_mobile'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Aadhaar</th>
                                <td><?php echo $res[0]['aadhaar_number'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Date Of Birth</th>
                                <td><?php echo $res[0]['dob'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Gender</th>
                                <td><?php echo $res[0]['gender'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Nationality</th>
                                <td><?php echo $res[0]['nationality'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Religion</th>
                                <td><?php echo $res[0]['religion'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mother Tongue</th>
                                <td><?php echo $res[0]['mother_tongue'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Community</th>
                                <td><?php echo $res[0]['community'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Caste</th>
                                <td><?php echo $res[0]['sub_caste'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">District</th>
                                <td><?php echo $res[0]['district'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Blood Group</th>
                                <td><?php echo $res[0]['blood_group'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Father Name</th>
                                <td><?php echo $res[0]['father_name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mother Name</th>
                                <td><?php echo $res[0]['mother_name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Father Occupation</th>
                                <td><?php echo $res[0]['father_occupation'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mother Occupation</th>
                                <td><?php echo $res[0]['mother_occupation'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Parent Income</th>
                                <td><?php echo $res[0]['parent_income'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Type Of Stay</th>
                                <td><?php echo $res[0]['type_of_stay'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Bus Route No.</th>
                                <td><?php echo $res[0]['bus_route_no'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Boarding Point</th>
                                <td><?php echo $res[0]['boarding_point'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Reference</th>
                                <td><?php echo $res[0]['reference'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">First Graduate</th>
                                <td><?php echo $res[0]['fg'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">PSTM Scholar</th>
                                <td><?php echo $res[0]['pstm_sch'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">NSP</th>
                                <td><?php echo $res[0]['nsp'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">BC MBC Scholar</th>
                                <td><?php echo $res[0]['bc_mbc_sch'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">TNEA No</th>
                                <td><?php echo $res[0]['tnea_no'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Consortium No</th>
                                <td><?php echo $res[0]['consortium_no'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Consortium Marks</th>
                                <td><?php echo $res[0]['consortium_marks'] ?></td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    
                        
                    
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 400px"><p class="text-primary">SSLC Educational Details</p></th>
                            </tr>
                            <tr>
                                <th style="width: 200px">SSLC School</th>
                                <td><?php echo $res[0]['sslc_school'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">SSLC Medium</th>
                                <td><?php echo $res[0]['sslc_medium'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Educational Board</th>
                                <td><?php echo $res[0]['sslc_board'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Year Of Passing</th>
                                <td><?php echo $res[0]['sslc_year'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">SSLC Percentage</th>
                                <td><?php echo $res[0]['sslc_percentage'] ?> %</td>
                            </tr>
                            <tr>
                                <th style="width: 400px"><p class="text-primary">HSC Educational Details</p></th>
                            </tr>
                            <tr>
                                <th style="width: 200px">HSC School</th>
                                <td><?php echo $res[0]['hsc_school'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">HSC Medium</th>
                                <td><?php echo $res[0]['hsc_medium'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Educational Board</th>
                                <td><?php echo $res[0]['hsc_board'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Year Of Passing</th>
                                <td><?php echo $res[0]['hsc_year'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">HSC Percentage</th>
                                <td><?php echo $res[0]['hsc_percentage'] ?> %</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Maths</th>
                                <td><?php echo $res[0]['maths'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Physics</th>
                                <td><?php echo $res[0]['physics'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Chemistry</th>
                                <td><?php echo $res[0]['chemistry'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Average</th>
                                <td><?php echo $res[0]['average'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Cut Off</th>
                                <td><?php echo $res[0]['cut_off'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Total</th>
                                <td><?php echo $res[0]['total'] ?></td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    
                        
                    
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script>
    $('#add_offer_form').validate({
        rules: {
            budget_id: "required",
            

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
    
</script>

<script>
    $('#add_offer_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        if ($("#add_offer_form").validate().form()) {
            if(document.getElementById("wastage").value != '' || document.getElementById("pricegram").value != ''){
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    beforeSend: function() {
                        $('#submit_btn').html('Please wait..');
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        $('#result').html(result);
                        $('#result').show().delay(6000).fadeOut();
                        $('#submit_btn').html('Add');
                    
                        $('#add_offer_form')[0].reset();
                        
                    }
                });

            }else{
                alert("Enter Atleast Wastage or Discount Per gram")
            }
        

            
            

        }
    
    });
</script>
<script>
    document.getElementById('valid').valueAsDate = new Date();

</script>
