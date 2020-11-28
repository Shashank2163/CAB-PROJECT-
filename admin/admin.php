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
        $user_id = $_GET['user_id'];
        include('../user.php');
        if ($_GET['action'] == 'remove') {
            $db = new config();
            $obj = new User();
            $result = $obj->remove_user($db->conn, $user_id);
        } else if ($_GET['action'] == 'accept') {
            $db = new config();
            $obj = new User();
            $result = $obj->accept_user($db->conn, $user_id);
        } else if ($_GET['action'] == 'deny') {
            $db = new config();
            $obj = new User();
            $result = $obj->deny_user($db->conn, $user_id);
        }
        $db = new config();
        $obj = new User();
        $result = $obj->all_user($db->conn, $user_id);
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
            <th>BLOCK/UNBLOCK</th>
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
            <td><?php if ($row['isblock'] == 0) echo "BLOCK";
                            else echo "ALLOW"; ?></td>
            <td><?php echo $row['dateofsignup'] ?></td>
            <td> <a class="btn-accept" href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=accept"
                    id="accept"> ACCEPT</a>
            </td>
            <td> <a href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=deny" id="deny"
                    class="btn-deny">DENY</a></td>
            <td><a class="btn-deny" href="admin.php?user_id=<?php echo $row['user_id']; ?>&action=remove" id="remove">
                    REMOVE </a>
            </td>
        </tr> <?php
                        } ?> <?php
                            } ?>
    </table> <?php
                } ?>
</body>

</html>