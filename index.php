<?php
error_reporting(0);
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";  // Use the correct password if there is one
$db = "schoolproject";

$connection = mysqli_connect($host, $user, $password, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch teachers
$sql_teacher = "SELECT * FROM teacher";
$result_teacher = mysqli_query($connection, $sql_teacher);

// Fetch courses
$sql_course = "SELECT * FROM course"; // Corrected spelling
$result_course = mysqli_query($connection, $sql_course);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav>
        <label class="logo">W-School</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="ad.php">Admission</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>

    <div class="section1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ">
                    <img class="main_img" src=>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="welcome" src="s2">
                </div>
                <div class="col-md-8">
                    <h1>Welcome to W-School</h1>
                    <p>
                    <p>
      where we provide a nurturing and innovative educational environment. Our school prides itself on academic excellence with a comprehensive curriculum tailored to individual learning styles, delivered by dedicated and experienced teachers focused on student success. Our state-of-the-art facilities include modern classrooms, labs, a library, and sports amenities. We offer diverse extracurricular programs in sports, arts, and various clubs to help develop well-rounded individuals. Emphasizing community, we foster collaboration, family involvement, and social responsibility, while integrating cutting-edge technology to enhance learning and digital literacy
      </p>
                    </p>
                </div>
            </div>
        </div>

        <center>
            <h1 class="teach"> Our Teachers</h1>
        </center>

        <div class="container">
            <div class="row">
                <?php while ($teacher_info = mysqli_fetch_assoc($result_teacher)): ?>
                    <div class="col-md-4">
                        <img class="teacher" src="<?php echo $teacher_info['image']; ?>" alt="Teacher Image">
                        <h3><?php echo $teacher_info['name']; ?></h3>
                        <h5><?php echo $teacher_info['description']; ?></h5>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <center>
            <h1> Our Courses</h1>
        </center>

        <div class="container">
            <div class="row">
                <?php while ($course_info = mysqli_fetch_assoc($result_course)): ?>
                    <div class="col-md-4">
                        <img class="course" src="<?php echo $course_info['image']; ?>" alt="Course Image">
                        <h3><?php echo $course_info['name']; ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <center>
            <h1>Admission form</h1>
        </center>

        <div align="center" class="admission_form">
            <form action="data_check.php" method="POST">
                <div class="adm_in">
                    <label class="label_txt">Name</label>
                    <input class="input_deg" type="text" name="name">
                </div>
                <div class="adm_in">
                    <label class="label_txt">Email</label>
                    <input class="input_deg" type="text" name="email">
                </div>
                <div class="adm_in">
                    <label class="label_txt">Phone</label>
                    <input class="input_deg" type="text" name="phone">
                </div>
                <div class="adm_in">
                    <label class="label_txt">Message</label>
                    <textarea class="inp_txt" name="message"></textarea>
                </div>
                <div class="adm_in">
                    <input class="btn btn-primary" type="submit" id="submit" value="Apply" name="apply">
                </div>
            </form>
        </div>

    </div>

    <footer>
        <div class="footer_txt">All &copy; rights reserved by web tech knowledge</div>
    </footer>

</body>
</html>
