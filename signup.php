<?php
include 'user.php';
$message = '';
if (isset($_POST['submit'])) {
    $username = $_REQUEST['username'];
    $username = trim($username);
    $name = $_REQUEST['name'];
    $dateofsignup = date('Y-m-d H:i:s');
    $isblock = 0;
    $isadmin = 0;
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['repassword'];
    $mobile = $_REQUEST['mobile'];
    $db = new config();
    $obj = new User();
    $obj->signup($username, $name, $dateofsignup, $isblock, $isadmin, $password, $repassword, $mobile, $db->conn);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        CED CAB
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script>
    $(document).ready(function() {
        $("#mob").bind("keypress", function(e) {
            var keyCode = e.which ? e.which : e.keyCode
            if (!(keyCode >= 48 && keyCode <= 57)) {
                return false;
            }
        });
    });
    </script>
    <style>
    #logo-btn {
        background-color: #e8be3f;
        width: 115px;
        height: 42px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        color: black;
    }

    #logo-span {
        color: red;
        padding-left: 7px;
    }

    body {
        margin: 0px;
        padding: 0px;

    }

    #logo-p {
        margin: 6px;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        /* padding: 14px 16px; */
        padding: 26px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: green;
    }

    footer {
        padding: 15px;
        background-color: black;
        color: white;
        text-align: center;
    }

    #footer-text {
        color: white;
    }

    .nav-4 {
        float: right;
    }
    </style>
</head>

<body>

    <ul>
        <li>
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
        </li>
        <div class="nav-4">
            <li><a class="active" href="cabnew/index.php">HOME</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </div>

        <!-- <li><a href="#about">About</a></li> -->
    </ul>
    <div class="container1">
        <h2>Sign Up</h2>

        <form action="" method="post">
            <div class="imgcontainer">
                <img src="avataar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" pattern="[A-Za-z0-9_]{1,20}"
                    title="Username should only contain letters numbers and undercsore And length should be 20."
                    required>

                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" pattern="[A-Za-z]{1,50}"
                    title="Name should only contain letters numbers And length should be 50." required>

                <label for="mobile"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Username" id="mob" name="mobile" maxlength="10" minlength="10"
                    required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="repassword"><b>RE-Password</b></label>
                <input type="password" placeholder="Enter Re-Password" name="repassword" required>

                <button type="submit" name="submit" value="Submit">SUBMIT</button>
        </form>
    </div>
    <!-- <p> <a href="login.php" id="remove">login</a></p>
                <p> <a href="cabnew/index.php" id="remove">Home</a></p> -->
    </div>

</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>