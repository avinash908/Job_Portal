<?php 
include 'Db.php';
session_start();
if (!isset($_SESSION['user-id'])) {
  header("location:login.php");
}

?>
<?php
  $id= $_SESSION['user-id'];
  $records = Db::user_rec($id);
  if ($res = $records->fetch_object()) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>JOB TODAY</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
  require 'links.php';
?>
<script type="text/javascript">
$(document).ready(function () {
  $("#province").change(function () {
    var pro_id = $("#province").val();
    $.ajax({
      url : "action.php",
      method : "POST",
      data : {
        pro_id:pro_id,
      },
      success:function (data) {
        $("#city").html(data);
      }
    })
  })
})
</script>
</head>
<body>
  <?php 
    require 'header.php';
  ?>
<div class="container text-center">    
  <div class="row">
    <div class="col-md-2 well">
      <div class="well">
        <p> <?php echo "<a href='profile.php?id=".$res->uid."'>My Profile</a>"; ?></p>
        <img <?php echo 'src="'.$res->uid.'/'.$res->profile_img.'" ' ?> class="img-circle" height="65" width="65" alt="Avatar">
      </div>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>

    <!-- Center -->
    <div class="col-md-8">
    
        <?php 
          if ($res->status=='Employer') {
        ?>
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-title">
              <h3 style="font-size: 23px;background-color: aliceblue;padding: 20px;font-family: monospace;">Post Job</h3>
            </div>
            <div class="panel-body">
              <form action="" method="post" id="POST">
              <div class="row">
                <div class="col-md-8">
                <label>Job title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Job title" required>
                </div>
                <div class="col-md-4">
                 <label>Company :</label>
                 <input type="text" id="company" name="company" class="form-control" 
                 <?php echo "value='".$res->company."' "; ?>>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-4">
                  <label>Location :</label>
                  <select id="country" name="country" class="form-control">
                    <option value="Pakistan">Pakistan</option>
                  </select>
                  </div>
                  <div class="col-md-4">
                  <label>Province :</label>
                  <select id="province" name="province" class="form-control">
                    <option value=" ">Select Province</option>
                    <?php
                     $province = Db::province();
                      while ($provin = $province->fetch_object()) {
                        echo "<option value='".$provin->province."'>".$provin->province."</option>";
                      }
                    ?>
                  </select>
                  </div>
                  <div class="col-md-4">
                  <label>City :</label>
                  <select id="city" name="city" class="form-control" required>
                  </select>
                  </div>
                </div>
              <div class="row">
                <div class="col-md-4">
                <label>Job Type :</label>
                 <select id="type" name="type" class="form-control">
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Contract">Contract Based</option>
                  <option value="Internship">Internship</option>
                  <option value="Commission">Commission</option>
                </select>
                </div>
                <div class="col-md-4">
                <label>Salary</label>
                <input type="text" id="salary" name="salary" class="form-control" required>
                </div>
                <div class="col-md-4">
                <label>Category</label>
                  <select id="category" name="category" class="form-control">
                    <option>Select Category</option>
                    <?php
                      $categorys = Db::categories();
                      while ( $ct_grs = $categorys->fetch_object()) {
              echo "<option value='".$ct_grs->category."'>".$ct_grs->category."</option>";
                      }
                     ?>
                  </select>
                </div>
              </div>
                <label>Job Details</label>
                <textarea id="decription" name="decription" placeholder="info about Job  .." class="form-control" rows="6"></textarea><br>      
                <input type="hidden" id='pid' name="pid" <?php echo "value='".$res->uid."' "; ?>>

                <input type="hidden" id='name' name="name" 
                <?php echo "value='".$res->firstname." ".$res->lastname."' "; ?>>
                <input type="hidden" id="empic" name="empic"
                <?php echo "value='".$res->profile_img."' ";?>>
                <input type="hidden" id="date" name="date" 
                <?php echo "value='".date('d/M/Y h:i A')."' ";?>>
                <br>
                <input type="submit" value="POST" name="post" class="btn btn-primary" style="float: right;">
              </form>
              <p id="msg"></p>  
            </div>
          </div>
        </div>
        <script type="text/javascript">
          $(document).ready(function (e) {
            $("#POST").on('submit',function (e) {
              e.preventDefault();
              $.ajax({
                url : 'action.php',
                method : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success:function (data) {
                  $("#msg").html(data);
                }
              })
            })
          })
        </script>
        <?php }?>

        <?php 
          if ($res->status=='Job Seeker') {
        ?>
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <form action="" method="post" id="search-data">
                <div class="col-md-12 srch-field">
                  <label>Search Job</label>
                  <input type="text" id="search" name="search" class="form-control" placeholder="Job title or job category" required>
                </div>
              <div id="loc">
                <div class="col-md-6 srch-field">
                  <label>Location : </label>
                  <select id="province" name="province" class="form-control">
                      <option value=" ">Select Province</option>
                      <?php
                       $province = Db::province();
                        while ($provin = $province->fetch_object()) {
                          echo "<option value='".$provin->province."'>".$provin->province."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-6 srch-field">
                  <label>&nbsp;</label>
                    <select id="city" name="city" class="form-control" required>
                    </select>
                  </div>
              </div>
                <input type="submit" value="search" class="btn btn-info" style="float: right;">
              </form>
              
            </div>
          </div>
        </div>
        <script type="text/javascript">
          $(document).ready(function () {
            $("#search").click(function () {
              $("#loc").slideDown();
            })
          })
        </script>
        <script type="text/javascript">
          $(document).ready(function (e) {
            $("#search-data").on('submit',function (e) {
              e.preventDefault();
              $.ajax({
                url :'Search.php',
                method : 'POST',
                data : new FormData(this),
                processData : false,
                cache : false,
                contentType : false, 
                success:function (data) {
                  $("#timeline").html(data);
                }
              })
            })
          })
        </script>
        <p id="msg"></p>
      <div id="timeline">
      <?php 

        $jobs = Db::all_jobs();
        while ($jb = $jobs->fetch_object()) {

      ?><div class=" job_container">
          <div class="col-sm-3">
            <div class="well">
            <p><b>POSTED : BY</b></p>
             <p><?php echo "<a href='profile.php?id=".$jb->pid."'>".$jb->employername."</a>"; ?></p>
             <?php

             echo " <img src='".$jb->pid."/".$jb->employer_pic."' class='img-circle' height='55' width='55' alt='".$jb->employername."'>";
             ?>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="well job-card">
              <h3><?php echo $jb->title;?></h3>
              <span><b>Type : </b><?php echo $jb->type; ?></span>
              <br>
              <span><b>Company : </b><?php echo $jb->company; ?></span>
              <br>
              <span><b>Location : </b><?php echo $jb->province."/".$jb->city; ?></span><br>
              <p><b>Description : </b><?php echo $jb->descrimination; ?></p>
              <hr color='grey'>
              <span style="font-size: 12px;color: #07075a;"><b>posted on : </b><?php echo $jb->date_time; ?></span>
           <span><?php echo "<a  data-toggle = 'modal' data-target = '#myModal'  class='btn btn-success pull-right'>APPLY</a>"; ?></span>
           <p>&nbsp;</p>
            </div>
        </div>
  <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   <div class = "modal-dialog " style="text-align: left">
      <div class = "modal-content">  
         <div class = "modal-header">
            <button class="close" data-dismiss="modal" aria-hidden="true">&times;
            </button>
            <h4 class = "modal-title" id = "myModalLabel">
              Your Info :
            </h4>
         </div>
         <form action="#" method="post" id="applyform">
         <div class = "modal-body">
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->firstname." ".$res->lastname."' id='apname' name='apname' class='form-control' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='email' value='".$res->email."'  class='form-control' id='apemail' name='apemail' required>"; ?>
                </div>
              </div>
              <div class="row field">
                <div class="col-md-6">
              <?php echo "<input type='text' value='".$res->phone_num."'  class='form-control' id='apphone' name='apphone' required>"; ?>
                </div>
                <div class="col-md-6">
              <?php echo "<input type='hidden' id='em_id' name='em_id' value='".$jb->pid."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apjob' name='apjob' value='".$jb->title."'  class='form-control'>"; ?>
              <?php echo "<input type='hidden' id='apuid' name='apuid' value='".$res->uid."'  class='form-control'>"; ?>
                <input type="submit" value=" GO " class="btn btn-success" style="float: right;"> 
                </div>
              </div>
              <div class="row field">
                <div class="col-md-12">
                </div>
              </div>
         </div> 
         <div class = "modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
               Close
          </button> 
            
        </form>
         </div> 
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog --> 
</div> 
</div>
<script type="text/javascript">
  $(document).ready(function (e) {
    $("#applyform").on('submit',function (e) {
      e.preventDefault();
      $.ajax({
        url:'action.php',
        method:'POST',
        data: new FormData(this),
        processData: false,
        cache:false,
        contentType:false,
        success:function (data) {
          $("#msg").html(data);
        }
      })
    })
  })
</script>
      <?php } ?>
      </div> 
      
    <?php } ?>
    </div>
    <!-- Center -->
    <div class="col-md-2 well">      
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<?php 
  require 'footer.php';
?>
</body>
</html>
