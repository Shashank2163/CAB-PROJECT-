<?php session_start();

if (!isset($_SESSION['user_name'], $_SESSION['is_user'])) {
    session_unset();
    unset($_SESSION['start'], $_SESSION['end'], $_SESSION['weight'], $_SESSION['cab'], $_SESSION['fare']);
    session_destroy();
}
?>
<!-- <a class="btn btn-warning mx-2" href="success.php?&action=fare">SORT BY FARE </a> -->
<!-- <a class="btn btn-warning mx-2" href="success.php?&id=2">FILTRE</a> -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CED CAB</title>
    <script src="cab.js">
    </script>
    <link href="cab.css" rel="stylesheet">
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
    }

    #logo-span {
        color: red;
        padding-left: 7px;
    }

    #logo-p {
        margin: 6px;
    }
    </style>
</head>
<script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>

<body>
    <div class="container-fluid pr-0 pl-0  ">
        <nav class="navbar navbar-expand-sm navbar-light nav-1">
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
            <!-- <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-5">
                    <?php if (isset($_SESSION['user_name'])) {
                        echo '<a class="btn btn-warning mx-2 " href="user1.php">DASHBOARD</a>
                    <a class="btn btn-warning" href="../admin/logout.php">LOG OUT</a>';
                    }
                    ?>
                    <?php if (!isset($_SESSION['user_name'])) {
                        echo '<li class="nav-item active"><a class="btn btn-success mx-2" href="../login.php">Log In</a></li>
                    <li class="nav-item active"> <a class="btn btn-success" href="../signup.php">Sign Up</a></li>';
                    } ?>
                </ul>
                <form class=" form-inline my-2 my-lg-0">
                    <!-- // if (isset($_SESSION['user_name'])) {
                    // echo '<h6 class="btn btn-warning circle"><a href="profile.php"><img src="profile.png" alt=""
                                height="20" // width="20">';
                            // echo "<figcaption>" . $_SESSION['user_name'] . "</figcaption>";
                            // } else {
                            // } -->
                    </a></h6>
                </form>
            </div>
        </nav>
    </div>
    <div class="container-fluid p-5 back-image">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center pb-5">
                <h1 class="wh1"> Book a City Taxi to your destination in town </h1>
                <p class="wh1">Choose range of categories and prices</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                <form class="text-center border border-light bg-light p-2" action="#" target="" method="">
                    <p>
                        <button type="button" class="btn btn-warning">City Taxi</button>
                    </p>
                    <p class="bg-warning text-dark">Your Everyday Travel Partner</p>
                    <p class="text-success"> AC Cabs For Point Travel </p>
                    <select class="form-control " id="current">
                        <label class="col-sm-3">PICK UP</label>
                        <option value="" selected disabled hidden>Your Pickup Location</option>

                        <?php
                        include('../ride.php');
                        $db = new config();
                        $obj = new Ride();
                        $result = $obj->alllocation1($db->conn);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {  ?>
                        <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
                        <?php  } ?>
                        <?php } ?>
                    </select>
                    <select class="form-control " id="drop">
                        <option value="" selected disabled hidden>Your Drop Location</option>
                        <?php
                        $db1 = new config();
                        $obj1 = new Ride();
                        $result1 = $obj1->alllocation1($db1->conn);
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                        <option value="<?php echo $row1['name'] ?>"><?php echo $row1['name'] ?></option>
                        <?php } ?>
                        <?php  } ?>
                    </select>
                    <select class="form-control" onchange="getval(this);" id="cab">
                        <option value="<?php if (isset($_SESSION['user_name'], $_SESSION['cab'])) {
                                            echo $_SESSION['cab'];
                                        } ?>" <?php if (!isset($_SESSION['user_name'])) {
                                                    echo "selected disabled";
                                                } ?>><?php if (isset($_SESSION['cab'], $_SESSION['cab'])) {
                                                            echo $_SESSION['cab'];
                                                        } else {
                                                            echo "Drop Down To Select Cab Type";
                                                        } ?></option>

                        <option value="CedMicro">CedMicro</option>
                        <option value="CedMini">CedMini</option>
                        <option value="CedRoyal">CedRoyal</option>
                        <option value="CedSUV">CedSUV</option>
                    </select>
                    <!-- Email -->
                    <?php if (isset($_SESSION['user_name'], $_SESSION['weight'])) {
                        if ($_SESSION['weight'] > 0) {
                            echo  '<input type="text" id="weight" class="form-control mb-4" value="' . $_SESSION['weight'] . '">';
                        } else {
                            echo ' <input type="text" id="weight"  class="form-control mb-4" placeholder="Enter Weight in Kg">';
                        }
                    } else {
                        echo ' <input type="text" id="weight"  class="form-control mb-4" placeholder="Enter Weight in Kg">';
                    }
                    ?>
                    <!-- <input type="text" id="weight" class="form-control mb-4" placeholder="Enter Weight in Kg"> -->
                    <p id="luggage" class="bg-danger">Luggage is Not Available</p>
                    <p id="message" class="bg-success"></p>
                    <p id="message1" class="bg-danger">Please Enter the Numeric Value!!</p>
                    <!-- Sign in button -->
                    <button class="btn btn-warning btn-block" id="calculate" type="button">Calculate Fare</button>
                    <a class="btn btn-success btn-block" id="book" href="success.php?id=1">BOOK NOW</a>
                </form>
            </div>
        </div>
    </div>
    <!-- <footer>
        <div class="container-fluid py-5">
            <div class="row">
                <div class=" col-md-4  col-sm-4 col-lg-4  col-xs-4 py-2 text-center"> <i
                        class="fab fa-facebook-f fa-lg white-text px-2"> </i> <i
                        class="fab fa-twitter fa-lg white-text px-2 "> </i> <i
                        class="fab fa-instagram fa-lg white-text px-2"> </i> </div>
                <div class=" col-md-4  col-sm-4  col-lg-4 col-xs-4 text-center">
                    <h3 class="btn btn-warning">CED <span class="text-danger">CAB</span></h3>
                </div>
                <div class="col-md-4 col-sm-4  col-lg-4 col-xs-4 text-center">
                    <div class="row py-2">
                        <div class="col-md-6 col-sm-6 col-lg-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer> -->
    <footer>
        <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>