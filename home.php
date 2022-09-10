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
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12">
            <table id="employee_data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Manufacturer</th>
                    <th class="th-sm">Model</th>
                    <th class="th-sm">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php require 'connection.php' ?>
                <?php
                $sql = "SELECT * FROM devices";
                $result = $DB->query($sql);
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["name"]?></td>
                            <td><?php echo $row["manufacturer"]?></td>
                            <td><?php echo $row["model"]?></td>
                            <td>
                                <a class="btn btn-success btn-md" href="messages.php?id=<?php echo $row['id'] ?>">Check Messages</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>SMS ID</th>
                    <th>Contact</th>
                    <th>Date</th>
                    <th>Model</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#employee_data').DataTable();
    });
</script>
</html>
