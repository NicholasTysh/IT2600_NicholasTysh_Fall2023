<?php
session_start();
$title = "All Sections";
include './navbar.php';
include './connection.php';

// Array of allowed sorting options
$allowedSortOptions = ['crn', 'course_id', 'semester', 'room', 'times', 'days'];

// Default sort option
$defaultOption = 'crn';

// Check if 'sortsections' parameter exists in the URL, use it if present, or default to 'crn'
$sortOption = isset($_GET['sortsections']) ? $_GET['sortsections'] : $defaultOption;

// Validate the selected sort option
if (!in_array($sortOption, $allowedSortOptions)) {
  $sortOption = $defaultOption;
}

// SQL query to fetch sections by the selected sort option
$sql = "SELECT * FROM sections ORDER BY $sortOption";

// Store the SQL query result
$result = mysqli_query($conn, $sql);

// Check for query execution error
if (!$result) {
  die("Error in query execution: " . mysqli_error($conn));
}
?>
<div class="text-center">
  <h1 class="mt-3">All Sections</h1>
  <p>
    Sort by
    <select name="sortsections" onchange="location.href='sections.php?sortsections=' + this.value" class="form-select form-select-sm d-inline-block w-auto">
      <option value="crn" <?php echo $sortOption == 'crn' ? 'selected' : ''; ?>>CRN</option>
      <option value="course_id" <?php echo $sortOption == 'course_id' ? 'selected' : ''; ?>>Course ID</option>
      <option value="semester" <?php echo $sortOption == 'semester' ? 'selected' : ''; ?>>Semester</option>
      <option value="room" <?php echo $sortOption == 'room' ? 'selected' : ''; ?>>Room</option>
      <option value="times" <?php echo $sortOption == 'times' ? 'selected' : ''; ?>>Times</option>
      <option value="days" <?php echo $sortOption == 'days' ? 'selected' : ''; ?>>Days</option>
    </select>
  </p>
  <p><a href="addsection.php"><i class="fas fa-plus-circle"></i> Create new section</a></p>
</div>
<div class="container mt-4">
  <table class="table">
    <tr>
      <th>CRN</th>
      <th>Course Id</th>
      <th>Semester</th>
      <th>Room</th>
      <th>Times</th>
      <th>Days</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo htmlspecialchars($row["crn"]); ?></td>
          <td><?php echo htmlspecialchars($row["course_id"]); ?></td>
          <td><?php echo htmlspecialchars($row["semester"]); ?></td>
          <td><?php echo htmlspecialchars($row["room"]); ?></td>
          <td><?php echo htmlspecialchars($row["times"]); ?></td>
          <td><?php echo htmlspecialchars($row["days"]); ?></td>
        </tr>
    <?php
      }
    } else {
      echo "<tr><td colspan='6'>0 results</td></tr>";
    }
    mysqli_close($conn);
    ?>
  </table>
</div>
<!-- Include Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>