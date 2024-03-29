<?php
session_start();
$username = $_SESSION['user_name'];
if (isset($_SESSION['is_user'])) {
    header("location:../cabnew/");
} else if (!isset($_SESSION['user_name'], $_SESSION['is_admin'])) {
    header("location:../login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>CED CAB</title>
    <style>
    footer {
        padding: 15px;
        background-color: black;
        color: white;
        text-align: center;
    }

    #footer-text {
        color: white;
    }

    #logo-btn {
        background-color: rgb(255 208 0);
        width: 100px;
        height: 38px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        margin-top: -6px;
    }

    #logo-span {
        color: red;
        padding-left: 7px;
    }

    #logo-p {
        margin: 6px;
    }
    </style>
    <!-- <link href="style.css" rel="stylesheet"> -->
</head>

<body>
    <?php include('navigation.php'); ?>
    <!-- <nav class="navbar navbar-expand-lg bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p> -->
    <!-- <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3>
                <li class="nav-item">
                    <a class="nav-link text-light" href="admin.php">MANAGE USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="alluser.php">ALL USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="rides.php?id=2">RIDE REQUEST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="allrides.php">ALL RIDES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="location.php">ADD LOCATION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="../cabnew/profile.php">RESET PASSWORD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">LOG OUT</a>
                </li>
            </ul>
        </div> -->
    <!-- </nav> -->
    <div class="container-fluid  p-5">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card bg-info text-center">
                    <div class="card-body">
                        <h5 class="card-title">ALL RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php include('../ride.php'); ?>
                            <?php
                            $adm = new Ride();
                            $admc = new Config();
                            $cn = $adm->countride($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="allrides.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-warning text-center">
                    <div class="card-body">
                        <h5 class="card-title">PENDING RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->pcountride($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a id="penrd" class="btn btn-primary green" href="allrides.php">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">COMPLETED RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->cocountride($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="allrides.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4 ">
            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-info text-center">
                    <div class="card-body">
                        <h5 class="card-title">ALL USER</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->countuser($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="alluser.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-warning text-center">
                    <div class="card-body">
                        <h5 class="card-title">PENDING USER</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $en = $adm->pcountuser($admc->conn);
                            print_r($en);
                            ?>
                        </p>
                        <a href="alluser.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">APPROVED USER</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $us = $adm->acountuser($admc->conn);
                            echo $us;
                            ?>
                        </p>
                        <a href="alluser.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row pt-4 ">
            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-info text-center">
                    <div class="card-body">
                        <h5 class="card-title">ALL LOCATION</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->all_location1($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="location.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-warning text-center">
                    <div class="card-body">
                        <h5 class="card-title">BLOCKED LOCATION</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $en = $adm->blocked_location1($admc->conn);
                            print_r($en);

                            ?>
                        </p>
                        <a href="location.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">TOTAL EARNING</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            ₹<?php
                                $us = $adm->total1($admc->conn);
                                echo $us;
                                ?>
                        </p>
                        <a href="allrides.php" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>