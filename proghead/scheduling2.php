<!-- scheduling.php -->
<?php

function displayTimetable($connection, $selectedDay = 'Tuesday') {
    $canMakeSchedule = $_SESSION['role'] === 'admin' || $_SESSION['role'] === 'teacher';

    $resultRooms = mysqli_query($connection, "SELECT * FROM rooms ORDER BY CAST(SUBSTRING(room_name FROM 5) AS SIGNED)");

    // Modify the SQL query to only fetch data for the selected day
    $sqlSchedule = "SELECT * FROM schedules WHERE day_of_week = ? ORDER BY room_name, start_time";
    $statement = $connection->prepare($sqlSchedule);
    $statement->bind_param("s", $selectedDay);
    $statement->execute();
    $resultSchedule = $statement->get_result();

    $scheduleData = array();
    while ($row = mysqli_fetch_assoc($resultSchedule)) {
        $scheduleData[$row['room_name']][$row['day_of_week']][$row['start_time']] = $row;
    }
    
    // Your existing HTML and PHP code for the timetable
    include('proghead.sidebar.php');
    echo '<section class="home-section">';
    echo '<div class="home-content">';
    echo '<i class="bx bx-menu"></i>';
    echo '<span class="text"> &nbsp &nbsp &nbsp Schedule</span>';
    echo '</div>';
    echo '<div class="wrapper"> <br> <br>';

    if ($canMakeSchedule) {
        echo '<span><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Make Schedule</button></span><br>';
    }

    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo '<strong></strong>' . $_SESSION['status'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['status']);
    }

    echo '<div class="timetable-navigation">';
    echo '<button id="prevDay" onclick="changeDay(-1)">Previous Day</button>';
    echo '<span id="currentDay">' . $selectedDay . '</span>';
    echo '<button id="nextDay" onclick="changeDay(1)">Next Day</button>';
    echo '</div>';
    echo '<table id="scheduleTable">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Room</th>';
    echo '<th>7:00 AM</th>';
    echo '<th>8:00 AM</th>';
    echo '<th>9:00 AM</th>';
    echo '<th>10:00 AM</th>';
    echo '<th>11:00 AM</th>';
    echo '<th>12:00 PM</th>';
    echo '<th>1:00 PM</th>';
    echo '<th>2:00 PM</th>';
    echo '<th>3:00 PM</th>';
    echo '<th>4:00 PM</th>';
    echo '<th>5:00 PM</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($rowRoom = mysqli_fetch_assoc($resultRooms)) {
        echo "<tr>";
        echo "<td>{$rowRoom['room_name']}</td>";

        for ($i = 7; $i <= 17; $i++) {
            $timeSlot = sprintf('%02d:00:00', $i);
            $currentCell = $scheduleData[$rowRoom['room_name']][$selectedDay][$timeSlot] ?? null;

            if ($currentCell) {
                $startTime = strtotime($currentCell['start_time']);
                $endTime = strtotime($currentCell['end_time']);
                $colspan = ($endTime - $startTime) / 3600;

                echo "<td colspan='$colspan' data-room='{$rowRoom['room_name']}' data-day='$selectedDay' data-time='$timeSlot' class='schedule-cell'>";
                echo "<div class='schedule-content'>";
                echo "<span class='subject-name'>" . getSubjectName($connection, $currentCell['subject_id']) . "</span><br>";
                echo "<span class='section-name'>{$currentCell['section']}</span>";
                echo "</div>";

                echo "<div class='hidden-details'>";
                echo "<p>Teacher: " . getProfessorName($connection, $currentCell['prof_id']) . "</p>";
                echo "<p>Grade: {$currentCell['courseName']}</p>";
                $startFormatted = date("h:i A", strtotime($currentCell['start_time']));
                $endFormatted = date("h:i A", strtotime($currentCell['end_time']));
                echo "<p>Time: {$startFormatted} - {$endFormatted}</p>";
                echo "</div>";

                echo "</td>";
                $i += $colspan - 1;
            } else {
                echo "<td data-room='{$rowRoom['room_name']}' data-day='$selectedDay' data-time='$timeSlot' class='schedule-cell'></td>";
            }
        }

        echo "</tr>";
    }

    echo '</tbody>';
    echo '</table>';

    echo '</div>';
    echo '</section>';
}

// Function to get subject name based on subject_id
function getSubjectName($connection, $subjectId) {
    $query = "SELECT subName FROM subjects WHERE subject_id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $subjectId);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    return $row['subName'];
}

// Function to get professor name based on prof_id
function getProfessorName($connection, $profId) {
    $query = "SELECT profName FROM teacheruser WHERE prof_id = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $profId);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    return $row['profName'];
}
?>
