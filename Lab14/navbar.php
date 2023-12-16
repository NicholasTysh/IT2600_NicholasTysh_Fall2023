<?php
// Check if user is logged in by verifying session variables
$isLoggedIn = isset($_SESSION['email']) && isset($_SESSION['user_id']);
?>

<!-- Universal Navigation Bar for the Website -->
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link rel="icon" href="./images/logo/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Navbar Brand with Conditional Link Based on User Login Status -->
            <a class="navbar-brand" href="<?php echo $isLoggedIn ? 'index.php' : 'index.html'; ?>">CourseHub</a>

            <!-- Toggler Button for Collapsible Navbar on Smaller Screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Navigation Links -->
                    <li class="nav-item"><a class="nav-link" href="sections.php">Sections</a></li>
                    <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.php">Schedule</a></li>
                </ul>

                <span class="navbar-text">
                    <?php if ($isLoggedIn) : ?>
                        <!-- Display User Data and Logout Button if Logged In -->
                        Email: <?php echo htmlspecialchars($_SESSION['email']); ?> | User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?>
                        <a href="logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
                    <?php else : ?>
                        <!-- Show Login and Register buttons if Not Logged In -->
                        <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
                        <a href="signup.php" class="btn btn-outline-primary btn-sm">Register</a>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Body and html tags are closed in the file that imports this navbar -->