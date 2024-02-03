<?php
include("../session/student.session.php");
include("../connection/db.php");

if (isset($_POST['submit'])) {
    $lrn = $_POST['username'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM `students` WHERE lrn = '$lrn' AND pass = '$password'";
    $result = mysqli_query($connection, $query);
    $r = mysqli_fetch_assoc($result);

    if (!empty($r['id'])) {
        session_start();
        $_SESSION['mobile'] = $r['mobile'];
        $_SESSION['documents'] = $r['documents'];
        $_SESSION['id'] = $r['id'];
        $_SESSION['reg_no'] = $r['reg_no'];
        $_SESSION['fname'] = $r['fname'];
        $_SESSION['mname'] = $r['mname'];
        $_SESSION['lname'] = $r['lname'];
        $_SESSION['xname'] = $r['xname'];
        $_SESSION['birth'] = $r['birth'];
        $_SESSION['pob'] = $r['pob'];
        $_SESSION['tongue'] = $r['tongue'];
        $_SESSION['age'] = $r['age'];
        $_SESSION['sex'] = $r['sex'];
        $_SESSION['strt'] = $r['strt'];
        $_SESSION['brgy'] = $r['brgy'];
        $_SESSION['mncpl'] = $r['mncpl'];
        $_SESSION['prvnc'] = $r['prvnc'];
        $_SESSION['cntry'] = $r['cntry'];
        $_SESSION['ffname'] = $r['fatherfname'];
        $_SESSION['fmname'] = $r['fathermname'];
        $_SESSION['flname'] = $r['fatherlname'];
        $_SESSION['mfname'] = $r['motherfname'];
        $_SESSION['mmname'] = $r['mothermname'];
        $_SESSION['mlname'] = $r['motherlname'];
        $_SESSION['gfname'] = $r['guardianfname'];
        $_SESSION['gmname'] = $r['guardianmname'];
        $_SESSION['glname'] = $r['guardianlname'];
        $_SESSION['lrn'] = $r['lrn'];
        $_SESSION['stat'] = $r['stat'];
        $_SESSION['hschool'] = $r['hschool'];
        $_SESSION['hstrt'] = $r['hstrt'];
        $_SESSION['hbrgy'] = $r['hbrgy'];
        $_SESSION['hmncpl'] = $r['hmncpl'];
        $_SESSION['hprvnc'] = $r['hprvnc'];
        $_SESSION['hcntry'] = $r['hcntry'];
        $_SESSION['lastyear'] = $r['lastyear'];
        $_SESSION['lastschool'] = $r['lastschool'];
        $_SESSION['pastlvl'] = $r['pastlvl'];
        $_SESSION['enrollment'] = $r['enrollment'];

        header("Location: student.profile.php");
    } else {
        echo "<script> alert ('Invalid LRN or Password.'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Student Login</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-8">
                    <div class="top-section">
                        <!-- Image carousel for portfolio -->
                        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../images/image2.jpeg" class="d-block w-100" alt="Background Image">
                                </div>
                                <div class="carousel-item">
                                    <img src="../images/image1.jpeg" class="d-block w-100" alt="Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="../images/image3.jpeg" class="d-block w-100" alt="Image 3">
                                </div>
                                <!-- Add more carousel items with different images as needed -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="bottom-section">
            
                    <div id="navCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Carousel Item 1 (Active) -->
        <div class="carousel-item active">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝LORD JESUS BLESSED ACADEMY❞</h5>
            <p class="carousel-text">✶ Lorem ipsum dolor sit amet consectetur adipisicing elit. Verita earum soluta beatraesentium iure 
                modi doloribus corrupti voluptate, excepturi quam! Laborum?</p>
        </div>

        <!-- Carousel Item 2 -->
        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝VISION❞</h5>
            <p class="carousel-text">✶ Through quality education community will be transformed into 
                peaceful, progressive, globally competitive, united in the common aspiration
                of achieving richer and fuller lives in the service of God and country.
            </p>
        </div>

        <!-- Carousel Item 3 -->
        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝MISSION❞</h5>
            <p class="carousel-text">✶ Lord Jesus' Blessed Academy is committed to provide high quality education, to produce
                morally, upright, healthy, economically, self-sufficient, peace-loving citizen, responsive to the needs of the 
                community and country.
            </p>
        </div>

        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝CORE VALUES❞</h5>
            <p class="carousel-text">✶ Exemplary Discipline   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ✶ Academic Excellence 
            <br>✶ Leadership   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ✶ Environmental Conservation
            <br>✶ Voluntary Service   &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ✶ Outstanding Service Performance 
            <br>&nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  out of class activities
            </p>
        </div>

        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝FAQS❞</h5>
            <p class="carousel-text">
            ✶ Can I see my grades if I haven't paid my tuition?    
            <br>✶ Mode of Payments? 
            <br>✶ Do you accept irregular students? 
            <br> <a href="">Click here for full FAQs</a>
            </p>
        </div>

        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝CONTACT US❞</h5>
            <p class="carousel-text">✶ Number  
            <br>✶ Email Address
            <br>✶ Address
            
            </p>
        </div>

        <div class="carousel-item">
            <h5 class="carousel-title">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp❝MESSAGE US❞</h5>
            <label for="">✶ Name:</label><input type="text">
            
            <label for="">✶ Email:</label><input type="text"> <br>

            <label for=""> ✶Message:</label><input type="textarea 50">
        </div>

        <!-- Add more carousel items with different content as needed -->
    </div>

    
</div>
<!-- Navigation Arrows -->
<button class="carousel-control-prev" type="button" data-bs-target="#navCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#navCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right">
                        <div class="input-box">
                            <header>Lord Jesus <br> Blessed Academy</header>
                            <form action="" method="post">
                                <div class="input-field">
                                    <input type="text" class="input" name="username" required>
                                    <label for="username">LRN / Username </label>
                                </div>
                                <div class="input-field">
                                    <input type="password" class="input" name="pass" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="input-field">
                                    <input type="submit" class="submit" name="submit" id="submit" value="Sign In">
                                </div>
                            </form>
                            <a href="../registrationform.php">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
