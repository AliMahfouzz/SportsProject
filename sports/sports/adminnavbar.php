<header class="header_section  bg-primary">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container p-0">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" alt="">
        <span>
          Sports
        </span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <div class="d-flex flex-column flex-lg-row align-items-center  m-0">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="accountlist.php">Accounts Approval</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="eventlist.php">View Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="questions.php">View Questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="subscriptions.php">View Subscriptions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reservedevents.php">View Reserved Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addgameequipment.php">Add game equiment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="usersequipments.php">Users equiment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="equipmentlist.php">Equiment</a>
            </li>
          </ul>
        </div>
        <div class="quote_btn-container">
          <div class="dropdown">
            <a href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span><?php echo $_SESSION["username"]; ?></span>
              <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>

            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropdownList" style="left: -50px;">
              <a class="dropdown-item text-dark" href="profile.php"><small>Profile</small></a>
              <a class="dropdown-item  text-dark" href="logout.php"><small>Logout</small></a>

            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<script>
$("#dropdownMenuButton").on("click",function(){
  $("#dropdownList").toggleClass("show")
})
  </script>
 