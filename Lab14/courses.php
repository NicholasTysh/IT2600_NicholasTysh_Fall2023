<?php
session_start();
$title = "All Courses";
include './navbar.php';
include './connection.php';

// Define default and allowed sorting options
$defaultOption = 'course_id';
$allowedSortOptions = ['course_id', 'title', 'description'];

// Validate the 'sortcourses' parameter, default to 'course_id' if invalid
$sortOption = isset($_GET['sortcourses']) && in_array($_GET['sortcourses'], $allowedSortOptions) ? $_GET['sortcourses'] : $defaultOption;

// Define how many results you want per page
$resultsPerPage = 5;

// Find out the number of results stored in database
$sql = "SELECT COUNT(*) AS total FROM courses";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalPages = ceil($row["total"] / $resultsPerPage);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Cast to int for safety

// Determine the SQL LIMIT starting number for the results on the displaying page
$thisPageFirstResult = ($page - 1) * $resultsPerPage;

// Retrieve selected results from database and display them on page
$sql = "SELECT * FROM courses ORDER BY $sortOption LIMIT $thisPageFirstResult, $resultsPerPage";
$result = mysqli_query($conn, $sql);

// Execute the query and handle potential errors
if (!$result = mysqli_query($conn, $sql)) {
  // Handle error
  die("Error: " . mysqli_error($conn));
}
?>

<div class="text-center">
  <h1 class="mt-3">All Courses</h1>
  <p>
    Sort by
    <select name="sortcourses" onchange="location.href='courses.php?sortcourses=' + this.value" class="form-select form-select-sm d-inline-block w-auto">
      <option value="course_id" <?php echo $sortOption == 'course_id' ? 'selected' : ''; ?>>Course Id</option>
      <option value="title" <?php echo $sortOption == 'title' ? 'selected' : ''; ?>>Title</option>
      <option value="description" <?php echo $sortOption == 'description' ? 'selected' : ''; ?>>Description</option>
    </select>
  </p>
  <p><a href="addcourse.php"><i class="fas fa-plus-circle"></i> Create new course</a></p>
  <?php
  // Display pagination links
  echo 'Pagination:<br><nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

  for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($page == $i) ? 'active' : '';

    echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="courses.php?sortcourses=' . $sortOption . '&page=' . $i . '">' . $i . '</a></li>';
  }

  echo '</ul></nav>';
  ?>
</div>

<div class="container mt-4">
  <table class="table">
    <tr>
      <th>Course Id</th>
      <th>Title</th>
      <th>Credit Hrs</th>
      <th>Description</th>
      <th>Prerequisites</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
          <td><?php echo $row["course_id"] ?></td>
          <td><?php echo $row["title"] ?></td>
          <td><?php echo $row["credit_hrs"] ?></td>
          <td><?php echo $row["description"] ?></td>
          <td><?php echo $row["prerequisites"] ?></td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>