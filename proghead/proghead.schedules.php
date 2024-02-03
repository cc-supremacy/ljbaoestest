<?php
// Include session and connection files
include ("../session/session.php");
include ("../connection/db.php");

// Fetch roles from the session
$userRole = $_SESSION['role'];

// Check if the user has admin or teacher role
$canMakeSchedule = ($userRole === 'admin' || $userRole === 'teacher');

$sss = "Select * from teacheruser";
    $req = mysqli_query($connection, $sss);
$qqq = "Select * from subjects";
    $qwe = mysqli_query($connection, $qqq);
$www = "Select Distinct secName from section";
    $win = mysqli_query($connection, $www);
$zzz = "Select * from rooms";
    $zol = mysqli_query($connection, $zzz);

    $sqlRooms = "SELECT * FROM rooms ORDER BY CAST(SUBSTRING(room_name FROM 5) AS SIGNED)";

    $resultRooms = mysqli_query($connection, $sqlRooms);

// Fetch schedule from the database
$sqlSchedule = "SELECT * FROM schedules ORDER BY room_name, day_of_week, start_time";
$resultSchedule = mysqli_query($connection, $sqlSchedule);

// Organize the schedule data by room, day, and time
$scheduleData = array();
while ($row = mysqli_fetch_assoc($resultSchedule)) {
    $scheduleData[$row['room_name']][$row['day_of_week']][$row['start_time']] = $row;
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Schedules</title>
    <link rel="stylesheet" href="../style/sidestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include custom script for subCode and subName autofill -->
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    td {
        height: 80px;
        cursor: pointer;
        position: relative;
    }

    .schedule-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .hidden-details {
        display: none;
        text-align: left;
        padding: 10px;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
        z-index: 1;
    }

    .schedule-cell:hover .hidden-details {
        display: block;
    }
</style>
</head>

<body>
    <?php include('proghead.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Schedule</span>
        </div>
        <div class="wrapper"> <br> <br>
            <?php if ($canMakeSchedule): ?>
            <span><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Make Schedule
                </button></span><br><br>
               <br><br>
            <?php endif; ?>
            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
               
                ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong><?php  echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset ($_SESSION['status']);
            }

            ?>
            <div class="timetable-navigation">
            <button id="prevDay" onclick="changeDay(-1)">Previous Day</button>
<span id="currentDay"><?php echo isset($_GET['day']) ? $_GET['day'] : 'Monday'; ?></span>
<button id="nextDay">Next Day</button>

</div>

            <!-- Container to display the timetable from scheduling.php -->
            <div id="timetableContainer">
    <?php
    // Display timetable for the selected day or default to Monday
    $initialDay = isset($_GET['day']) ? $_GET['day'] : 'Monday';
    include('scheduling.php');
    displayTimetable($connection, $initialDay);
    ?>
</div>
</div>


    </section>

            <!-- Teacher Availability Modal -->
<div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="availabilityModalLabel">Teacher Availability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Fetch teacher information again
                        $req = mysqli_query($connection, "Select * from teacheruser");
                        while ($teacherRow = mysqli_fetch_assoc($req)) {
                            echo "<tr>";
                            echo "<td>{$teacherRow['profName']}</td>";
                            echo "<td>{$teacherRow['availability']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="addsched.php" method="post">
                        <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Subject Name</label>
        <div class="col-sm-6">
            <select name="subject_id" id="subName" class="form-control">
                <?php
                while ($rows = mysqli_fetch_array($qwe)) {
                    ?>
                    <option value=" <?php echo $rows['subject_id']; ?>"><?php echo $rows['subName']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Teacher</label>
        <div class="col-sm-6">
            <select name="prof_id" id="prof" class="form-control">
            <?php
                                // Fetch teacher information again
                                $req = mysqli_query($connection, "Select * from teacheruser");
                                while ($rows = mysqli_fetch_array($req)) {
                                    ?>
                                    <option value=" <?php echo $rows['prof_id']; ?>"><?php echo $rows['profName']; ?>
                                    </option>
                                <?php
                                }
                                ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Room</label>
        <div class="col-sm-6">
            <select name="room_name" id="room_name" class="form-control">
                <?php
                while ($rows = mysqli_fetch_array($zol)) {
                    ?>
                    <option value="<?php echo $rows['room_name'];?>"><?php echo $rows['room_name'];?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Section</label>
        <div class="col-sm-6">
            <select name="section" id="section" class="form-control">
                <?php
                while ($rows = mysqli_fetch_array($win)) {
                    ?>
                    <option value=" <?php echo $rows['secName']; ?>"><?php echo $rows['secName']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Day</label>
                                <div class="col-sm-6">
                                    <select name="day_of_week" id="">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Time Start</label>
                                <div class="col-sm-6">
                                    <input type="time" class="form-control" name="start_time" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Time End</label>
                                <div class="col-sm-6">
                                    <input type="time" class="form-control" name="end_time" value="">
                                </div>
                            </div>
                            

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
                                <button type="submit" name="add_sched" class="btn btn-primary">Add Schedule</button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
   function changeDay(offset) {
    var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    var currentDayElement = document.getElementById('currentDay');
    var currentDayName = currentDayElement.innerText;
    var currentDayIndex = days.indexOf(currentDayName);

    // Ensure the current day is found in the array
    if (currentDayIndex !== -1) {
        // Calculate the new index, handling both positive and negative offsets
        var newDayIndex = (currentDayIndex + offset + days.length) % days.length;

        // Update the currentDay span
        currentDayElement.innerText = days[newDayIndex];

        // Update the URL with the new day
        window.history.replaceState({}, '', '?day=' + days[newDayIndex]);

        // Reload the page if the current day is not the same as the selected day
        if (currentDayName !== days[newDayIndex]) {
            location.reload();
        }
    }
}
function fetchSchedule(selectedDay) {
    // Fetch schedule data for the selected day and update the timetable
    var timetableContainer = document.getElementById('timetableContainer');
    var url = 'scheduling.php?day=' + selectedDay;

    // Fetch the HTML content from scheduling.php for the selected day
    fetch(url)
        .then(response => response.text())
        .then(data => {
            timetableContainer.innerHTML = data;
        })
        .catch(error => console.error('Error fetching schedule:', error));
}

// Add an event listener to the "Next Day" button
document.getElementById('nextDay').addEventListener('click', function() {
    changeDay(1);
});

// Add an event listener to the "Previous Day" button
document.getElementById('prevDay').addEventListener('click', function() {
    changeDay(-1);
});
    </script>


</body>

</html>
