<?php session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'], $_SESSION['is_user'])) {
    header("location:../login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CED CAB</title>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="cab.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
    <style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: black;
        color: white;
        text-align: center;
        padding: 10px;


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
    }

    #logo-span {
        color: red;
        padding-left: 7px;
    }

    #logo-p {
        margin: 6px;
    }
    </style>
    </script>
</head>

<body>
    <div class="container-fluid pr-0 pl-0">
        <nav class="navbar navbar-expand-sm navbar-light bg-dark ">
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
            <!-- <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-warning mx-2" href="index.php">BOOK NOW</a>
                    <li class="nav-item active mx-2"> <a class="btn btn-warning" href="password.php">RESET PASSWORD</a>
                    </li>
                    <a class="btn btn-warning mx-2" href="logout.php">LOG OUT</a>
                    </h3>
                </form>
            </div>
        </nav>
    </div>
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
                            $cn = $adm->countride1($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="dashboard1.php?&action=allrides" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-warning text-center">
                    <div class="card-body">
                        <h5 class="card-title">PENDING RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->pcountride1($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a id="penrd" class="btn btn-primary green" href="dashboard1.php?&action=pending">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">COMPLETED RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->cocountride1($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a href="dashboard1.php?&action=completed" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid  p-5">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card bg-info text-center">
                    <div class="card-body">
                        <h5 class="card-title">TOTAL SPEND</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $adm = new Ride();
                            $admc = new Config();
                            $cn = 0;
                            $cn = $cn + $adm->total5($admc->conn);
                            echo "₹" . $cn;
                            ?>
                        </p>
                        <a href="#" class="btn btn-primary green">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-danger text-center">
                    <div class="card-body">
                        <h5 class="card-title">CANCEL RIDES</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php
                            $cn = $adm->cancelride5($admc->conn);
                            print_r($cn);
                            ?>
                        </p>
                        <a id="penrd" class="btn btn-primary green" href="dashboard1.php?&action=cancel">Go To</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 ">
                <div class="card bg-success text-center">
                    <div class="card-body">
                        <h5 class="card-title">EDIT PROFILE</h5>
                        <p class="card-text font-weight-bold text-dark h1">
                            <?php echo '<h6 class="btn btn-success circle"><a href="profile.php"><img src="profile.png" alt="" height="20"
                                width="20">'; ?>
                        </p>
                        <a href="profile.php" class="btn btn-primary green">Go To</a>
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