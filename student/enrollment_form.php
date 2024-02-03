<?php
include("../session/student.session.php");
include("../connection/db.php");
$sqq = "Select Distinct courseName from section";
$res = mysqli_query($connection, $sqq);

// Fetch the latest school year's description
$schoolYearQuery = "SELECT yearID, description FROM school_years ORDER BY start_year DESC LIMIT 1";
$schoolYearResult = mysqli_query($connection, $schoolYearQuery);
$latestSchoolYear = mysqli_fetch_assoc($schoolYearResult);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="../style/sidestyle2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php include('student.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Enrollment</span>
        </div>
        <div class="container">
          
        <form action="../form_action.php" method="post" enctype="multipart/form-data">
                <div class="form first">
                    <div class="details personal">
                        <br><span class="title"><h5>Enrollment Form</h5></span>
                        <div class="fields">
                            <div class="input-field"><br>
                                <input type="hidden" name="reg_no" value="<?php echo"$reg_no"; ?>" readonly>
                                <label for="">LRN:</label>
                                <input type="text" name="lrn" value="<?php echo"$lrn"; ?>" readonly><br><br>
                                <input type="hidden" name="yearID" value="<?php echo $latestSchoolYear['yearID']; ?>">
                                <label for="">School Year:</label>
                                <input type="text" name="school_year" value="<?php echo $latestSchoolYear['description']; ?>" readonly><br><br>
                                
                                <label for="">First Name:</label>
                                <input type="text" name="fname" placeholder="" value="<?php echo"$fname" ;?>" required>
                                <label for="">Middle Name:</label>
                                <input type="text" name="mname" placeholder="Middle Name" value="<?php echo"$mname" ;?>"required><br><br>
                                <label for="">Last Name:</label>
                                <input type="text" name="lname" placeholder="Last Name" value="<?php echo"$lname" ;?>"required>
                                <label for="">Extension Name:</label>
                                <input type="text" name="xname" placeholder="Jr,III, (optional)">
                            </div> <br>
                            <div class="input-field">
                                
                                
                                <label for="">Mobile:</label>
                                <input type="text" name="pmobile" value="<?php echo"$mobile"; ?>" required> 
                                <label for="">Parent/Guardian Mobile:</label>
                                <input type="text" name="gmobile" required><br><br>
                                <label for="">BirthDate</label>
                                <input type="date" name="birth" value="<?php echo"$birth" ?>"required> 
                                <label for="">Age</label>
                                <input type="number" name="age" value="<?php echo"$age" ?>"required> <br><br>
                                <label for="">Is your family a beneficiary of 4Ps?</label>
                                <select name="4ps" id="">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                                If yes, write your 4Ps household #: <input type="text" name="4psnum">
                                <br><br>
                                <label for="">Current Address:</label>
                                <input name="caddress" size="80" value="<?php echo "$strt" ; echo "$brgy" ; echo "$mncpl" ; echo "$prvnc" ; echo "$cntry" ; ?>"> <br><br>
                                <label for="">Grade Level:</label>
                                <select name="courseName"  id="courseName" class="form-control"  onchange="showSubjects()">
                                <?php
                                             while( $rows = mysqli_fetch_array($res)){
                                             ?>
                                <option value=" <?php echo $rows['courseName']; ?>"><?php echo $rows['courseName']; ?></option>
                                <?php
                                                  }
                                             ?>
                                 </select><br><br>
                                <table class="table table-striped">
                                <thead>
                                    <th style="text-align: center;">Grade Level</th> 
                                    <th style="text-align: center;">Subject Name</th>
                                    <th style="text-align: center;">Teacher</th>
                                    <th style="text-align: center;">Day</th>
                                    <th style="text-align: center;">Start Time</th>
                                    <th style="text-align: center;">End Time</th>

                                </thead>
                                <tbody id="ans">

                                </tbody>
                                </table>
                               
                                 </div><br><br>
                                 <p class="disclaimer">Note: Please prepare your hard copy of your <?php echo "$documents"; ?> <br>
                               
                                
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <input type="reset">
                    </div>
                </div>
            </form>
        </div>
       
    </section>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
   

</body>

</html>