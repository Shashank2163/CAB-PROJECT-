<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title></title>
</head>

<body>
    <h1 id="admin-panel">ADMIN PANEL</h1>
    <nav class="navbar navbar-expand-lg bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link " href="#"><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  text-light" href="#" tabindex="-1">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>


    <h1></h1>
    <div class="row pl-lg-5">
        <div class="col-sm-6 col-lg-3">
            <div class="card bg-success text-center">
                <div class="card-body">
                    <h5 class="card-title">All Rides</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php include('../ride.php'); ?>
                        <?php
                        $adm = new Ride();
                        $admc = new Config();
                        $cn = $adm->countride($admc->conn);
                        print_r($cn); ?></p>
                    <a href="allrides.php#allr" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-warning text-center">
                <div class="card-body">
                    <h5 class="card-title">Pending Rides</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $cn = $adm->pcountride($admc->conn);
                        print_r($cn); ?></p>
                    <a id="penrd" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-info text-center">
                <div class="card-body">
                    <h5 class="card-title">Completed Rides</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $cn = $adm->cocountride($admc->conn);
                        print_r($cn); ?></p>
                    <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row pt-4 pl-lg-5">
        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-danger text-center">
                <div class="card-body">
                    <h5 class="card-title">Cancelled Rides</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $cn = $adm->cacountride($admc->conn);
                        print_r($cn); ?></p>
                    <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-success text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Earning</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $en = $adm->total1($admc->conn);
                        ?>₹<?php echo $en; ?></p>
                    <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-success text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $us = $adm->countuser($admc->conn);
                        echo $us; ?></p>
                    <a href="allusers.php" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row pt-4 pl-lg-5">

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-success text-center">
                <div class="card-body">
                    <h5 class="card-title">Approved Users</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $au = $adm->acountuser($admc->conn);
                        print_r($au); ?></p>
                    <a href="allusers.php" class="btn btn-primary green">Go To</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 ">
            <div class="card bg-warning text-center">
                <div class="card-body">
                    <h5 class="card-title">Pending Users</h5>
                    <p class="card-text font-weight-bold text-dark h1">
                        <?php
                        $pu = $adm->pcountuser($admc->conn);
                        echo $pu; ?></p>
                    <a href="aprove.php" class="btn btn-primary green">Go To</a>
                </div>
            </div>
            <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ALL RIDES</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header">PENDING RIDES</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">COMPLETED RIDES</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ALL USER</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header">PENDING USER</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">SUCCESS USER</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h5 class="card-title">Primary card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's
                            content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script> -->

            <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>