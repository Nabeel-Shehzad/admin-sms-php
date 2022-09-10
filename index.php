<?php
    session_start();
    ob_start();
    if(isset($_POST['Login'])){
        include_once ('connection.php');
        $username = $_SESSION['username'] = $_POST['username'];
        $password = $_SESSION['password'] = $_POST['password'];
        $data = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $Query = mysqli_query($DB, $data);
        $ROW = mysqli_fetch_assoc($Query);
        if($ROW) {
            echo "here";
            if ($ROW['access'] == 0) {
                $_SESSION['username'] = $ROW['username'];
                $_SESSION['name'] = $ROW['name'];
                header("Location: home.php");
            }
        }else {
            session_destroy();
            header("Location: index.php?Error=1");
        }
    }

?>
<!Doctype html>
<html>
<head>
    <title>SMS Admin</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar shadow-sm navbar-expand-lg py-3 py-lg-0 px-lg-5">
        <a href="home.php" class="navbar-brand ml-lg-3">
            <h1 class="m-0 display-5 text-dark"><span class="text-success">SMS</span>Tracking</h1>
        </a>
    </nav>
    <div class="container">
        <div class="row my-5">
            <div class="col-12 col-md-12 col-sm-12 text-center">
                <h1 class="text-dark">Login</h1>
                <?php
                    if(isset($_GET['Error']) && $_GET['Error'] ==1){
                        echo "<p class='text-danger'>Invalid Username or password</p>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-sm-12">
                <form action="index.php" method="post">
                    <input type="text" class="form-control" name="username" placeholder="Username"
                            required="required"/>
                    <br>
                    <input type="password" class="form-control" name="password" placeholder="Password"
                           required="required"/>
                    <br>
                    <input class="btn btn-outline-success form-control" name="Login" type="submit" value="Login"/>
                </form>
            </div>
        </div>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


</html>
