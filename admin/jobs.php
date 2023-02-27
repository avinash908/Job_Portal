<?php 
include '../Db.php';
session_start();
if (!isset($_SESSION['admin-id'])) {
  header("location:login.php");
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
            <li class="breadcrumb-item active">Available Jobs</li>
          </ol>
          <hr>
          <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                         <th>Serail No</th>
                         <th>Posted By</th>
                         <th>Job</th>
                         <th>Type</th>
                         <th>Salary</th>
                         <th>Province</th>
                         <th>City</th>
                         <th>Descrimination</th>
                         <th>Date AND Time Of POST</th>
                         <th>Edit</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                         <th>Serail No</th>
                         <th>Posted By</th>
                         <th>Job</th>
                         <th>Type</th>
                         <th>Salary</th>
                         <th>Province</th>
                         <th>City</th>
                         <th>Descrimination</th>
                         <th>Date AND Time Of POST</th>
                         <th>Edit</th>
                    </tr>
                  </tfoot>
                  <tbody>
          <?php 
                    $sno = 1;
                    $user = Db::all_jobs();
                    while ($res = $user->fetch_object()) {?>
                    <tr>
                      <td><?php echo $sno++; ?></td>
                      <td><?php echo $res->employername ; ?></td>
                      <td><?php echo $res->title; ?></td>
                      <td><?php echo $res->type; ?></td>
                      <td><?php echo $res->salary; ?></td>
                      <td><?php echo $res->province; ?></td>
                      <td><?php echo $res->city; ?></td>
                      <td><?php echo $res->descrimination; ?></td>
                      <td><?php echo $res->date_time; ?></td>
                      <td>
                        <form action="action.php" method="post">
                        <?php echo "<input type='hidden' name='jid' value='".$res->id."' >"; ?>  
                        <input type="submit" value="DELETE" class="btn btn-danger" name="delete">
                        </form> 
                      </td>
                    </tr>
          <?php }?>
          </tbody>
        </table>
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
