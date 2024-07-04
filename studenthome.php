<?php
session_start();

 if(!isset($_SESSION['username']))
 {
    header("location:login.php");
 }
 elseif($_SESSION['usertype']=='student')

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header  class="header">
        <a href="" class="admin">Student  Dashboard</a>
    <div class="logout">

        <a href=" logout.php"class="btn btn-primary">Logout</a>
</div>
</header>

    <ul>
    <li>
      <a href="student_profile.php">My profile</a>
   </li>
     <li>
      <a href=" ">My Courses</a>
   </li>
   <li>
      <a href=" ">My Result</a>
   </li>
</ul>



</body>
</html>