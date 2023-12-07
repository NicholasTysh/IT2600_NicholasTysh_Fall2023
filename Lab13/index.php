<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
    <?php
    // Start a new session or resume the existing session
    session_start();

    // Check if both email and user ID are set in the session
    if (!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
        // Display an error message if the required session variables are not set
    ?>
        <p>Error Getting User Data</p>
        <p>
            <!-- Provide a link to go back to the login page -->
            <a href="./login.php" class="btn btn-secondary">Go Back</a>
        </p>
    <?php
        // Terminate script execution if session variables are not set
        exit();
    }

    // Retrieve and store email and user ID from session variables
    $email = $_SESSION['email'];
    $userId = $_SESSION['user_id'];
    ?>

    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">
        <h1>Welcome, User!</h1>
        <!-- Card displaying the user data -->
        <div class="card text-center w-50 mt-4">
            <div class="card-body">
                <h5 class="card-title">User Data</h5>
                <p class="card-text"><b>Email:</b> <?php echo htmlspecialchars($email) ?></p>
                <p class="card-text"><b>User ID:</b> <?php echo htmlspecialchars($userId) ?></p>
                <!-- <a href="./logout.php" class="btn btn-primary">Logout</a> -->
            </div>
        </div>
    </div>

    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>