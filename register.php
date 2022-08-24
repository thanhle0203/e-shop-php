<?php
/*
To authenticate the users, the server must define a session 
identifier (SID) for each user. This identifier must be included 
in all the user requests. It is generally included within a cookie.

The server creates a file for every session to store the session 
data. This file is located on the server and is identified by the 
session identifier.

session_start() allows the server either to create a new session 
(and a new session identifier) or to resume the existing session 
based on the received session identifier. Then the server reads the 
session data from the session file and fills the $_SESSION array. 
When a new value is added to $_SESSION, it will be saved into the 
session file. Therefore, $_SESSION allows us to read and to write 
session data.
*/

// Initialize the session
session_start();

// logged in users are redirected to the orders page
if(isset($_SESSION["authenticated"])){
    header("location: orders.php");
    exit;
}

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$error = "";
if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    //this do-while allows us to cancel the loop if any validation fails
    do {
        /************************* validate first_name *************************/
        if (empty($first_name)) {
            $error = "First name is required";
            break;
        }

        /************************** validate last_name *************************/
        if (empty($last_name)) {
            $error = "Last name is required";
            break;
        }

        /********* validate email: check that email is not already used ********/

        //check email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email format is not valid";
            break;
        }

        $hostname = "localhost";
        $username = "root";
        $dbname = "shop";
        $password = "";

        //server: localhost, mysql_user: root, password: , database: shop
        $dbConnection = new mysqli($hostname, $username, $password, $dbname);

        // Check connection
        if ($dbConnection->connect_error) {
          die("Connect Error: " . $dbConnection->connect_error);
        }
        echo "Connected Successfully";

        //Let use prepared statements to avoid "sql injection attacks"
        $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");

        // Bind variables to the prepared statement as parameters
        $statement->bind_param('s', $email);

        // execute statement
        $statement->execute();

        // check if email is already in the database
        $statement->store_result();
        if ($statement->num_rows > 0) {
            $error = "Email is already used";
            break;
        }

        //close this statement otherwise we cannot prepare another statement
        $statement->close();


        /**************************** validate phone ***************************/
        if (strlen($phone) < 6) {
            $error = "Phone must have at least 6 characters";
            break;
        }

        /************************** validate password **************************/
        if (strlen($password) < 6) {
            $error = "Password must have at least 6 characters";
            break;
        }

        /******************** validate password_confirmation *******************/
        if ($password_confirmation != $password) {
            $error = "Password confirmation does not match";
            break;
        }

        /************** All fields are valide: create a new user ***************/
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        //Let use prepared statements to avoid "sql injection attacks"
        $statement = $dbConnection->prepare("INSERT INTO users (first_name, last_name, email, phone, password, created_at) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind variables to the prepared statement as parameters
        $statement->bind_param('ssssss', $first_name, $last_name, $email, $phone, $hashed_password, $created_at);

        // execute statement
        $statement->execute();

        $insert_id = $statement->insert_id;
        $statement->close();

        /********** A new account is created **********/   
		
        // Save session data
        $_SESSION["authenticated"] = true;
        $_SESSION["id"] = $insert_id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["hashed_password"] = $hashed_password;
        $_SESSION["created_at"] = $created_at;
        
        // Redirect user to orders page
        header("location: orders.php");
        exit;
    } while(false);
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
			    <a class="btn btn-outline-primary me-2" href="login.php">Login</a>
			</li>
			<li class="nav-item px-2">
			    <a class="btn btn-primary" href="register.php">Register</a>
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
                    <form class="form-horizontal" method="POST">
					    <h3 class="mb-3 font-weight-normal text-center pb-4">Create new Account</h3>
					
					
						<div class="row mb-3">
							<label for="first_name" class="col-sm-4 col-form-label">First Name</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<label for="email" class="col-sm-4 col-form-label">Email</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<label for="phone" class="col-sm-4 col-form-label">Phone Number</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<label for="password" class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
							  <input type="password" class="form-control" id="password" name="password">
							</div>
						</div>
						<div class="row mb-3">
							<label for="password_confirmation" class="col-sm-4 col-form-label">Confirm Password</label>
							<div class="col-sm-8">
							  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							</div>
						</div>
						
						<div class="row mb-3">
							<div class="offset-sm-4 col-sm-8">
							<?php 
                                if (!empty($error)) {
                                    echo "<p style='color:red;'>$error</p>"; 
                                }
                            ?>
							  <button type="submit" class="btn btn-primary">Register</button>
							</div>
						</div>
					

                    </form>
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