<?php 
include '../Db.php';
session_start();
if (isset($_SESSION['admin-id'])) {
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <?php require 'links.php'; ?>
  </head>
  <body class="bg-dark">
   <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
              </div>
            </div>
            <input type="submit" name="login" class="btn btn-primary btn-block" href="index.html" value="login">
          </form>
          <div class="text-center">
          </div>
        </div>
      </div>
    </div>
    <?php 

      if (isset($_POST['login'])) {
          $name = $_POST['email'];
          $pass = $_POST['pass'];

         $login = Db::admin_login($name, $pass);
           if ($res = $login->fetch_object()) {
             $_SESSION['admin-id'] = $res->id;
             header("location:index.php");
           }
      }

    ?>
  </body>
</html>
