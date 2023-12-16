<?php
session_start();
$title = "CourseHub Home";
include './navbar.php';

// Check if the user is not logged in (email or user ID is not set in the session)
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
?>
    <div class="container d-flex align-items-center justify-content-center mt-3">
        <div class="text-center" style="width: 50%;">
            <p>Error Getting User Data</p>
            <p>
                <!-- Link to redirect to the home page -->
                <a href="./index.html" class="btn btn-secondary">Go Home</a>
            </p>
        </div>
    </div>
<?php
    exit(); // Terminate the script if the user is not logged in
}

// User is logged in, retrieve their email and user ID from session
$userId = htmlspecialchars($_SESSION['user_id']);
$email = htmlspecialchars($_SESSION['email']);
?>

<div class="container d-flex align-items-center justify-content-center mt-3">
    <div class="text-center" style="width: 50%;">
        <h1>Welcome, <?php echo $email; ?>!</h1>
        <h4>User ID: <b><?php echo $userId; ?></b></h4>
        <!-- Logout button and links to different pages -->
        <a href="./logout.php" class="btn btn-outline-danger">Logout</a>
        <h4 class="mt-2">Things to Do</h4>
        <a href="courses.php" class="btn btn-sm btn-outline-primary">Courses</a>
        <a href="sections.php" class="btn btn-sm btn-outline-warning">Sections</a>
        <a href="schedule.php" class="btn btn-sm btn-outline-success">My Schedule</a>
    </div>
</div>

<!-- Include Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>