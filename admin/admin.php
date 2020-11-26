<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION['user_name'])) {
    header("location:../login.php");
}
include('../src/config.php');
?>
<?php include('header.php'); ?>

<body>
    <?php include("navigation.php") ?>
    <h2>MANAGE USER</h2>
    <?php
    if (isset($_GET['user_id'])) {
        if ($_GET['action'] == 'remove') {
            $user_id = $_GET['user_id'];
            $sql = "DELETE FROM tbl_user WHERE `user_id`=$user_id";
            $result = mysqli_query($conn, $sql);
        } else if ($_GET['action'] == 'accept') {
            $user_id1 = $_GET['user_id'];
            $sql1 = "UPDATE  tbl_user SET isblock=1 WHERE `user_id`=$user_id1";
            $result1 = mysqli_query($conn, $sql1);
        } else if ($_GET['action'] == 'deny') {
            $user_id2 = $_GET['user_id'];
            $sql2 = "UPDATE  tbl_user SET isblock=0 WHERE `user_id`=$user_id2";
            $result2 = mysqli_query($conn, $sql2);
        }
    }
    ?>
    <?php show1();
    function show1()
    {
        include('../src/config.php');
        $sql = "SELECT * FROM tbl_user";
        $result = mysqli_query($conn, $sql); ?>
    <table id="add">
        <tr>
            <th>USER ID</th>
            <th>USERNAME</th>
            <th>NAME</th>
            <th>Mobile</th>
            <th>BLOCK(0)/UNBLOCK(1)</th>
            <th>DATE OF REQUEST</th>
            <th>ACCEPT</th>
            <th>DENY</th>
            <th>ACTION</th>
        </tr>
        <?php $s = 0;
            $result = mysqli_query($conn, $sql); ?>
        <?php if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['isblock'] ?></td>
            <td><?php echo $row['dateofsignup'] ?></td>
            <td>
                <a class="btn-accept" href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=accept" id="accept">
                    ACCEPT</a>
            </td>
            <td>
                <a href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=deny" id="deny"
                    class="btn-deny">DENY</a>
            </td>
            <td><a class="btn-deny" href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=remove" id="remove">
                    REMOVE </a>
            </td>
        </tr> <?php   } ?> <?php   } ?>
    </table> <?php  } ?>
</body>

</html>