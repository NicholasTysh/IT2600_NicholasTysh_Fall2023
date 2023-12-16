<?php
session_start();
$title = "Sign-up Page";
// Include the navigation bar and database connection
include './navbar.php';
include './connection.php';

// Initialize the error message variable to null
$register_error_message = null;

// Check if an error message is stored in the session (from previous signup attempts)
if (isset($_SESSION['register_error_message'])) {
    // Retrieve and store the error message from the session
    $register_error_message = $_SESSION['register_error_message'];
    // Clear the error message from the session for future requests
    unset($_SESSION['register_error_message']);
}

// Function to handle the signup process
function handleSignup()
{
    // Access the global database connection object
    global $conn;

    // Process the form data if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect user input from form fields
        $userId = $_POST['userId'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Prepare SQL statement to check if user ID already exists
        $checkForExistingUser = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $checkForExistingUser->bind_param("s", $userId);
        $checkForExistingUser->execute();
        $result = $checkForExistingUser->get_result();
        $checkForExistingUser->close();

        // Check if the user ID already exists in the database
        if ($result->num_rows > 0) {
            // Set an error message and redirect back to the signup page
            $_SESSION['register_error_message'] = "User I.D. already exists";
        } else {
            // Hash the password for secure storage in the database
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Prepare SQL statement to insert the new user into the database
            $createNewUser = $conn->prepare("INSERT INTO users (user_id, email, password) VALUES (?, ?, ?)");
            $createNewUser->bind_param("sss", $userId, $email, $hash);

            // Execute the statement and check for successful insertion
            if ($createNewUser->execute()) {
                // Close the statement
                $createNewUser->close();

                // Set a success message in the session
                $_SESSION['signup_success_message'] = "Account successfully created. Please login.";

                // Redirect to the login page on success
                header("Location: login.php");
                exit();
            } else {
                // Display an error message if the insertion fails
                echo "Error: " . $createNewUser->error;
            }

            // Close the statement
            $createNewUser->close();
        }

        // Close the database connection
        $conn->close();

        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Check if the form is submitted and call the handleSignup function
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleSignup();
}
?>

<body>
    <div class="container">
        <div class="row centered">
            <div class="col-md-6 col-lg-4">
                <!-- Signup form -->
                <form method="post" class="card p-4">
                    <h1 class="h3 mb-3 text-center">Register</h1>
                    <div class="mb-3">
                        <label for="userId" class="form-label">User ID:</label>
                        <input type="text" class="form-control" name="userId" id="userId" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register an account</button>
                    <p>
                        Already registered?
                        <br>
                        <a href="./login.php" class="">Login instead</a>
                    </p>
                </form>

                <?php
                // Display the error message if it exists
                if ($register_error_message != null) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $register_error_message;
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>