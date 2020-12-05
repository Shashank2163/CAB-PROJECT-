<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'], $_SESSION['is_user'])) {
    header("location:../login.php");
}
include '../user.php';
$obj1 = new User();
$db1 = new config();
$result1 = $obj1->show($db1->conn);
if (isset($_POST['submit'])) {
    $password = $_REQUEST['password'];
    $password = md5($password);
    $repassword = $_REQUEST['repassword'];
    $repassword = md5($repassword);
    $db = new config();
    $obj = new User();
    $result = $obj->update_password($password, $repassword, $db->conn);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        CED CAB
    </title>
    <link href="../style.css" rel="stylesheet">
    <style>
    #logo-btn {
        background-color: #e8be3f;
        width: 115px;
        height: 42px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
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
        /* background-color: green; */

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
        height: 10px;
    }
    </style>
</head>

<body>

    <ul>
        <li>
            <p id="logo-p"><button id="logo-btn">CED<span id="logo-span">CAB</span></button></p>
        </li>
        <div class="nav-4">
            <!-- <li><a href="../login.php" id="remove">Login</a></li> -->
            <li>
                <?php if ($_SESSION['user_name'] == 'admin') echo ' <a href="../admin/admin.php" id="remove">Home</a></p>';
                else echo '<a href="user1.php" id="remove">Home</a></p>'; ?>
            </li>
        </div>

    </ul>
    <div class="container1">

        <h2>UPDATE YOUR PROFILE</h2>

        <form action="" method="post">
            <div class="imgcontainer">
                <img src="../avataar.png" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="text"><b> OLD Password</b></label>
                <input type="password" placeholder="Enter Old-Password" name="password" value="" required>
                <label for="repassword"><b>NEW -Password</b></label>
                <input type="password" placeholder="Enter New-Password" name="repassword" value="" required>
                <button type="submit" name="submit" value="Submit">UPDATE</button>
                <!-- <p> <a href="../login.php" id="remove">login</a></p> -->
            </div>
        </form>
    </div>
</body>
<footer>
    <p id="footer-text">Copyright@<span class="read-more">cedcoss</span>.com</p>
</footer>

</html>