<?php
// Initialize the session
session_start();
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
		  <?php 
            // Check if the user is logged in, if not then redirect him to login page
            if (!isset($_SESSION["authenticated"])) {
            ?>
                <li class="nav-item px-2">
                    <a class="btn btn-outline-primary me-2" href="login.php">Login</a>
                </li>
                <li class="nav-item px-2">
                    <a class="btn btn-outline-primary" href="register.php">Register</a>
                </li>
            <?php } else { ?>
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
            <?php } ?>
		  </ul>
		</div>
	  </div>
    </nav>





    <div class="py-5">
		<div class="container">

		  <h1 class="pb-5 text-center fw-light"><strong>Products</strong></h1>
		  <div class="row">
			<div class="col-md-4 my-2">
			  <div class="card shadow-sm">
				<img src="https://www.cdiscount.com/pdt2/e/b/l/1/700x700/samgalas20febl/rw/samsung-galaxy-s20fe-bleu.jpg" class="card-img-top" alt="..."/>
				<div class="card-body">
				  <h5 class="card-title">SAMSUNG Galaxy S20 FE</h5>
				  <p class="card-text">This is the phone for people who want it all. This is the phone tailor-made for fans of all kinds like you.</p>
				  <a class="btn btn-sm btn-outline-primary" href="" role="button">Details</a>
				</div>
			  </div>
			</div>
			<div class="col-md-4 my-2">
			  <div class="card shadow-sm">
				<img src="https://www.cdiscount.com/pdt2/2/8/n/1/700x700/samgalaxs21u128n/rw/samsung-galaxy-s21-ultra-128go-noir.jpg" class="card-img-top" alt="..."/>
				<div class="card-body">
				  <h5 class="card-title">SAMSUNG Galaxy S21 Ultra</h5>
				  <p class="card-text">This is the phone for people who want it all. This is the phone tailor-made for fans of all kinds like you.</p>
				  <a class="btn btn-sm btn-outline-primary" href="" role="button">Details</a>
				</div>
			  </div>
			</div>
			<div class="col-md-4 my-2">
			  <div class="card shadow-sm">
				<img src="https://www.cdiscount.com/pdt2/2/8/s/1/700x700/samgalaxs21p128s/rw/samsung-galaxy-s21-plus-128go-silver.jpg" class="img-fluid"/>

				<div class="card-body">
				  <h5 class="card-title">SAMSUNG Galaxy S21 Plus</h5>
				  <p class="card-text">This is the phone for people who want it all. This is the phone tailor-made for fans of all kinds like you.</p>
				  <a class="btn btn-sm btn-outline-primary" href="" role="button">Details</a>
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