<!DOCTYPE html>
<html>

<head>
    <title>Investment Calculator</title>
    <style>
        td,
        th {
            text-align: right
        }

        td {
            padding: 4px;
            width: 110px;
        }

        tr:nth-child(even) {
            background-color: #e5e5e5;
        }

        tr {
            border-bottom: 1px solid #cccccc;
        }

        .year {
            width: 30px;
        }
    </style>
</head>

<body>
    <h1>Simple Investment Calculator</h1>
    <?php
    setlocale(LC_MONETARY, "en_US");
    // TODO: Study the following example reading in the value for the initial amount. Use this example to read in the other values in the next steps.
    // Read in the following values from the $_POST object: amount, rate, years, extra, and addamount.
    $newamount = $_POST['amount'];

    // TODO: Read in the number of years "years". Create a new variable and assign the "years" value to it.
    $years = $_POST['years'];

    // TODO: Read in "addamount" from the post. Create a new variable and assign the "addamount" value to it.
    $addamount = $_POST['addamount'];

    // TODO: Read in "extra" from the post. Create a new variable and assign the "extra" value to it.
    $extra = $_POST['extra'];

    // TODO: Read in the "rate" from the post. Assign it to $rate. 
    $rate = $_POST['rate'];
    ?>

    <h3>Investment Details</h3>
    <!-- TODO: Display the values that you read in from above: amount, rate, years, addamount, and extra. -->
    <ul>
        <li>Initial Investment Amount: <?php printf("$%.02f", $newamount); ?></li>
        <li>Return Rate<?php printf("$%.02f", $rate); ?></li>
        <li>Years Invested: <?php printf("$%.02f", $years); ?></li>
        <li>Add Extra Amount: <?php printf($addamount); ?></li>
        <li>Extra Amount: <?php printf("$%.02f", $extra); ?></li>
    </ul>


    <h3>Annual Schedule</h3>
    <table>
        <tr>
            <th>Year</th>
            <th>Start Amount</th>
            <th>Interest</th>
            <th>End Amount</th>
            <?php if ($addamount == "Yes") : ?>
                <th>Extra Amount</th>
                <th>End Amount</th>
            <?php endif; ?>
        </tr>
        <?php
        // Variables to keep track of totals
        $total_interest = 0;
        $total_extra = 0;

        // TODO: modify the loop, so it only loops for the number of years invested. 
        for ($x = 0; $x < $years; $x++) {
            $startamount = $newamount;
            $interest = $newamount * ($rate / 100);

            $newamount = $newamount + $interest;
            // TODO: if "addamount" is equal to "Yes", add the amount from "extra" to $newamount.
            if ($addamount == "Yes") {
                $newamount += $extra;
            }

            // Add total interest and total extra amount
            $total_interest += $interest;
            $total_extra += ($addamount == "Yes") ? $extra : 0;
        ?>
            <tr>
                <td class="year"><?php echo ($x + 1); ?>
                <td><?php printf("$%.02f", $startamount); ?></td>
                <td><?php printf("$%.02f", $interest); ?></td>
                <td><?php printf("$%.02f", $newamount); ?></td>
                <!-- TODO: if "addamount is equal to "Yes", display two additional columns: the extra amount and the $newamount after adding the extra. -->
                <?php if ($addamount == "Yes") : ?>
                    <td><?php printf("$%.02f", $extra); ?></td>
                    <td><?php printf("$%.02f", $newamount); ?></td>
                <?php endif; ?>
            </tr>
        <?php 
        } 
        ?>
    </table>
    <!--  TODO: For 2 extra credit points: Add a summary that includes amount invested, total interest earned, total extra amount added, and the final amount. -->
    <h3>Summary</h3>
    <ul>
        <li>Amount Invested: $<?php printf("%.02f", $_POST['amount']); ?></li>
        <li>Total Interest Earned: $<?php printf("%.02f", $total_interest); ?></li>
        <li>Total Extra Amount Added: $<?php printf("%.02f", $total_extra); ?></li>
        <li>Final Amount: $<?php printf("%.02f", $newamount); ?></li>
    </ul>
</body>

</html>