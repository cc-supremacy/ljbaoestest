<?php
include("../session/student.session.php");
include("../connection/db.php");

if(isset($_SESSION['id'])){
        $mobile   = $_SESSION['mobile'];
        $documents = $_SESSION['documents'];
        $reg_no = $_SESSION['reg_no'];
        $fname    = $_SESSION['fname'];
        $mname    = $_SESSION['mname'];
        $lname    = $_SESSION['lname'];
        $xname    = $_SESSION['xname'];
        $birth    = $_SESSION['birth'];
        $pob      = $_SESSION['pob'];
        $tongue   = $_SESSION['tongue'];
        $age      = $_SESSION['age'];
        $sex      = $_SESSION['sex'];
        $strt     = $_SESSION['strt'];
        $brgy     = $_SESSION['brgy'];
        $mncpl    = $_SESSION['mncpl'];
        $prvnc    = $_SESSION['prvnc'];
        $cntry    = $_SESSION['cntry'];
        $ffname   = $_SESSION['ffname'];
        $fmname   = $_SESSION['fmname'];
        $flname   = $_SESSION['flname'];
        $mfname   = $_SESSION['mfname'];
        $mmname   = $_SESSION['mmname'];
        $mlname   = $_SESSION['mlname'];
        $gfname   = $_SESSION['gfname'];
        $gmname   = $_SESSION['gmname'];
        $glname   = $_SESSION['glname'];
        $lrn      = $_SESSION['lrn'];
        $stat     = $_SESSION['stat'];
        $hschool  = $_SESSION['hschool'];
        $hstrt    = $_SESSION['hstrt'];
        $hbrgy    = $_SESSION['hbrgy'];
        $hmncpl   = $_SESSION['hmncpl'];
        $hprvnc   = $_SESSION['hprvnc'];
        $hcntry   = $_SESSION['hcntry'];
        $lastyear  = $_SESSION['lastyear'];
        $lastschool  = $_SESSION['lastschool'];
        $pastlvl  = $_SESSION['pastlvl'];
        $enrollment = $_SESSION['enrollment'];
}



?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/sidestyle2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .custom-container {
    margin: 0 20px; /* Adjust left and right margins as needed */
    background-color: #e0e0e0; /* Set your desired background color */
    height: 350px; /* Set your desired height */
    width: calc(100% - 40px); /* Calculate width considering left and right margins */
    overflow: hidden;
}


.carousel-inner {
    transition: opacity 0.5s ease;
    max-height: 100%;
    height: 100%; /* Make the carousel take up the full height of the container */
}

.carousel-item {
    height: 100%; /* Make each carousel item take up the full height */
}

.carousel-item img {
    object-fit: contain; /* Ensure the images cover the entire carousel item */
    height: 100%; /* Make the images take up the full height of the carousel item */
    overflow: hidden;
    transition: transform 1s ease;
}
.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 28%;
    transform: translateY(-50%);
    width: auto;
    margin-top: -30px; /* Adjust this value to move the controls up or down */
    background: none; /* Remove background */
    border: none; /* Remove border */
}

.carousel-control-prev {
    margin-left: 0px;
    left: 0;
}

.carousel-control-next {
    right: 0;
    margin-right: 0px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: none; /* Remove hover background */
}



    </style>
</head>

<body>
    <?php include('student.sidebar.php'); ?>
    <section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text"> &nbsp &nbsp &nbsp HomePage</span>
    </div>
    <div class="custom-container">
    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../images/image1.jpeg" class="d-block w-100 h-100" alt="Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/image2.jpeg" class="d-block w-100 h-100" alt="Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/image3.jpeg" class="d-block w-100 h-100" alt="Image 3">
                    </div>
                    <!-- Add more carousel items with different images as needed -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
</button>
            </div>
          
</section>


    <script src="../script.js"></script>
    

</body>

</html>