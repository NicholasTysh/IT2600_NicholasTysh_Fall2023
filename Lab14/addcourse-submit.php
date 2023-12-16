<?php
$title = "Course Added";
include './navbar.php';

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "./connection.php";

  // Retrieve and sanitize form data
  $courseid = mysqli_real_escape_string($conn, $_POST['courseid']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $credit_hrs = mysqli_real_escape_string($conn, $_POST['credit_hrs']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $prerequisites = mysqli_real_escape_string($conn, $_POST['prerequisites']);

  // Check if the course_id already exists in the database
  $checkStmt = $conn->prepare("SELECT * FROM courses WHERE course_id = ?");
  $checkStmt->bind_param("s", $courseid);
  $checkStmt->execute();
  $result = $checkStmt->get_result();

  if ($result->num_rows > 0) {
    // Course ID already exists
?>
    <div class="container d-flex align-items-center justify-content-center mt-3">
      <div class="text-center" style="width: 50%;">
        <h1>Course ID already exists in the database.</h1>
        <a href='addcourse.php'><i class='fa fa-arrow-left'></i> Try adding a different course</a>
      </div>
    </div>
    <?php
    $checkStmt->close();
  } else {
    // Course ID does not exist, proceed to insert
    $checkStmt->close(); // Close the check statement

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO courses (course_id, title, credit_hrs, description, prerequisites) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $courseid, $title, $credit_hrs, $description, $prerequisites);

    // Execute the prepared statement
    if ($stmt->execute()) {
    ?>
      <div class="container d-flex align-items-center justify-content-center mt-3">
        <div class="text-center" style="width: 50%;">
          <h1>New course successfully added!</h1>
          <a href='courses.php'><i class='fa fa-arrow-left'></i> Back to all courses</a>
        </div>
      </div>
    <?php
    } else {
      // Error handling
    ?>
      <div class="container d-flex align-items-center justify-content-center mt-3">
        <p>Error: <?php echo $stmt->error; ?></p>
      </div>
<?php
    }

    // Close statement
    $stmt->close();
  }

  // Close connection
  $conn->close();
} else {
  // If not a POST request, redirect to the form
  header("Location: addcourse.php");
}

?>
<!-- Bootstrap Bundle Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMneT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>