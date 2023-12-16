<?php
session_start();
$title = "Create New Section";
include './navbar.php';
?>
<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>
<div class="container">
    <!-- Title and navigation back link -->
    <div class="text-center">
        <h1 class="mt-3">Create Section</h1>
        <p>Add a new section to the database</p>
        <p><a href="sections.php"><i class="fa fa-arrow-left"></i> Back to all sections</a></p>
    </div>

    <!-- Form for adding a new section -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="addsection-submit.php" method="post" class="" id="sectionForm">
                <!-- Input field for CRN -->
                <div class="mb-2">
                    <label for="crn" class="form-label">CRN:</label>
                    <input type="text" class="form-control" name="crn" id="crn" autofocus required>
                </div>
                <!-- Input field for Course Id -->
                <div class="mb-2">
                    <label for="course_id" class="form-label">Course Id:</label>
                    <input onkeyup="showHint(this.value)" type="text" class="form-control" name="course_id" id="course_id" autocomplete="off" required>
                    <p>Course Id Hint: <span id="txtHint"></span></p>
                </div>

                <!-- Input field for Room -->
                <div class="mb-2">
                    <label for="room" class="form-label">Room:</label>
                    <input type="text" class="form-control" name="room" id="room" required>
                </div>
                <div class="row">
                    <!-- Dropdown for Season Part -->
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="semester_part" class="form-label">Season:</label>
                            <select name="semester_part" id="semester_part" class="form-select" required>
                                <option value="Spring">Spring</option>
                                <option value="Summer">Summer</option>
                                <option value="Fall">Fall</option>
                                <option value="Winter">Winter</option>
                            </select>
                        </div>

                    </div>
                    <!-- Dropdown for Year -->
                    <div class="col-6">
                        <div class="mb-2">
                            <label for="semester_year" class="form-label">Year:</label>
                            <select name="semester_year" id="semester_year" class="form-select" required>
                                <?php
                                $currentYear = date("Y");
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<option value=\"" . ($currentYear + $i) . "\">" . ($currentYear + $i) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <!-- Hidden semester input -->
                    <input type="hidden" name="semester" id="semester">
                </div>
                <!-- Input field for Times -->
                <div class="mb-2">
                    <label for="times" class="form-label">Times:</label>
                    <input type="text" class="form-control" name="times" id="times" required>
                </div>
                <!-- Input field for Days -->
                <div class="mb-2">
                    <label class="form-label">Days:</label><br>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; font-size: 80%;">
                        <input type="checkbox" id="day_M" name="day_M" value="M"> <label for="day_M">Monday</label><br>
                        <input type="checkbox" id="day_T" name="day_T" value="T"> <label for="day_T">Tuesday</label><br>
                        <input type="checkbox" id="day_W" name="day_W" value="W"> <label for="day_W">Wednesday</label><br>
                        <input type="checkbox" id="day_TH" name="day_TH" value="TH"> <label for="day_TH">Thursday</label><br>
                        <input type="checkbox" id="day_F" name="day_F" value="F"> <label for="day_F">Friday</label><br>
                        <input type="checkbox" id="day_S" name="day_S" value="S"> <label for="day_S">Saturday</label><br>
                        <input type="checkbox" id="day_SU" name="day_SU" value="SU"> <label for="day_SU">Sunday</label><br>
                    </div>
                </div>
                <!-- Hidden days input -->
                <input type="hidden" name="days" id="days">

                <!-- Submit button -->
                <div class="mb-2 text-center">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    document.getElementById('sectionForm').addEventListener('submit', function() {
        var semesterPart = document.getElementById('semester_part').value;
        var semesterYear = document.getElementById('semester_year').value;
        document.getElementById('semester').value = semesterPart + " " + semesterYear;
    });

    document.getElementById('sectionForm').addEventListener('submit', function() {
        var selectedDays = [];
        ['M', 'T', 'W', 'TH', 'F', 'S', 'SU'].forEach(function(day) {
            if (document.getElementById('day_' + day).checked) {
                selectedDays.push(day);
            }
        });
        document.getElementById('days').value = selectedDays.join('');
    });
</script>
</body>

</html>