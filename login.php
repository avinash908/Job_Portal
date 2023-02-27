<?php
include 'Db.php';
session_start();
if (isset($_SESSION['user-id'])) {
  header("location:index.php");
}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">
<title>JOB TODAY</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" id="colors">
<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="transparent sticky-header full-width">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo" style="margin-top:15px">
			<h1><a href="index.php"><font style="font-size:25px; color:white">JOB TODAY</font></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">

			<ul class="float-right">
				
				<li><a data-toggle = "modal" data-target = "#signupModal"><i class="fa fa-user" ></i> Sign Up</a></li>
				<li><a data-toggle = "modal" data-target = "#myModal"><i class="fa fa-lock"></i> Log In</a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<!-- Banner
================================================== -->
<div id="banner" class="with-transparent-header parallax background" style="background-image: url(images/banner-home-02.jpg)" data-img-width="2000" data-img-height="1330" data-diff="300">
	<div class="container">
		<div class="sixteen columns">
			
			<div class="search-container">

				
				
				<!-- Announce -->
				<div class="announce">
					We’ve over <strong>15 000</strong> Post offers for you!
				</div>

			</div>

		</div>
	</div>
</div>


<!-- Content
================================================== -->


<!-- Modal for login -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Login
            </h4>
         </div>
         <form class="form-signin" action="login.php" method="post" id="login-form">
         
         <div class = "modal-body">
            <input type="email" name="email" placeholder="Enter Your email here" />
         </div>
         <div class = "modal-body">
            <input type="password" name="pass" placeholder="Enter Your password" />
         </div>
         
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" name="login" value="LOG IN">
               
            </input>
			<button type = "button" class = "btn btn-default" data-dismiss = "modal">
               Close
            </button>
            
        </form>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $login = Db::user_login($email,$pass);
  if ($login) {
    header("location:index.php");
  }
  else{
  echo"<script>
      $(document).ready(function () {
        swal('INCORRECT', 'EMAIL OR PASSWORD', 'error');
      })
    </script>";
  }
}
?>
<style type="text/css">
  select {
    padding: 12px;
}
</style>
<!-- Modal for sign up -->
<div class = "modal fade" id = "signupModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Fill Detail here
            </h4>
            <form method="post" action="reg.php" class="form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
            <label>Fisrt Name : </label>
              <input type="text" name="fname" placeholder="Enter Your First name" required/>
         </div>
         <div class = "modal-body">
            <label>Last Name : </label>
              <input type="text" name="lname" placeholder="Enter Your Last name" required/>
         </div>
         <div class = "modal-body">
            <label>Email : </label>
            <input type="email" name="email" placeholder="Enter Your email here" required/>
         </div>
         <div class = "modal-body">
            <label>Password :</label> 
            <input type="password" id="pass1" name="pass" placeholder="Enter Your password" required/>
         </div>
         <div class = "modal-body">
            <label>Retype Password :</label> 
            <input type="password" id="pass2" name="pass" placeholder="Enter Your password" required/>
            <p id="msg"></p>
         </div>
         <script type="text/javascript">
           $(document).ready(function () {
             $("#pass2").keyup(function () {
              var pass1 = $("#pass1").val();
              var pass2 = $("#pass2").val();
               if (pass1 == pass2) {
                  $("#msg").html("Password Matched");
                  $("#msg").css("color", "green");
               }
               else{
                $("#msg").html("Password Not Match *");
                $("#msg").css("color", "red");
               }
             })
           })
         </script>
         <div class = "modal-body">
          <label>Date Of Birth :</label>
            <select  name="bday">
              <option value=" ">Select Day</option>
              <?php 
                for ($i=1; $i<=30; $i++) { 
                  echo "<option value='".$i."'>".$i."</option>";
                }
              ?>
            </select>
           <select  name="bmonth" required>
              <option value=" ">Select Month</option>
              <?php 
                for ($i=1; $i<=12; $i++) { 
                  echo "<option value='".$i."'>".$i."</option>";
                }
              ?>
           </select>
           <select  name='byear'>
              <option value=" ">Select Year</option>
              <?php 
                for ($i=2018; $i>=1901; $i--) { 
                  echo "<option value='".$i."'>".$i."</option>";
                }
              ?>
           </select>
         </div>
         <div class = "modal-body" style="text-align: center;">
          <label><b>Gender</b></label>
          Male : <input type="radio" value="Male" name="gender"   required>
          Female : <input type="radio" value="female" name="gender"   required>
         </div>
         <div class = "modal-body">
           <label>I am :</label> 
           <select name="status" class="form-control" required>
            <option value="Job Seeker">Job Seeker</option>
            <option value="Employer">Employer</option>
          </select>
         </div>
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-success" value="SIGN UP" name="reg">
			 <button type = "button" class = "btn btn-danger" data-dismiss = "modal">
               Close
            </button>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<!-- Content
================================================== -->
<div class="container">
	<div class="five columns">
		<div class="widget">
			<img src="images/post_a_job.jpg" height="100px" width="100px"/>
		</div>

		<!-- Location -->
		<div class="widget">
			
			
		</div>

		<!-- Job Type -->
		<div class="widget">
			<h2>Find Jobs & Post Jobs</h2>

			<ul class="checkboxes">
				<li>
					<img src="images/fb-jobs.png" height="100px" width="100px"/>
					
				</li>
				
			</ul>

		</div>
	</div>
</div>
<div class="margin-top-15"></div>

<?php 
require 'footer.php';
?>

<div id="backtotop"><a href="#"></a></div>

</div>	
</div>
<!-- <script src="bootstrap/jquery-3.2.1.min.js"></script> -->
<script src="scripts/jquery-2.1.3.min.js"></script>
<!-- <script src="scripts/custom.js"></script> -->
<script src="scripts/jquery.superfish.js"></script>
<script src="scripts/jquery.themepunch.tools.min.js"></script>
<script src="scripts/jquery.themepunch.revolution.min.js"></script>
<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="scripts/jquery.flexslider-min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/jquery.magnific-popup.min.js"></script>
<script src="scripts/waypoints.min.js"></script>
<script src="scripts/jquery.counterup.min.js"></script>
<script src="scripts/jquery.jpanelmenu.js"></script>
<script src="scripts/stacktable.js"></script>
<script src="scripts/headroom.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/sweetlib.js"></script>
</body>
</html>