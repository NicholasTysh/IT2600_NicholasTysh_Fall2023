<?php
require_once('database.php');

// Get all courses
$query = 'SELECT * FROM it1150.courses ORDER BY course_id';
$statement = $db->prepare($query);
$statement->execute();
// Fetch data and return as associative array
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();

// Define headers for each category/columns in the database
$headers = array_keys($courses[0]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Courses</title>
</head>

<body>
    <main class="container mt-2">
        <h1 class="mb-2s text-center">Courses List</h1>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Loop for headers -->
                    <?php foreach ($headers as $header) : ?>
                        <th><?php echo $header; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <!-- Loop for each course data in the courses array -->
                <?php foreach ($courses as $course) : ?>
                    <tr>
                        <td><?php echo $course['course_id']; ?></td>
                        <td><?php echo $course['title']; ?></td>
                        <td><?php echo $course['credit_hrs']; ?></td>
                        <td><?php echo $course['description']; ?></td>
                        <td><?php echo $course['prerequisites']; ?></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </main>
</body>

</html>