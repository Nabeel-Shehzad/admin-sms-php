<?php
    session_start();
    ob_start();
    include_once('connection.php');
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
    }
?>

<!Doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="style.css">
    <title>SMS Admin</title>
</head>
<body>
<nav class="navbar shadow-sm navbar-expand-lg py-3 py-lg-0 px-lg-5">
    <a href="home.php" class="navbar-brand ml-lg-3">
        <h1 class="m-0 display-5 text-dark"><span class="text-success">SMS</span>Tracking</h1>
    </a>
    <div class="container-fluid justify-content-end">
        <div class="row">
            <div class="col-12 col-md-6 col-sm-12">
                <a href="logout.php" class="btn btn-outline-danger ">Logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-12 col-md-12 ">
            <div class="col-sm-12">
                <div class="chatbody">
                    <div class="panel panel-primary">
                        <div class="panel-heading top-bar">
                            <div class="col-md-8 col-xs-8">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat - <?php echo $_GET['address'] ?></h3>
                            </div>
                        </div>
                        <div class="panel-body msg_container_base">
                            <?php
                                include_once ('connection.php');
                                $number = str_replace(' ','','%'.$_GET['address'].'%');
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM sms WHERE address LIKE '$number' AND device_id = '$id'";
                                $result = $DB->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['type'] == '1') {
                                            echo '<div class="row msg_container base_sent">';
                                            echo '<div class="col-md-10 col-xs-10">';
                                            echo '<div class="messages msg_sent">';
                                            echo '<p> <strong>' . $row['body'] . '</strong></p>';
                                            echo '<time datetime="2009-11-13T20:00" class="text-danger">' . $row['date'] . '</time>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="row msg_container base_receive">';
                                            echo '<div class="col-md-10 col-xs-10">';
                                            echo '<div class="messages msg_receive">';
                                            echo '<p> <strong>' . $row['body'] . '</strong></p>';
                                            echo '<time datetime="2009-11-13T20:00" class="text-danger">' . $row['date'] . '</time>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</html>

