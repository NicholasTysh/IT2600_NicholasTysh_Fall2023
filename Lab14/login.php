<?php
session_start();
$title = "Sign-up Page";
// Including navbar and database connection files
include './navbar.php';
include './connection.php';

// Initialize the login error message variable to null
$login_error_message = null;
// Initialize the signup success message variable to null
$signup_success_message = null;

// Check for a login error message in the session
if (isset($_SESSION['login_error_message'])) {
    $login_error_message = $_SESSION['login_error_message'];
    unset($_SESSION['login_error_message']);
}

// Check for a signup success message in the session
if (isset($_SESSION['signup_success_message'])) {
    $signup_success_message = $_SESSION['signup_success_message'];
    unset($_SESSION['signup_success_message']);
}

// Function to handle login process
function handleLogin()
{
    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST['userId'];
        $pass = $_POST['password'];

        // Prepare SQL statement to check user credentials
        $getUserStatement = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $getUserStatement->bind_param("s", $userId);
        $getUserStatement->execute();
        $result = $getUserStatement->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['login_error_message'] = "Invalid user id or password";
                header("Location: login.php"); // Redirect back to the login page
                exit();
            }
        } else {
            $_SESSION['login_error_message'] = "User not found";
            header("Location: login.php"); // Redirect back to the login page
            exit();
        }
        $getUserStatement->close();
    }
}

// Call handleLogin function on POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handleLogin();
}
?>

<body>
    <div class="container">
        <div class="row centered">
            <div class="col-md-6 col-lg-4">
                <!-- Login form structure -->
                <form method="post" class="card p-4">
                    <h1 class="h3 mb-3 text-center">Login</h1>
                    <div class="mb-3">
                        <label for="userId" class="form-label">User ID:</label>
                        <input type="text" class="form-control" name="userId" id="userId" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <p>
                        <a href="./signup.php" class="">Register an account</a>
                    </p>
                </form>
                <!-- Display login and signup success messages -->
                <?php if ($login_error_message != null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $login_error_message; ?>
                    </div>
                <?php endif; ?>

                <?php if ($signup_success_message != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $signup_success_message; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>