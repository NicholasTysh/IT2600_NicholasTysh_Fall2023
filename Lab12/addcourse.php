<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid teal;
            padding: 4px;
        }

        th {
            background-color: teal;
            color: white;
            font-size: 1.1em;
            font-weight: bold;
        }

        table tr:first-child td {
            border: 0px;
        }
    </style>
</head>

<body>
    <form action="addcourse-submit.php" method="post">
        <p>
            Course Id<br>
            <input type="text" name="courseid" id="courseid">
        </p>
        <p>
            Title<br>
            <input type="text" name="title" id="title">
        </p>
        <p>
            Credit Hrs<br>
            <input type="text" name="credit_hrs" id="credit_hrs">
        </p>
        <p>
            Description<br>
            <input type="text" name="description" id="description">
        </p>
        <p>
            Prerequisites<br>
            <input type="text" name="prerequisites" id="prerequisites">
        </p>
        <p>
            <input type="submit">
        </p>
    </form>
</body>

</html>