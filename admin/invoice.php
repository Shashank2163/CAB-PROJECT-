<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">

        <?php
        $rideid;
        include('../src/config.php');
        session_start();
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $sql = "SELECT * FROM tbl_ride where `ride_id`=$user_id";
            echo '<a class="btn btn-warning" href="admin.php">Home</a>';
            // echo $user_id;
        } else {
            if (isset($_SESSION['user_name'])) {
                $user_id = $_SESSION['user_id'];
                echo '<a class="btn btn-warning" href="../cabnew/index.php">Home</a>';
                $sql = "SELECT * FROM tbl_ride where `customer_user_id`=$user_id";
            }
        }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rideid = $row['ride_id'];
                $ride_date = $row['ride_date'];
                $form_distance = $row['from_distance'];
                $to_distance = $row['to_distance'];
                $total_distance = $row['total_distance'];
                $luggage = $row['luggage'];
                $status = $row['status'];
                $total_fare = $row['total_fare'];
            }
        } ?>
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h3>CED CAB</h3>
                            </td>

                            <td>
                                Invoice #: <?php echo $rideid; ?><br>
                                Ride Date:<?php echo $ride_date; ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Toatal Distance
                </td>

                <td>
                    Distance
                </td>
            </tr>

            <tr class="details">
                <td>
                    Total Distance
                </td>
                <td>
                    <?php echo $total_distance; ?>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    From
                </td>

                <td>
                    To
                </td>
            </tr>

            <tr class="item">
                <td>
                    <?php echo $form_distance; ?>

                </td>

                <td>
                    <?php echo $to_distance; ?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Luggage
                </td>

                <td>
                    <?php echo $luggage; ?>
                </td>
            </tr>

            <tr class="item last">
                <td>
                    Status
                </td>

                <td>
                    <?php if ($status == 1) {
                        echo 'SUCCESS';
                    } else {
                        echo 'PENDING';
                    } ?>
                </td>
            </tr>

            <tr class="total">
                <td> TOTAL FARE </td>

                <td>
                    &#x20B9 <?php echo $total_fare; ?></td>
            </tr>
        </table>
        <a class="btn" href="../admin/logout.php">LOG OUT</a></br></br>
        <button onclick="window.print()">Print this page</button>

    </div>
</body>

</html>