<?php
include("session/student.session.php");
include("connection/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $snum = $_POST['snum'];

    // Define upload directory
    $uploadDir = 'uploads/';

    // Handle file uploads
    $form137Path = uploadFile('form137', $uploadDir);
    $form138Path = uploadFile('form138', $uploadDir);
    $transcriptPath = uploadFile('transcript', $uploadDir);
    $goodMoralPath = uploadFile('good_moral', $uploadDir);

    // Update database with file paths
    $updateQuery = "UPDATE students 
                    SET form137_path = ?, form138_path = ?, transcript_path = ?, good_moral_path = ?
                    WHERE snum = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('sssss', $form137Path, $form138Path, $transcriptPath, $goodMoralPath, $snum);
    $stmt->execute();

    // Redirect or display success message as needed
    header('Location: student/student.enrollment.php');
    exit;
}

// Function to handle file uploads
function uploadFile($fieldName, $uploadDir)
{
    if (!empty($_FILES[$fieldName]['name'])) {
        $fileName = basename($_FILES[$fieldName]['name']);
        $targetPath = $uploadDir . $fileName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetPath)) {
            return $targetPath;
        } else {
            // Handle upload failure
            echo 'File upload failed.';
            exit;
        }
    }

    return null; // No file uploaded
}
?>
