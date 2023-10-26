<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lab 7</title>
</head>

<body>
    <?php
    // Set session variables
    $_SESSION["fullname"] = "Nick Tysh";
    $_SESSION["courseid"] = "IT-2600";

    // Set cookies
    setcookie("favlanguage", "Solidity", time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("favoperatingsystem", "Windows XP", time() + (86400 * 30), "/"); // 86400 = 1 day

    // Assign array values
    $languages = array("PHP", "ASP.NET", "Ruby", "Java", "Scala", "JavaScript", "Python");
    // Sort array
    sort($languages);

    // Assign associative array values
    $associativeLanguages = array("Python" => 1.4, "ASP.NET" => 8.3, "Ruby" => 5.2, "PHP" => 78.9, "Java" => 3.6, "Scala" => 2.0);
    // Sort array in decending order according to value
    arsort($associativeLanguages);
    ?>

    <h4>
        Create an array and display the following server-side languages using a for loop. Display them in alphabetic order.
    </h4>
    <!-- Loop over sorted languages array and display values -->
    <?php
    for ($i = 0; $i < count($languages); $i++) {
    ?>
        <p><?php echo $i+1 . ". " . $languages[$i]; ?></p>
    <?php
    }
    ?>

    <h4>
        Create an associative array. Display the results in a table ordered by usage of server-side languages.
    </h4>
    <!-- Loop over associative languages array and display key and values -->
    <table class="table w-25 border">
        <tr>
            <th scope="col">Language</th>
            <th scope="col">% Usage</th>
        </tr>
        <?php
        foreach ($associativeLanguages as $lang => $langValue) :
        ?>
            <tr>
                <td><?php echo $lang ?></td>
                <td><?php echo $langValue ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>

    <!-- Link to lab 7 favorites -->
    <h3>Click <a href="lab7favorites.php">here</a> to go to Lab 7 Favorites.</h3>
</body>

</html>