<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-up</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<?php

// Start a new session or resume the existing session
session_start();

// Initialize the error message variable to null
$register_error_message = null;

// Check if there is an error message stored in the session
if (isset($_SESSION['register_error_message'])) {
    // Assign the session error message to the register_error_message variable
    $register_error_message = $_SESSION['register_error_message'];

    // Unset the error message from the session to clear it
    unset($_SESSION['register_error_message']);
}

// Define the function handleSignup to process the signup form
function handleSignup()
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
        $password = "your_password_here";
        $dbname = "it1150";

        // Create a new database connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check if there was a connection error and terminate if there was no connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare a statement to check if the email already exists in the database
        $checkForExistingUser = $connection->prepare("SELECT user_id FROM users WHERE email = ?");
        // Bind the email parameter to the prepared statement
        $checkForExistingUser->bind_param("s", $email);
        // Execute the prepared statement
        $checkForExistingUser->execute();

        // Get the result of the query
        $result = $checkForExistingUser->get_result();
        // Close the check for existing user statement
        $checkForExistingUser->close();

        // Check if any rows were returned (meaning the email already exists)
        if ($result->num_rows > 0) {
            // Set an error message in the session
            $_SESSION['register_error_message'] = "Username already exists";
        } else {
            // Hash the password for secure storage
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Prepare a statement to insert the new user into the database
            $createNewUser = $connection->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            // Bind the email and hashed password parameters to the prepared statement
            $createNewUser->bind_param("ss", $email, $hash);

            // Execute the prepared statement and check for success
            if ($createNewUser->execute()) {
                // Close the statement and connection
                $createNewUser->close();
                $connection->close();

                // Redirect to the login page
                header("Location: login.php");
                exit();
            } else {
                // If insertion failed, display the error
                echo "Error: " . $createNewUser->error;
            }
            // Close the statement
            $createNewUser->close();
        }

        // Close the connection
        $connection->close();

        // Redirect to the same page to prevent form resubmission on page refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Check if the form was submitted and call the handleSignup function
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleSignup();
}
?>

<body>
    <div class="container">
        <div class="row centered">
            <div class="col-md-6 col-lg-4">
                <form method="post" class="card p-4">
                    <h1 class="h3 mb-3 text-center">Sign-up</h1>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign-up</button>
                    <p>
                        Already registered?
                        <br>
                        <a href="./login.php" class="">Log-in instead</a>
                    </p>
                </form>

                <!-- ERROR MESSAGE -->
                <?php
                // Check if the register_error_message variable is not null
                if ($register_error_message != null) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        // Display the register_error_message content inside the alert div
                        echo $register_error_message;
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