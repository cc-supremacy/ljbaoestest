<?php
if (isset($_GET['lrn'])) {
    $lrn = $_GET['lrn'];

    include("../connection/db.php");

    $sql = "SELECT * FROM students WHERE lrn = '$lrn'";
    $result = $connection->query($sql);

    if ($row = $result->fetch_assoc()) {
        // Display edit modal content
        ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../crud/editnewstud.php" method="post">
                            <!-- Populate form fields with database values -->
                            <input type="hidden" name="lrn" value="<?php echo $row['lrn']; ?>">
                            <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" required>
                            <input type="text" class="form-control" name="mname" value="<?php echo $row['mname']; ?>" required>
                            <!-- ... (populate other fields in a similar way) ... -->

                            <?php
                            if (!empty($successMessage)){
                                echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                ";
                            }
                            ?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="edit_newstud" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    } else {
        echo "Student not found.";
    }

    // Close the database connection if needed
    $connection->close();
} else {
    echo "LRN parameter is missing.";
}
?>
