<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log-in</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<?php
// Start a new session or resume the existing session
session_start();

// Initialize the error message variable to null
$login_error_message = null;

// Check if there is an error message stored in the session
if (isset($_SESSION['login_error_message'])) {
    // Assign the session error message to the login_error_message variable
    $login_error_message = $_SESSION['login_error_message'];

    // Unset the error message from the session to clear it
    unset($_SESSION['login_error_message']);
}

// Define the function handleLogin to process the login form
function handleLogin()
{
    // Check if the form was submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve email and password from the POST data
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Database credentials
        $servername = "localhost";
        $username = "root";
        // Your password here
        $password = "e75if/T8]y2e(At3";
        $dbname = "it1150";

        // Create connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check if there was a connection error and terminate if there was no connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare a SQL statement to check the user's credentials
        $getUserStatement = $connection->prepare("SELECT user_id, password FROM users WHERE email = ?");
        // Bind the email parameter to the prepared getUserStatement
        $getUserStatement->bind_param("s", $email);
        // Execute the prepared getUserStatement
        $getUserStatement->execute();
        // Store the result of the execution
        $getUserStatement->store_result();

        // Check if exactly one user is found
        if ($getUserStatement->num_rows == 1) {
            // Bind the result variables to the corresponding columns from the database
            $getUserStatement->bind_result($userId, $hashedPassword);
            // Fetch the data from the result
            $getUserStatement->fetch();
            // Verify the password against the hashed password from the database
            if (password_verify($pass, $hashedPassword)) {
                // Set session variables for email and user ID
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $userId;
                // Redirect to index.php or another target page after successful login
                header("Location: index.php");
                exit();
            } else {
                // Set an error message in the session if the password is incorrect
                $_SESSION['login_error_message'] = "Invalid email or password";
            }
        } else {
            // Set an error message in the session if the user is not found
            $_SESSION['login_error_message'] = "User not found";
        }
        // Close the getUserStatement
        $getUserStatement->close();
        // Close the database connection
        $connection->close();

        // Redirect to the same page to prevent form resubmission on page refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleLogin();
}
?>

<body>
    <div class="container">
        <div class="row centered">
            <div class="col-md-6 col-lg-4">
                <form method="post" class="card p-4">
                    <h1 class="h3 mb-3 text-center">Log-in</h1>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Log-in</button>
                    <p>
                        <a href="./signup.php" class="">Register an account</a>
                    </p>
                </form>

                <!-- ERROR MESSAGE -->
                <?php
                // Check if the login_error_message variable is not null
                if ($login_error_message != null) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        // Display the login_error_message content inside the alert div
                        echo $login_error_message;
                        ?>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>