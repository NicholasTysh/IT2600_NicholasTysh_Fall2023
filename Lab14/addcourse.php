<?php
session_start();
$title = "Create New Course";
include './navbar.php';

// Check if 'courseid' is present in the query parameters and sanitize it
$prefilledCourseId = isset($_GET['courseid']) ? htmlspecialchars($_GET['courseid']) : '';
?>

<body>
    <div class="container">
        <div class="text-center">
            <h1 class="mt-3">Create Course</h1>
            <p>Add a new course to the database</p>
            <p><a href="courses.php"><i class="fa fa-arrow-left"></i> Back to all courses</a></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Form for adding a new course -->
                <form action="addcourse-submit.php" method="post" class="">
                    <div class="mb-2">
                        <label for="courseid" class="form-label">Course Id:</label>
                        <!-- Set the value of the input to the 'courseid' query parameter if it exists -->
                        <input type="text" class="form-control" name="courseid" id="courseid" aria-label="Course Id" value="<?php echo $prefilledCourseId; ?>" autofocus required>
                    </div>
                    <div class="mb-2">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" aria-label="Title" required>
                    </div>
                    <div class="mb-2">
                        <label for="credit_hrs" class="form-label">Credit Hours:</label>
                        <input type="number" class="form-control" name="credit_hrs" id="credit_hrs" aria-label="Credit Hours" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description:</label>
                        <textarea rows="3" class="form-control" name="description" id="description" aria-label="Description" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="prerequisites" class="form-label">Prerequisites:</label>
                        <input type="text" class="form-control" name="prerequisites" id="prerequisites" aria-label="Prerequisites" required>
                    </div>
                    <div class="mb-2 text-center">
                        <!-- Submit button -->
                        <input type="submit" class="btn btn-primary" value="Add Course">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Function to move the cursor to the end of the text in an input field
        function moveCursorToEnd(el) {
            // Check if the selectionStart property is available which is standard for inputs
            if (typeof el.selectionStart == "number") {
                // Set the cursor at the end of the text
                el.selectionStart = el.selectionEnd = el.value.length;
            } else if (typeof el.createTextRange != "undefined") {
                // For older browsers, use the createTextRange method
                el.focus(); // First, focus the element
                var range = el.createTextRange(); // Create a range object
                range.collapse(false); // Collapse the range to the end point
                range.select(); // Select the range, moving the cursor to the end
            }
        }

        // This function will run once the window has finished loading
        window.onload = function() {
            // Get the input element with the id 'courseid'
            var inputElem = document.getElementById('courseid');
            // Move the cursor to the end of any existing text in the input
            moveCursorToEnd(inputElem);
            // Focus the element after moving the cursor to the end
            inputElem.focus();
        };
    </script>
</body>

</html>