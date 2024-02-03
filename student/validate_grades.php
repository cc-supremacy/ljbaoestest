<?php
// Assuming you have the submitted LRN and subMarks in POST data
$lrn = isset($_POST['lrn']) ? $_POST['lrn'] : '';
$subMarks = isset($_POST['subMarks']) ? $_POST['subMarks'] : array();

// Check if there are no subMarks provided
if (empty($subMarks)) {
    // Redirect with a message
    header('Location: student.profile.php?message=No grades to validate');
    exit;
}

// Log input data for debugging
error_log("LRN: $lrn, SubMarks: " . json_encode($subMarks));

// Check if at least one subMark is below 75
$hasFailedSubject = false;
foreach ($subMarks as $mark) {
    if ($mark < 75) {
        $hasFailedSubject = true;
        break;
    }
}

// Log the validation result for debugging
error_log("Validation Result: " . ($hasFailedSubject ? 'fail' : 'pass'));

// Return validation result as JSON
header('Content-Type: application/json');
echo json_encode(['validationResult' => ($hasFailedSubject ? 'fail' : 'pass')]);
?>
