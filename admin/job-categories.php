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
    <style type="text/css">
      .ct-inputs{padding: 22px;}
      li{display: inline;}
    </style>
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
            <li class="breadcrumb-item active">Categories</li>
          </ol>
          <hr>
         <div class="container">
          <div class="row">
              <div class="col-md-4 ct-inputs">
              <form action="" method="post">
                <label><b>Delete Category</b></label>
                <select class="form-control" name="del_catgry">
                  <option value=" "> Select Category for Delete</option>
                  <?php
                  $categories = Db::categories();
                  while ($ctgry = $categories->fetch_object())
                  echo "<option value='".$ctgry->id."'>".$ctgry->category. "</option>";
                   ?>
                </select>
              </div>
              <div class="col-md-2 ct-inputs">
                 <label>&nbsp;</label>
                <input type="submit" value='DELETE' name="delete" class="btn btn-danger btn-block" style="border-radius: 0px;">
              </form>
              </div>
            <div class="col-md-4 ct-inputs">
              <label><b>Add More Categories</b></label>
              <input type="text" id='ctgry' class="form-control">   
            </div>
            <div class="col-md-2 ct-inputs">
              <label>&nbsp;</label>
              <button id="add" class="btn btn-success btn-block" style="border-radius: 0px;">ADD</button>
            </div>
          <script type="text/javascript">
            $(document).ready(function () {
              $("#add").click(function () {
                var catgry = $("#ctgry").val();
                if (catgry != '') { 
                  $.ajax({
                    url : "action.php",
                    method : "POST",
                    data : {
                      catgry:catgry,
                    },
                    success:function(data) {
                      $("#output").html(data);
                    }
                  })
                }
              })
            })
          </script>
          </div>
              <div class="col-md-12 ct-inputs" id="output"> 
                <h4><b>Categories</b></h4>
                <ul style="list-style-type:circle">          
                  <?php
                  $categories = Db::categories();
                  while ($ctgry = $categories->fetch_object())
                  echo "<li>".$ctgry->category. ", &nbsp; </li>";
                   ?>
               </ul>
              </div>
         </div>
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © JOB TODAY Website 2018</span>
            </div>
          </div>
        </footer>
        <?php 
          if (isset($_POST['delete'])) {
            $catgry_id = $_POST['del_catgry'];
            if ($catgry_id != ' ') {
              $deleted = Db::delete_category($catgry_id);
            }
          }
        ?>
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
