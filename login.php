<?php
// Initialize the session
session_start();

// Check if the user is logged in, if yes then redirect him to orders page
if(isset($_SESSION["authenticated"])){
    header("location: orders.php");
    exit;
}

$email = "";
$error = "";
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hostname = "localhost";
    $username = "root";
    $dbname = "shop";
    $password = "";
    //server: localhost, mysql_user: root, password: , database: shop
    $dbConnection = new mysqli($hostname, $username, $password, $dbname);

    //Let use prepared statements to avoid "sql injection attacks"
    $statement = $dbConnection->prepare("SELECT id, first_name, last_name, phone, password, created_at FROM users WHERE email = ?");
    
    // Bind variables to the prepared statement as parameters
    $statement->bind_param('s', $email);

    // execute statement
    $statement->execute();

    // bind result variables
    $statement->bind_result($id, $first_name, $last_name, $phone, $hashed_password, $created_at);

    // fetch values
    if ($statement->fetch()) {
        if(password_verify($password, $hashed_password)){
            // Password is correct
            
            // Store data in session variables
            $_SESSION["authenticated"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["hashed_password"] = $hashed_password;
            $_SESSION["created_at"] = $created_at;
            
            // Redirect user to orders page
            header("location: orders.php");
            exit;
        }
    }

    $error = "Email or Password invalid";
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
			<li class="nav-item px-2">
			    <a class="btn btn-primary me-2" href="login.php">Login</a>
			</li>
			<li class="nav-item px-2">
			    <a class="btn btn-outline-primary" href="register.php">Register</a>
			</li>
		  </ul>
		</div>
	  </div>
    </nav>




    <div class="container-fluid">
        <div class="mx-auto pt-5 pb-5" style="width: 400px;">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="POST">
                        <h3 class="mb-3 font-weight-normal text-center pb-4">Welcome, please login</h3>

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
						    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password">
                            <?php 
                            if (!empty($error)) {
                                echo "<p style='color:red;'>$error</p>"; 
                            }
                            ?>
						</div>
						
						<div class="mb-3 d-grid">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					

                    </form>
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