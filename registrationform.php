<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Application Form</title>
    <link rel="stylesheet" href="style/enrollstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="sidebar close">
        <div class="logo-details">
            <a href="#"><i class='bx bxs-school'></i></a>
            <span class="logo_name">Lord Jesus <br>Blessed Academy</span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-phone-call'></i>
                        <span class="link_name">Contact</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Contact</a></li>
                    <li><a href="https://www.facebook.com/laconcepcioncollege"><i
                                class='bx bxl-facebook-circle'></i></a></li>
                    <li><a href="https://laconcepcioncollege.com/"><i class='bx bx-globe'></i></a></li>
                    <li><a href="https://twitter.com/lcc_csjdm"><i class='bx bxl-twitter'></i></a></li>
                </ul>
            </li>
            <li>
                <a href="student/student.login.php">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Return to Login</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="student/student.login.php">Return to Login</a></li>
                </ul>
            </li>
</ul>
    </div>

    </div>


    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Application Form</span>
        </div>
        <div class="container">
            <form action="applicationform.php" method="post" enctype="multipart/form-data">
                <div class="form first">
                    <div class="details personal">
                        <br><span class="title"><h5>Personal Details</h5></span>
                        <div class="fields">
                            <div class="input-field"><br>
                                <label for="">First Name:</label>
                                <input type="text" name="fname" placeholder="First Name" required>
                                <label for="">Middle Name:</label>
                                <input type="text" name="mname" placeholder="Middle Name" required><br><br>
                                <label for="">Last Name:</label>
                                <input type="text" name="lname" placeholder="Last Name" required>
                                <label for="">Extension Name:</label>
                                <input type="text" name="xname" placeholder="Jr,III (optional)">
                            </div> <br>
                            <div class="input-field">
                                <label for="">Birthday:</label>
                                <input type="date" name="birth" required> &nbsp&nbsp&nbsp
                                <label for="">Age:</label>
                                <input type="text" name="age" placeholder="" required> &nbsp&nbsp&nbsp
                                <label for="">Sex:</label>
                                <select id="" name="sex" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select> &nbsp&nbsp&nbsp
                                <label for="">Mobile #:</label>
                                <input type="text" name="mobile" placeholder="password will be sent here" required>
                            </div><br>
                            <div class="input-field">
                                <label for="">Place of Birth: </label>
                                <input type="text" name="pob" placeholder="city,province" required>
                                <label for="">Mother Tongue:</label>
                                <input type="text" name="tongue" placeholder="Filipino, English, etc." required>
                            </div><br>
                            <div class="input-field">
                                <label for="">Address:</label><br>
                                <input type="text" name="strt"  placeholder="Street">
                                <input type="text" name="brgy"  placeholder="Barangay">
                                <input type="text" name="mncpl" placeholder="Municipality/City">
                                <input type="text" name="prvnc" placeholder="Province">
                                <input type="text" name="cntry" placeholder="Country">
                            </div><br>
                            </div>
                            <div class="fields">
                            <span class="title"><h5>Parent/Guardian Details</h5></span>
                            <div class="input-field"><br>
                                <label for="">Father's Name</label><br>
                                <label for="">First Name:</label>
                                <input type="text" name="ffname" placeholder="First Name">&nbsp&nbsp&nbsp
                                <label for="">Middle Name:</label>
                                <input type="text" name="fmname" placeholder="Middle Name">&nbsp&nbsp&nbsp
                                <label for="">Last Name:</label>
                                <input type="text" name="flname" placeholder="Last Name">&nbsp&nbsp&nbsp
                            </div>
                            <div class="input-field"><br>
                                <label for="">Mother's Name</label><br>
                                <label for="">First Name:</label>
                                <input type="text" name="mfname" placeholder="First Name">&nbsp&nbsp&nbsp
                                <label for="">Middle Name:</label>
                                <input type="text" name="mmname" placeholder="Middle Name">&nbsp&nbsp&nbsp
                                <label for="">Last Name:</label>
                                <input type="text" name="mlname" placeholder="Last Name">&nbsp&nbsp&nbsp
                            </div>
                            <div class="input-field"><br>
                                <label for="">Guardian's Name</label><br>
                                <label for="">First Name:</label>
                                <input type="text" name="gfname" placeholder="First Name">&nbsp&nbsp&nbsp
                                <label for="">Middle Name:</label>
                                <input type="text" name="gmname" placeholder="Middle Name">&nbsp&nbsp&nbsp
                                <label for="">Last Name:</label>
                                <input type="text" name="glname" placeholder="Last Name">&nbsp&nbsp&nbsp
                            </div>
                            </div>
                            <div class="fields"><br>
                            <span class="title"><h5>Educational Background</h5></span><br>
                            <div class="input-field">
                                <label for="">LRN : </label>
                                <input type="text" name="lrn" size="25" required>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <label for="">Status: </label>
                                <select name="status" id="" required>
                                    <option value="New">New Student</option>
                                    <option value="Old">Old Student</option>                               
                                </select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <br><br>
                                <label for="">Previous School: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                <input type="text" name="hschool" size="100" placeholder="Name of past school"><br><br>
                                <label for="">School Address:</label><br>
                                <input type="text" name="hstrt"  size="30" placeholder="Street">
                                <input type="text" name="hbrgy"  size="30" placeholder="Barangay">
                                <input type="text" name="hmncpl" size="30" placeholder="Municipality/City"><br>
                                <input type="text" name="hprvnc" size="30" placeholder="Province">
                                <input type="text" name="hcntry" size="30" placeholder="Country"><br><br>
                            </div>
                                
                            </div>
                            <div class="fields">
                            <span class="title"><h5>Documents that can be Submitted</h5></span><br>
                            <div class="input-field">
                                <input type="checkbox" id="nso" name="documents[]" value="NSO">
                                <label for="nso">NSO Birth Certificate</label>

                                <input type="checkbox" id="form137" name="documents[]" value="Form137">
                                <label for="form137">Form 137</label>

                                <input type="checkbox" id="form138" name="documents[]" value="Form138">
                                <label for="form138">Form 138</label>

                                <input type="checkbox" id="tor" name="documents[]" value="TOR">
                                <label for="tor">Transcript of Records</label>

                                <input type="checkbox" id="goodMoral" name="documents[]" value="GoodMoral">
                                <label for="goodMoral">Certificate of Good Moral</label>
                            </div>
                            </div><br><br>
                            <div class="fields">
                                <span class="title"><h5>For Returning or Transferee</h5></span><br>
                                <div class="input-field">
                                    <label for="">Last Grade Level Completed: </label>
                                    <input type="text" name="pastlvl">
                                    <label for="">Last School Year Attended:</label>
                                    <input type="text" name="lastyear"><br><br>
                                    <label for="">Last School Attended</label>
                                    <input type="text" name="lastschool">
                                </div>
                            </div>
                                <br><br>
                                <button name="submit">Submit</button>
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