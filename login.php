<?php
if (isset($_SESSION)) {
    session_start();
    session_destroy();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
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
    <?php include 'user.php'; ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['submit'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $pass = md5($pass);
            $db = new config();
            $obj = new User();
            $obj->login($user, $pass, $db->conn);
        }
    }
    ?>

    <ul>
        <li>
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
        </li>
        <div class="nav-4">
            <li><a class="active" href="cabnew/index.php">HOME</a></li>
            <li><a href="signup.php">SIGN UP</a></li>
        </div>
        <!-- <li><a href="#about">About</a></li> -->
    </ul>
    <div class="container1">
        <h2>Login Form</h2>
        <form action="" method="post">
            <div class="imgcontainer">
                <img src="avataar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit" name="submit" value="log in">Login</button>
                <!-- <p> <a href="signup.php" id="remove">SIGN UP</a></p> -->
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <!-- <button type="button" class="cancelbtn">Cancel</button> -->
                <!-- <span class="psw"><a href="cabnew/index.php">BACK TO HOME</a></span> -->
            </div>
        </form>
    </div>
    <footer>
        <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
    </footer>
</body>


</html>