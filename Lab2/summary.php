<?php
    // get the data from the form
    $name = filter_input(INPUT_POST, 'name');
    $major = filter_input(INPUT_POST, 'major');
    $fav_language = filter_input(INPUT_POST, 'fav_language');

    $vscode = filter_input(INPUT_POST, 'vscode');
    $brackets = filter_input(INPUT_POST, 'brackets');
    $other = filter_input(INPUT_POST, 'other');
    // if $other is selected, $other == the input value
    if ($other != Null) {
        $other = filter_input(INPUT_POST, 'othername');
    }
    // array of ide's
    $ide_array = array($vscode, $brackets, $other);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Summary</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Summary</h1>

        <table>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo htmlspecialchars($name); ?></td>
            </tr>
            <tr>
                <td><strong>Major:</strong></td>
                <td><?php echo htmlspecialchars($major); ?></td>
            </tr>
            <tr>
                <td><strong>Favorite Web Language:</strong></td>
                <td><?php echo htmlspecialchars($fav_language); ?></td>
            </tr>
            <tr>
                <td><strong>Development Environment:</strong></td>
                <td>
                    <?php
                    // loop over the array, check if value is not Null, if true then create ne row
                    for ($i = 0; $i < count($ide_array); $i++) {
                        if ($ide_array[$i] != null) {
                            echo ($i + 1) . ". " . htmlspecialchars($ide_array[$i]) . "<br>";
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
    </main>
</body>

</html>