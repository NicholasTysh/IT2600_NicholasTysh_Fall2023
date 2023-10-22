<html>

<head>
    <title>PHP Test</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        input {
            width: 220px;
        }
    </style>
</head>

<body>
    <h1>Lab 6 Instructions</h1>
    For each of the problems, please output the values you create using the string, number, and date functions.<br>
    <form action="lab6.php" method="post">
        <p>1.
            <i>Combine the first, last, and middle name to display as:
                [first name] [middle initial]. [last name]
                For example: Steven, Paul, and Jobs would display as "Steven P. Jobs".</i><br>
            <b>First Name</b><br>
            <input type="text" name="first" value="Steven"><br><br>
            <b>Middle Name</b><br>
            <input type="text" name="middle" value="Paul"><br><br>
            <b>Last Name</b><br>
            <input type="text" name="last" value="Jobs">
        </p>
        <p>2.
            <i>Split the following string on each dash - character. Display each word on its own line.</i><br>
            <input type="text" name="split" value="Emma-is-a-data-scientist" readonly>
        </p>
        <p>3.
            <i>Randomly shuffle and output the value for the following string.</i><br>
            <input type="text" name="shuffle" value="abcdefghijklmnopqrstuvwxyz" readonly>
        </p>
        <p>4.
            <i>Convert the following to all lowercase and output the value.</i><br>
            <input type="text" name="tolower" value="SteveJobs@Tri-C.edu" readonly>
        </p>
        <p>5.
            <i>Use both strcmp() and strcasecmp() to compare the following values.</i><br>
            <b>First Compare Value</b><br>
            <input type="text" name="compare1" value="11000 W PLEASANT VALLEY RD" readonly><br><br>
            <b>Second Compare Value</b><br>
            <input type="text" name="compare2" value="11000 W Pleasant Valley Rd" readonly>
        </p>
        <p>6.
            <i>For the following numbers, find the minimum, maximum, and average values.</i><br>
            <b>Number 1</b><br>
            <input type="text" name="num1" value="2401" readonly><br><br>
            <b>Number 2</b><br>
            <input type="text" name="num2" value="1100" readonly>
        </p>
        <p>7.
            <i>Generate a random integer between 0 and 100.</i>
        </p>
        <p>8.
            <i>Use sprintf() to output the following value in currency format with two decimal places and a $ sign.</i><br>
            <input type="text" name="currency" value="125.9712" readonly>
        </p>
        <p>9.
            <i>Output the following date and time in two different formats.</i><br>
            <b>Year</b><br>
            <input type="text" name="year" value="2023" readonly><br><br>
            <b>Month</b><br>
            <input type="text" name="month" value="11" readonly><br><br>
            <b>Day</b><br>
            <input type="text" name="day" value="01" readonly><br><br>
            <b>Hour</b><br>
            <input type="text" name="hour" value="12" readonly><br><br>
            <b>Minute</b><br>
            <input type="text" name="minute" value="05" readonly>
        </p>
        <p>10.
            <i>Using the date/time values from the previous problem, calculate how many hours there are from now until then.</i>
        </p>
        <input type="submit">
    </form>
</body>

</html>