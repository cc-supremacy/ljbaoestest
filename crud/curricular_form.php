<!--curricular_form.php -->

<div id="curricularFormContainer">
    <h5>Add Curricular Activity</h5>
    <form id="addCurricularForm" action="submit_curricular.php" method="post">
        <div class="mb-3">
        <input type="hidden" id="lrn" name="lrn" value="">
            <label for="curricularDescription" class="form-label">Description</label>
            <input type="text" class="form-control" id="curricularDescription" name="curricularDescription" required>
        </div>
        <div class="mb-3">
            <label for="curricularCategory" class="form-label">Category</label>
            <select class="form-select" id="curricularCategory" name="curricularCategory" required>
                <option value="" selected disabled>Select Category</option>
                <option value="Contests and Competition">Contests and Competition</option>
                <option value="Student Leadership">Student Leadership</option>
                <option value="Campus Journalism">Campus Journalism</option>
                <option value="Officership and Membership">Officership and Membership</option>
                <option value="Participation and Attendance">Participation and Attendance</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="curricularYear" class="form-label">Year</label>
            <select class="form-select" id="curricularYear" name="curricularYear" required>
                <option value="" selected disabled>Select Year</option>
                <!-- Options will be dynamically added here via AJAX -->
            </select>
        </div>
        <div class="mb-3">
            <label for="curricularAchievements" class="form-label">Achievements / Position</label>
            <input type="text" class="form-control" id="curricularAchievements" name="curricularAchievements"
                required>
        </div>
        <button type="button" class="btn btn-secondary" id="backBtnCurricular">Back</button>
        <button type="submit" name="submit" class="btn btn-primary">Add Curricular</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Add this script to your HTML -->
<script>
    $(document).ready(function () {
        // Add an event listener for form submission
        $("#addCurricularForm").submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            // Submit the form data using AJAX
            $.ajax({
                type: "POST",
                url: "submit_curricular.php",
                data: formData,
                success: function (response) {
                    // Show the success message in an alert
                    alert("Curricular activity added successfully!");

                    // Redirect to "proghead.enrolled.students.php"
                    window.location.href = "proghead.enrolled.students.php";
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("Error submitting curricular form: " + errorThrown);
                }
            });
        });
    });
</script>


