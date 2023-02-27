<?php 
include '../Db.php';
session_start();
if (!isset($_SESSION['admin-id'])) {
  header("location:login.php");
}
?>
<?php 
  $ad_id = $_SESSION['admin-id'];
  $ad_rec = Db::admin_rec($ad_id);
  if ($res = $ad_rec->fetch_object()) {}
?>
<?php 
if (isset($_POST['change_pass'])) {
  $current_pass = $_POST['current_pass'];
  $new_pass = $_POST['new_pass'];
  $old_pass = $res->pass;
  if ($old_pass == $current_pass) {
    $pass_chagend = Db::change_ad_pass($new_pass,$ad_id);
    if ($pass_chagend) {
      $message = "<p class='alert alert-success' id='alert'>
                  <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  Password Has Been Changed
                  </p>
                  <script>
                    $(document).ready(function(){
                      setTimeout(function(){ 
                        $( '#alert' ).fadeOut('slow');
                      }, 1500);
                    })
                  </script>";
    }
  }
  else{
    $message = "<p class='alert alert-danger'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Wrong Old Password ..
                </p>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Dashboard</title>
    <?php require 'links.php'; ?>
  </head>
  <body id="page-top">
    <?php require 'header.php'; ?>
      <div id="content-wrapper">
        <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
          <hr>
         <div class="container">
          <div class="row">
            <div class="col-md-6">
            <table class="table table-bordered">
              <form action="settings.php" method="post">
                <tr>
                  <th><h4>Change Username</h4></th>
                </tr>
                <tr>
                  <td>
                    <label><b>Current Username</b></label>
                    <label class="form-control"><b><?php echo $res->email; ?></b></label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label><b>New Username</b></label>
                    <input type="text" name="new_username" class="form-control" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="change_username" value="Change Username" class="btn btn-success btn-block">
                </td>
                </tr>
              </form>
            </table>
          </div>
            <div class="col-md-6">
            <table class="table table-bordered">
              <form action="" method="post">
                <tr>
                  <th style="color:brown"><h4>Change Password</h4></th>
                </tr>
                <tr>
                  <td>
                    <label><b>Current Passwords</b></label>
                    <input type="text" name="current_pass" class="form-control" placeholder="**************" required>
                    <div>
                   <?php if (isset($message)) {echo $message;} ?>  
                    </div
                  </td>
                </tr>
                <tr>
                  <td>
                    <label><b>New Password</b></label>
                    <input type="text" name="new_pass" class="form-control" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="change_pass" value="Change Password" class="btn btn-success btn-block">
                </td>
                </tr>
              </form>
            </table>
          </div>
          </div> 
         </div>
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © JOB TODAY Website 2018</span>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
<?php 
  if (isset($_POST['change_username'])) {
    $new_username = $_POST['new_username'];
    if ($new_username != " ") {
        $username_changed = Db::change_ad_username($new_username,$ad_id);
        if ($username_changed) {
          echo "<script>window.location.replace('settings.php')</script>";
        }
    }
  }
?>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
