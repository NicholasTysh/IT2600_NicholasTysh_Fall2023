<?php
session_start();
$title = "My Registered Courses";
include './navbar.php';
include './connection.php';

// Initialize an array to store unique semesters from the database
$uniqueSemesters = [];

// Query to fetch unique semesters from the sections table
$semesterQuery = "SELECT DISTINCT semester FROM sections ORDER BY semester";
$semesterResult = $conn->query($semesterQuery);

if ($semesterResult && $semesterResult->num_rows > 0) {
    while ($row = $semesterResult->fetch_assoc()) {
        $uniqueSemesters[] = $row['semester'];
    }
}

$semesterResult->close();

// Check if a user ID is stored in the session.
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session.

    // Prepare a SQL query to fetch user's registered courses.
    $query = "SELECT r.crn, s.course_id, s.room, s.days, s.times, s.semester, c.title, c.credit_hrs 
              FROM registrations r 
              JOIN sections s ON r.crn = s.crn 
              JOIN courses c ON s.course_id = c.course_id 
              WHERE r.user_id = ?";

    // Prepare the SQL statement for execution.
    $stmt = $conn->prepare($query);
    // Bind the user ID parameter to the prepared statement.
    $stmt->bind_param("s", $userId);
    // Execute the prepared statement.
    $stmt->execute();
    // Retrieve the result set from the executed statement.
    $result = $stmt->get_result();
    // Close the statement.
    $stmt->close();
} else {
    // If no user ID is found in the session, set result to null.
    $result = null;
}

?>

<div class="text-center">
    <h1 class="mt-3">My Registered Courses</h1>
</div>
<div class="container mt-4">
    <table class="table">
        <tr>
            <th>CRN</th>
            <th>Course ID</th>
            <th>Title</th>
            <th>Credit Hrs</th>
            <th>Room</th>
            <th>Days</th>
            <th>Times</th>
            <th>Semester</th>
        </tr>
        <?php
        // Check if the result set is false, which indicates a query error.
        if ($result === false) {
            // Display an error message with the SQL error.
            echo "<tr><td colspan='8'>Error: " . mysqli_error($conn) . "</td></tr>";
        } elseif ($result === null) {
            // If result is null, indicating no user ID in session, display a message.
            echo "<tr><td class='text-center' colspan='8'>No user data available, do you need to <a href='./login.php'>Login</a> or <a href='./signup.php'>Register</a>?</td></tr>";
        } else if (mysqli_num_rows($result) > 0) {
            // If there are rows in the result set, loop through each row.
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <!-- Display each course in a table row -->
                <tr>
                    <td><?php echo $row["crn"]; ?></td>
                    <td><?php echo $row["course_id"]; ?></td>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["credit_hrs"]; ?></td>
                    <td><?php echo $row["room"]; ?></td>
                    <td><?php echo $row["days"]; ?></td>
                    <td><?php echo $row["times"]; ?></td>
                    <td><?php echo $row["semester"]; ?></td>
                </tr>
        <?php
            }
        } else {
            // If there are no results, display a message indicating 0 results.
            echo "<tr><td colspan='8' class='text-center'>No registered classes</td></tr>";
        }
        // mysqli_close($conn);
        ?>
    </table>
</div>

<?php
// Define a default option for sorting
$defaultOption = 'All';
// Combine the default option with the unique semesters for sorting
$allowedSortOptions = array_merge([$defaultOption], $uniqueSemesters);

// Get the sort option from the URL, or use the default if not provided.
$sortOption = isset($_GET['sortregistrations']) ? urldecode($_GET['sortregistrations']) : $defaultOption;

// Validate if the sort option is allowed, else revert to the default.
if (!in_array($sortOption, $allowedSortOptions)) {
    $sortOption = $defaultOption;
}

// Prepare a query to fetch all courses, possibly filtered by semester.
$query = "SELECT s.crn, s.course_id, s.room, s.days, s.times, s.semester, c.title, c.credit_hrs 
          FROM sections s 
          JOIN courses c ON s.course_id = c.course_id";

// Add a WHERE clause if a specific semester is selected.
if ($sortOption != $defaultOption) {
    $query .= " WHERE s.semester = ?";
    $stmt = $conn->prepare($query);
    // Bind the sort option to the prepared statement.
    $stmt->bind_param("s", $sortOption);
} else {
    // Prepare the query without the WHERE clause if the default option is selected.
    $stmt = $conn->prepare($query);
}

// Execute the prepared statement.
$stmt->execute();
// Retrieve the result set.
$result = $stmt->get_result();
// Close the statement.
$stmt->close();

?>

<div class="text-center">
    <h1 class="mt-3">Available Courses for Registration</h1>
    <p>
        Sort by Semester
        <select name="sortregistrations" onchange="location.href='schedule.php?sortregistrations=' + encodeURIComponent(this.value)" class="form-select form-select-sm d-inline-block w-auto">
            <!-- Dynamically set the selected option based on the current sort option -->
            <?php
            // Dynamically generate option tags
            foreach ($allowedSortOptions as $semester) {
                // Check if the current option is the selected sort option
                $selected = ($sortOption == $semester) ? 'selected' : '';
                echo "<option value=\"$semester\" $selected>$semester</option>";
            }
            ?>
        </select>
    </p>
    <p><a href="addsection.php"><i class="fas fa-plus-circle"></i> Add new registrable section</a></p>
</div>
<div class="container mt-4">
    <table class="table">
        <tr>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <th>Register</th>
            <?php } ?>
            <th>CRN</th>
            <th>Course ID</th>
            <th>Title</th>
            <th>Credit Hrs</th>
            <th>Room</th>
            <th>Days</th>
            <th>Times</th>
            <th>Semester</th>
        </tr>
        <?php
        // Check if the result set is false, indicating a query error.
        if ($result === false) {
            // Display an error message with the SQL error.
            echo "<tr><td colspan='9'>Error: " . mysqli_error($conn) . "</td></tr>";
        } else {
            // If there are results, loop through each row.
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $disabled = isset($_SESSION['user_id']) ? "" : "disabled";
        ?>
                    <!-- Javascript function to add a class to users registered classes -->
                    <script>
                        const addClass = (crn, semester) => {
                            window.location.href = `addclass.php?crn=${crn}&semester=${semester}`;
                        }
                    </script>
                    <!-- Display each course with a register button in a table row -->
                    <tr>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <td>
                                <!-- Button to register for a class, passing the CRN and semester in the URL -->
                                <button onclick="addClass('<?php echo urlencode($row['crn']) ?>', '<?php echo urlencode($row['semester']); ?>')" class="btn btn-sm btn-outline-primary" <?php echo $disabled; ?>>
                                    Register
                                </button>
                            </td>
                        <?php } ?>
                        <td><?php echo $row["crn"]; ?></td>
                        <td><?php echo $row["course_id"]; ?></td>
                        <td><?php echo $row["title"]; ?></td>
                        <td><?php echo $row["credit_hrs"]; ?></td>
                        <td><?php echo $row["room"]; ?></td>
                        <td><?php echo $row["days"]; ?></td>
                        <td><?php echo $row["times"]; ?></td>
                        <td><?php echo $row["semester"]; ?></td>
                    </tr>
        <?php
                }
            } else {
                // If there are no results, display a message indicating 0 results.
                echo "<tr><td colspan='9'>0 results</td></tr>";
            }
        }
        ?>
    </table>
</div>

<!-- Include Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>