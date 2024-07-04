<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login from</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body background="schoolimg" class="body_deg">
    <center >
        <div class="form_deg">
            <center class="title_deg">
                Login from
                <h4>
                    <?php   
                    error_reporting(0);
                    session_start();
                    session_destroy();
                     echo $_SESSION['loginMessage'];
                    ?>


                </h4>
               </center>

            <form  action="login_check.php"  method="POST" class="login_from">
                <div >
                    <label class="label_deg">Username</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label class="label_deg">Password</label>
                    <input type="password" name="password">    
                </div>
                <div>
               
                    <input class="btn btn-primary " type="submit" id="sumbit" name="sumbit" value="Login">
                    
                </div>
            </form>
       </div>
    </center>
</body>
</html>
</html>