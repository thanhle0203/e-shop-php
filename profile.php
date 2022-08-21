<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["authenticated"])){
    header("location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	
    <title>My Shop</title>
	<link rel="icon" href="https://www.iconpacks.net/icons/2/free-shopping-bag-icon-2041-thumb.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

    <!-- Bootstrap javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
  </head>



  <body>
    <nav class="navbar navbar-expand-md navbar-light p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
	  <div class="container-fluid">
		<a class="navbar-brand" href="welcome.php">
		    <img src="https://www.iconpacks.net/icons/2/free-shopping-bag-icon-2041-thumb.png" width="30" height="30" class="d-inline-block align-top" alt=""> My Shop
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex">
            <li class="nav-item dropdown px-2">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				My Account
			  </a>
			  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
				<li><a class="dropdown-item" href="orders.php">Orders</a></li>
				<li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="logout.php">Logout</a></li>
			  </ul>
			</li>
		  </ul>
		</div>
	  </div>
    </nav>




<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto px-5 py-5 pt-5 pb-5">
            <div class="card">

                <div class="card-body px-5">
                    <h3 class="mb-3 font-weight-normal pb-4">My profile</h3>
                
                
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?php echo $_SESSION["first_name"]; ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Last Name</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?php echo $_SESSION["last_name"]; ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?php echo $_SESSION["email"]; ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Phone Number</label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?php echo $_SESSION["phone"]; ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<footer class="container pt-4 my-3 border-top">
    <div class="row">
        <div class="col-12 text-center">
        <img class="mb-2" src="https://www.iconpacks.net/icons/2/free-shopping-bag-icon-2041-thumb.png" alt="" width="24" height="24">
        <small class="d-block mb-3 text-muted">&copy; 2017–2021</small>
        </div>
    </div>
</footer>


</body>
</html>