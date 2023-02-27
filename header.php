
<nav class="navbar navbar-inverse" style="border-radius:0px;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-briefcase"></i> JOB TODAY</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><?php 
         echo "<a href='profile.php?id=".$_SESSION['user-id']."'>";
              ?> <i class="glyphicon glyphicon-user"></i> Profile</a>
          </li>
          
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="settings.php"><i class="fas fa-cog"> </i> Settings</a>
              </li>
              <li>
                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>

            </ul>
          </li>
        <li>
            
        </li>
      </ul>
    </div>

  </div>
</nav>
