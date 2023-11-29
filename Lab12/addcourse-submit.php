<!DOCTYPE html>
<html>

<head>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php
// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and store form data from POST request into variables
  $courseid = $_POST['courseid'];
  $title = $_POST['title'];
  $credit_hrs = $_POST['credit_hrs'];
  $description = $_POST['description'];
  $prerequisites = $_POST['prerequisites'];
}

$servername = "localhost";
$username = "root";
// Include your password here
$password = "your_password_here";
$dbname = "it1150";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO courses (course_id, title, credit_hrs, description, prerequisites)
VALUES ($courseid, $title, $credit_hrs, $description, $prerequisites)";

if ($conn->query($sql) === TRUE) {
?>
  <p><?php echo "New record created successfully!"; ?></p>
  <a href='courses.php'><i class='fa fa-arrow-left'></i> Go Back</a>
<?php
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

</html>