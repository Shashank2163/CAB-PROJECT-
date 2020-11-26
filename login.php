<!DOCTYPE html>
<html>

<head>
    <title></title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">

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
                <p> <a href="signup.php" id="remove">SIGN UP</a></p>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
</body>

</html>