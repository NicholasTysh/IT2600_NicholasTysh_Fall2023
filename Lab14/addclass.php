<?php
session_start();

// Check if the user is logged in and the required parameters (CRN and semester) are present
if (isset($_SESSION['user_id']) && isset($_GET['crn']) && isset($_GET['semester'])) {
    // Retrieve and sanitize user data from session and GET request
    $userId = $_SESSION['user_id'];
    $crn = urldecode($_GET['crn']);
    $semester = urldecode($_GET['semester']);

    $title = "Course Successfully Added";
    include './navbar.php';
    include './connection.php';

    // Prepare SQL statement to check if the user is already registered for the specified course
    $checkStmt = $conn->prepare("SELECT * FROM registrations WHERE user_id = ? AND crn = ? AND semester = ?");
    $checkStmt->bind_param("sss", $userId, $crn, $semester);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    // Check if the user is already registered
    if ($result->num_rows > 0) {
        // Notify the user if they are already registered and redirect to the schedule page
        echo "<script>alert('You are already registered for this course.'); window.location.href='schedule.php';</script>";
    } else {
        // User is not registered, prepare an SQL statement for new registration
        $insertStmt = $conn->prepare("INSERT INTO registrations (user_id, crn, semester) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $userId, $crn, $semester);

        // Execute the insert statement
        if ($insertStmt->execute()) {
            // Redirect with a success message if registration is successful
            echo "<script>alert('Successfully Registered to Course.'); window.location.href='schedule.php';</script>";
        } else {
            // Handle errors in registration process
            echo "<script>alert('There was an error registering for this class.'); window.location.href='schedule.php';</script>";
        }

        // Close the insert statement
        $insertStmt->close();
    }

    // Close the check statement and the database connection
    $checkStmt->close();
    $conn->close();
} else {
    // Redirect to the login page if the user is not logged in or required parameters are missing
    header('Location: login.php');
    exit;
}
