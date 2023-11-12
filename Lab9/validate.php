<!DOCTYPE html>
<html>

<head>
    <style>
        input {
            width: 200px;
        }

        input.operand {
            width: 50px;
        }

        * {
            font-family: Arial;
        }
    </style>
</head>

<body>

    <?php
    // Check if the form was submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and store form data from POST request into variables
        $password = $_POST['pwd'];
        $weather = $_POST['weather'];
        $favseason = $_POST['favseason'];
        $operand1 = $_POST['operand1'];
        $operand2 = $_POST['operand2'];
    }
    ?>

    <?php
    // Regular expression to match invalid characters in password
    $regex1 = "/[!^]/";
    // Check if the password contains invalid characters
    if (preg_match_all($regex1, $password, $matches)) {
    ?>
        <p>
            <?php
            // Determine if there are multiple invalid characters
            $multiple = count($matches[0]) > 1 ? "(s)" : "";
            echo "Contains invalid character" . $multiple;
            // Display each invalid character found
            foreach ($matches[0] as $match) {
                echo " " . $match;
            }
            ?>
        </p>
    <?php
    } else {
    ?>
        <p>
            <?php echo "Password accepted."; // Display message if password is valid 
            ?>
        </p>
    <?php
    }
    ?>

    <?php
    // Regular expression to match specific weather conditions
    $regex2 = "/(Sunny|Cold|Raining)/i";
    // Check if the weather input matches any of the conditions
    if (preg_match_all($regex2, $weather, $matches)) {
        foreach ($matches[0] as $match) {
    ?>
            <p>
                <?php
                // Provide recommendations based on weather condition
                if (strtolower($match) == "sunny") {
                    echo "Wear sunscreen";
                } elseif (strtolower($match) == "cold") {
                    echo "Wear a hat";
                } elseif (strtolower($match) == "raining") {
                    echo "Bring an umbrella";
                }
                ?>
            </p>
        <?php
        }
    } else {
        ?>
        <p>
            <?php echo "No match found"; // Display message if no weather condition matches 
            ?>
        </p>
    <?php
    }
    ?>

    <?php
    // Initialize an associative array to count occurrences of each season
    $wordCounts = [
        "spring" => 0,
        "summer" => 0,
        "fall" => 0,
        "winter" => 0
    ];

    // Loop through each season and count its occurrences in the 'favseason' string
    foreach ($wordCounts as $word => $count) {
        // Create a regex pattern for each word. Example: /\bspring\b/
        $regex = "/\b" . preg_quote($word, '/') . "\b/";
        preg_match_all($regex, $favseason, $matches);
        $wordCounts[$word] = count($matches[0]);
    }

    // Display the count of each season
    foreach ($wordCounts as $word => $count) {
        echo $word . ": " . $count . "<br>";
    }
    ?>

    <?php
    // Function to perform division, throws exception if divisor is zero
    function divide($dividend, $divisor)
    {
        if ($divisor == 0) {
            throw new Exception("Division by zero");
        }
        return $dividend / $divisor;
    }

    // Try to perform division and catch any thrown exceptions
    try {
        echo divide($operand1, $operand2);
    } catch (Exception $ex) {
        // Extract exception details
        $code = $ex->getCode();
        $message = $ex->getMessage();
        $file = $ex->getFile();
        $line = $ex->getLine();
        // Display exception details
        echo "<p>Exception thrown in $file on line $line: [Code $code] $message </p>";
    }
    ?>

</body>

</html>