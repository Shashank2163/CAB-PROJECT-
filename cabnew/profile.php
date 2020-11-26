<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'])) {
    header("location:../login.php");
}
include '../user.php';

$obj1 = new User();
$db1 = new config();
$result1 = $obj1->show($db1->conn);
if (isset($_POST['submit'])) {
    $name = $_REQUEST['name'];
    $dateofsignup = date('Y-m-d H:i:s');
    $isblock = 1;
    $isadmin = 0;
    $password = $_REQUEST['password'];
    $password = md5($password);
    $repassword = $_REQUEST['repassword'];
    $mobile = $_REQUEST['mobile'];
    $db = new config();
    $obj = new User();
    $result = $obj->update($name, $dateofsignup, $isblock, $isadmin, $password, $mobile, $db->conn);
    echo '<script>alert("Your Profile is Updated")</script>';
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
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username"
                    value="<?php echo $result1['user_name']; ?>" disabled>

                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" value="<?php echo $result1['name']; ?>">

                <label for="mobile"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Mobile No" name="mobile" value="<?php echo $result1['mobile']; ?>"
                    required>

                <label for="text"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" value="" required>

                <label for="repassword"><b>RE-Password</b></label>
                <input type="password" placeholder="Enter Re-Password" name="repassword" value="" required>

                <button type="submit" name="submit" value="Submit">UPDATE</button>
                <p> <a href="../login.php" id="remove">login</a></p>
                <p> <a href="index.php" id="remove">Home</a></p>


        </form>

    </div>
</body>

</html>