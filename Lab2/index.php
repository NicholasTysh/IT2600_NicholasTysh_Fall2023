<?php
// Check if the "name" parameter exists in the query string
$nameValue = isset($_GET["name"]) ? htmlspecialchars($_GET["name"]) : "";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Input Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <h1>Input Form</h1>
        <div class="form-container">

            <form action="summary.php" method="post">
                <p>
                    Name<br>
                    <input type="input" id="name" name="name" placeholder="Name" value="<?php echo $nameValue;?>">
                </p>
                <p>
                    Major<br>
                    <input type="input" id="major" name="major" placeholder="Major">
                </p>
                <p>
                    Favorite Web Language<br>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">HTML</label><br>
                    <input type="radio" id="css" name="fav_language" value="CSS">
                    <label for="css">CSS</label><br>
                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                    <label for="javascript">JavaScript</label><br>
                    <input type="radio" id="PHP" name="fav_language" value="PHP">
                    <label for="PHP">PHP</label>
                </p>
                <p>
                    Development Evironment<br>
                    <input type="checkbox" id="ide1" name="vscode" value="Visual Studio Code">
                    <label for="vehicle1"> Visual Studio Code</label><br>
                    <input type="checkbox" id="ide2" name="brackets" value="Brackets">
                    <label for="vehicle2"> Brackets</label><br>
                    <input type="checkbox" id="ide3" name="other" value="other">
                    <label for="vehicle3"> Other</label>
                    <input type="text" id="othername" name="othername">
                </p>
                <input type="submit">
            </form>
        </div>
    </main>
</body>
</html>