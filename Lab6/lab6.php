<!DOCTYPE html>
<html>

<head>
    <title>Post Output</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <h1>Post Output</h1>
    <?php
    // if post method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get variables from post
        $first = $_POST['first'];
        $middle = $_POST['middle'];
        $last = $_POST['last'];
        $split = $_POST['split'];
        $shuffle = $_POST['shuffle'];
        $tolower = $_POST['tolower'];
        $compare1 = $_POST['compare1'];
        $compare2 = $_POST['compare2'];
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $currency = $_POST['currency'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $hour = $_POST['hour'];
        $minute = $_POST['minute'];
    }
    ?>
    <p>1.
        <?php
        // concatted full name
        $fullName = $first . " " . strtoupper($middle[0]) . ". " . $last;
        // display full name
        echo $fullName;
        ?>
    </p>
    <p>2.
        <br>
        <?php
        // variable split into an array at the dash
        $splitArray = explode("-", $split);
        // for the length of the the split array, dislpay iteration and create new line
        for ($i = 0; $i < count($splitArray); $i++) {
            echo $splitArray[$i] . "<br>";
        }
        ?>
    </p>
    <p>3.
        <?php
        // split characters into an array
        $charsArray = str_split($shuffle);
        // shuffle the array
        shuffle($charsArray);
        // build back into a string
        $shuffledString = implode('', $charsArray);
        // display shuffled string
        echo $shuffledString;
        ?>
    </p>
    <p>4.
        <?php
        // make string lower case
        $lowercaseString = strtolower($tolower);
        // display lowercase string
        echo $lowercaseString;
        ?>
    </p>
    <!-- compare string length -->
    <p>5a. <?php echo strcmp($compare1, $compare2); ?></p>
    <!-- compare string length, only ASCII letters are compared in a case-insensitive way  -->
    <p>5b. <?php echo strcasecmp($compare1, $compare2); ?></p>
    <p>6a.
        <?php
        // find the minimum value
        $minimum = min($num1, $num2);
        // display minimum value
        echo $minimum;
        ?>
    </p>
    <p>6b.
        <?php
        // find the maximum value
        $maximum = max($num1, $num2);
        // display maximum value
        echo $maximum;
        ?>
    </p>
    <p>6c.
        <?php
        // find the average of the values
        $average = ($num1 + $num2) / 2;
        // display averave value
        echo $average;
        ?>
    </p>
    <!-- display random number between 1 and 100 -->
    <p>7. <?php echo rand(1, 100); ?></p>
    <p>8.
        <?php
        // format the input to two decimal places
        $currencyFormatted = sprintf('$%.2f', $currency);
        // display formatted currency
        echo $currencyFormatted;
        ?>
    </p>
    <p>9a.
        <?php
        // Unix timestamp based on year, month, day, hour, and minute variables
        $formattedDate = mktime($hour, $minute, 0, $month, $day, $year);
        // display formatted date
        echo date("Y-m-d h:i", $formattedDate);
        ?>
    </p>
    <p>9b.
        <?php
        // date and time in ISO 8601 format directly using the mktime function
        echo date('c', mktime($hour, $minute, 0, $month, $day, $year));
        ?>
    </p>
    <p>10.
        <?php
        // current date and time
        $now = new DateTime();
        // formatted date and time from date and time variables
        $dateFromForm = new DateTime("$year-$month-$day $hour:$minute:00");
        // the difference between the current date and the date from form
        $interval = $now->diff($dateFromForm);
        // display the difference
        echo "Time difference: " . $interval->format('%y years, %m months, %d days, %h hours, %i minutes, %s seconds');
        ?>
    </p>
</body>

</html>