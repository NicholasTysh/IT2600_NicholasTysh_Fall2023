<!DOCTYPE html>
<html>

<head>
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
    }

    table {
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
      border-collapse: collapse;
    }

    td,
    th {
      border: 1px solid teal;
      padding: 4px;
    }

    th {
      background-color: teal;
      color: white;
      font-size: 1.1em;
      font-weight: bold;
    }

    table tr:first-child td {
      border: 0px;
      font-size: 1.2em;
    }

    select {
      font-size: 1.1em;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
$servername = "localhost";
$username = "root";
// Include your password here
$password = "your_password_here";
$dbname = "it1150";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Array of allowed sorting options
$allowedSortOptions = ['course_id', 'title', 'description'];

// Default sort option
$defaultOption = 'course_id';

// Check if 'sortcourses' parameter exists in the URL, use it if present, or default to 'course_id'
$sortOption = isset($_GET['sortcourses']) ? $_GET['sortcourses'] : $defaultOption;

// Check if selected option is in the allowed array, if not, set to the default sort option
if (!in_array($sortOption, $allowedSortOptions)) {
  $sortOption = $defaultOption;
}
// SQL query to fetch courses by the selected sort option
$sql = "SELECT * FROM courses ORDER BY $sortOption";

// Store the SQL query result
$result = mysqli_query($conn, $sql);
?>

<table>
  <tr>
    <td colspan="2" align="left">
      <a href="addcourse.php"><i class="fas fa-plus-circle"></i> Add Course</a>
    </td>
    <td colspan="2" align="right">
      Sort by
      <!-- Dropdown for sorting options, onchange modifies the URL based on selection -->
      <select name="sortcourses" onchange="location.href='courses.php?sortcourses=' + this.value">
        <!-- Options for sorting by course_id, title, description; add a selected if it's the current sort option -->
        <option value="course_id" <?php echo $sortOption == 'course_id' ? 'selected' : ''; ?>>Course Id</option>
        <option value="title" <?php echo $sortOption == 'title' ? 'selected' : ''; ?>>Title</option>
        <option value="description" <?php echo $sortOption == 'description' ? 'selected' : ''; ?>>Description</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>Course Id</th>
    <th>Title</th>
    <th>Credit Hrs</th>
    <th>Description</th>
    <!-- Added Prerequisites header -->
    <th>Prerequisites</th>
  </tr>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["course_id"] . "</td><td>" . $row["title"] . "</td>" .
        "<td>" . $row["credit_hrs"] . "</td><td>" . $row["description"] . "</td><td>" . $row["prerequisites"] . "</td></tr>";
    }
  } else {
    echo "0 results";
  }

  mysqli_close($conn);
  ?>
<!-- Close table  -->
</table>
<!-- Close HTML -->
</html>