<?php
$title = "Section Successfully Added";
include './navbar.php';

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "./connection.php";

  // Retrieve and sanitize form data
  $crn = mysqli_real_escape_string($conn, $_POST['crn']);
  $courseid = mysqli_real_escape_string($conn, $_POST['course_id']);
  $semester = mysqli_real_escape_string($conn, $_POST['semester']);
  $room = mysqli_real_escape_string($conn, $_POST['room']);
  $times = mysqli_real_escape_string($conn, $_POST['times']);
  $days = mysqli_real_escape_string($conn, $_POST['days']);

  // Check if the CRN already exists in the database
  $checkStmt = $conn->prepare("SELECT * FROM sections WHERE crn = ?");
  $checkStmt->bind_param("s", $crn);
  $checkStmt->execute();
  $result = $checkStmt->get_result();

  if ($result->num_rows > 0) {
    // CRN already exists
?>
    <div class="container d-flex align-items-center justify-content-center mt-3">
      <div class="text-center" style="width: 50%;">
        <h1>CRN already exists in the database.</h1>
        <a href='addsection.php'><i class='fa fa-arrow-left'></i> Try adding a different section</a>
      </div>
    </div>
    <?php
    $checkStmt->close();
  } else {
    // CRN does not exist, proceed to insert
    $checkStmt->close(); // Close the check statement

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO sections (crn, course_id, semester, room, times, days) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $crn, $courseid, $semester, $room, $times, $days);

    // Execute the prepared statement
    if ($stmt->execute()) {
    ?>
      <div class="container d-flex align-items-center justify-content-center mt-3">
        <div class="text-center" style="width: 50%;">
          <h1>New section successfully added!</h1>
          <a href='sections.php'><i class='fa fa-arrow-left'></i> Back to all sections</a>
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
  // If not a POST request, redirect to the form or display an error
  header("Location: addsection.php");
  // Or echo an error message
  // echo "Invalid request method.";
}

?>
<!-- Bootstrap Bundle Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMneT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>