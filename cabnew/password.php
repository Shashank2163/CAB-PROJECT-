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
        Register
    </title>
    <link href="../style.css" rel="stylesheet">
</head>

<body>
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
                <p> <a href="../login.php" id="remove">login</a></p>
                <p> <?php if ($_SESSION['user_name'] == 'admin') echo ' <a href="../admin/admin.php" id="remove">Home</a></p>';
                    else echo '<a href="index.php" id="remove">Home</a></p>'; ?>
        </form>
    </div>
</body>

</html>