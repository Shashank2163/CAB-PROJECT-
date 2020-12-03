<?php
include 'user.php';
$message = '';
if (isset($_POST['submit'])) {
    $username = $_REQUEST['username'];
    // $username = $username . trim();
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
        Register
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
</head>

<body>
    <div class="container1">

        <h2>Sign Up</h2>

        <form action="" method="post">
            <div class="imgcontainer">
                <img src="avataar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required>

                <label for="mobile"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Username" id="mob" name="mobile" maxlength="10" minlength="10"
                    required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="repassword"><b>RE-Password</b></label>
                <input type="password" placeholder="Enter Re-Password" name="repassword" required>

                <button type="submit" name="submit" value="Submit">SUBMIT</button>
                <p> <a href="login.php" id="remove">login</a></p>
                <p> <a href="cabnew/index.php" id="remove">Home</a></p>
            </div>
</body>

</html>