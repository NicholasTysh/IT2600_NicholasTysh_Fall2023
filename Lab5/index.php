<!DOCTYPE html>
<html>
<head>
    <title>Investment Calculator</title>
</head>
<body>
    <h1>Simple Investment Calculator</h1>
    <h3>Submit an initial investment amount, return rate (%), and number of years you plan to leave the money invested.</h3> 
    <form action="investdetails.php" method="post">
        <p>
        Initial Investment Amount <br>
        $ <input type="currency" id="amount" name="amount" value="1000" required>
        </p>
        <p>
        Return Rate <br>
        <input type="number" id="rate" name="rate" min="1" max="6" step="1" value="3" required> %
        </p>
        <p>
        Number of Years Invested <br>
        <select name="years" id="years">
            <?php
            for ($x=1; $x<31; $x++) {
            ?>
            <option value="<?php echo $x ?>"<?php if ($x==5) echo " selected" ?>><?php echo $x ?></option>
            <?php
            }
            ?>
        </select>
        </p>
        <h3>Optional: add an extra amount that will be added at the end of each year. It will only be added if you select Yes.</h3>
        <p>
            Add extra amount at end of each year:<br>
            <input type="radio" id="addyes" name="addamount" value="Yes">
            <label for="addyes">Yes</label><br>
            <input type="radio" id="addno" name="addamount" value="No" checked>
            <label for="addno">No</label>
        </p>
        <p>
            Extra amount $ <input type="currency" id="extra" name="extra" value="0" required>
        </p>
        <p>
            <input type="submit">
        </p>
    </form>
</body>
</html>