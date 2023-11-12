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
    <form method="post" action="validate.php">
        <h2>Regular Expressions Exercises</h2>
        <p>
            1. Make sure the following password does not contain the symbols ! or ^. Display "Contains invalid
            character" and display the illegal character(s) or "Password accepted."<br><br>
            <b>Password</b><br>
            <input type="text" id="pwd" name="pwd" value="GJc'!b6u\q#G^nSE">
        </p>
        <p>
            2. Display the following reminders if the value has any of the following. Note: it should work regardless of
            case.<br>
            <i>Sunny</i> - Wear sunscreen<br>
            <i>Cold</i> - Wear a hat<br>
            <i>Raining</i> - Bring an umbrella<br><br>
            <b>Weather description</b><br>
            <input type="text" id="weather" name="weather" value="It's sunny snowing and really windy!">
        </p>
        <p>
            3. The following value contains a list of votes for favorite seasons including spring, summer, fall, and
            winter. Display a count of votes for each. If there are no votes, still display it with a count of
            0.<br><br>
            <b>Favorite season</b><br>
            <input type="text" id="favseason" name="favseason"
                value="fall, fall, fall, summer, summer, winter, winter, winter, winter">
        </p>
        <p>
            4. Perform the following division problem. Catch an exceptions that occur and display the exception
            message.<br><br>
            <b>Division problem</b><br>
            <input type="number" id="operand1" name="operand1" value="20" class="operand" readonly> /
            <input type="number" id="operand1" name="operand2" value="0" class="operand" readonly>
        </p>
        <input type="submit" value="Submit">
    </form>

</body>

</html>