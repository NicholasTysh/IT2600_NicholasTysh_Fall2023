<?php
include "./connection.php";

// Get the 'q' parameter from the URL
$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// This will hold the suggestions
$suggestions = '';

if ($q !== "") {
    // Prepare a SQL statement to search for the input string
    $stmt = $conn->prepare("SELECT course_id FROM courses WHERE course_id LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $q);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all matching course_id's
    while ($row = $result->fetch_assoc()) {
        $courseId = htmlspecialchars($row['course_id']);
        $suggestions .= "<a href='javascript:void(0);' onclick=\"document.getElementById('course_id').value = '$courseId';\">" . $courseId . "</a>, ";
    }
    // Remove the trailing comma from the last suggestion
    rtrim($suggestions, ', ');

    $stmt->close();
}

// Close the database connection
$conn->close();

// Output "no suggestion" if no hint was found or output the correct values
echo $suggestions === ""
    ? "No course available beginning with the input text, do you want to <a href='addcourse.php?courseid=" . urlencode($q) . "'>Create this course</a>?"
    : $suggestions;
