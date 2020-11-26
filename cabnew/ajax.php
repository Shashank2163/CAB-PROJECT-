<?php
session_start();
if (isset($_POST['pickup']) || isset($_POST['$destination']) || isset($_POST['$cab']) || isset($_POST['$weight'])) {
    $pickup = $_POST['pickup'];
    $destination = $_POST['destination'];
    $cab = $_POST['cab'];
    $w = $_POST['weight'];
    $pick1 = 0;
    $pick2 = 0;
    $rupee = 0;
    $fare = array(
        "Charbagh" => 0,
        "Indira Nagar" => 10,
        "BBD" => 30,
        "Barabanki" => 60,
        "Faizabad" => 100,
        "Basti" => 150,
        "Gorakhpur" => 210
    );
    foreach ($fare as $key => $value) {
        if ($key == $pickup) {
            $pick1 = $value;
        }
    }
    foreach ($fare as $key => $value) {
        if ($key == $destination) {
            $pick2 = $value;
        }
    }
    $distance = $pick1 - $pick2;
    $distance = abs($distance);
    $_SESSION['distance'] = $distance;
    if (isset($cab)) {
        if ($cab == "CedMicro") {

            if ($distance <= 10) {
                $rupee = 50 + $distance * 13.50;
            } else if ($distance > 10 && $distance <= 60) {
                $distance = $distance - 10;
                $rupee = 185 + 12.00 * $distance;
            } else if ($distance > 60 && $distance <= 160) {
                $distance = $distance - 60;
                $rupee = 785 + 10.20 * $distance;
            } else {
                $distance = $distance - 160;
                $rupee = 785 + 100 * 10.20 + 8.50 * $distance;
            }
        } else if ($cab == "CedMini") {
            if ($distance > 0) {
                if ($distance <= 10) {
                    $rupee = 150 + $distance * 14.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $distance = $distance - 10;
                    $rupee = 295 + 13.00 * $distance;
                } else if ($distance > 60 && $distance <= 160) {
                    $distance = $distance - 60;
                    $rupee = 945 + 11.20 * $distance;
                } else {
                    $distance = $distance - 160;
                    $rupee = 945 + 11.20 * 100 + 9.50 * $distance;
                }
            }
            if (isset($_POST['weight'])) {
                if ($w > 0) {
                    if ($w <= 10) {
                        $rupee = $rupee + 50;
                    } else if (10 < $w && $w <= 20) {
                        $rupee = $rupee + 100;
                    } else if ($w > 20) {
                        $rupee = $rupee + 200;
                    }
                }
            }
        } else if ($cab == "CedRoyal") {
            if ($distance > 0) {
                if ($distance <= 10) {
                    $rupee = 200 + $distance * 15.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $distance = $distance - 10;
                    $rupee = 355 + 14.00 * $distance;
                } else if ($distance > 60 && $distance <= 160) {
                    $distance = $distance - 60;
                    $rupee = 1055 + 12.20 * $distance;
                } else {
                    $distance = $distance - 160;
                    $rupee = 1055 + 12.20 * 100 + 10.50 * $distance;
                }
            }

            if (isset($_POST['weight'])) {
                if ($w > 0) {
                    if ($w <= 10) {
                        $rupee = $rupee + 50;
                    } else if (10 < $w && $w <= 20) {
                        $rupee = $rupee + 100;
                    } else if ($w > 20) {
                        $rupee = $rupee + 200;
                    }
                }
            }
        } else if ($cab == "CedSUV") {
            if ($distance > 0) {
                if ($distance <= 10) {
                    $rupee = 250 + $distance * 16.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $distance = $distance - 10;

                    $rupee = 415 + 15.00 * $distance;
                } else if ($distance > 60 && $distance <= 160) {
                    $distance = $distance - 60;
                    $rupee = 1165 + 13.20 * $distance;
                } else {
                    $distance = $distance - 160;
                    $rupee = 1165 + 13.20 * 100 + 11.50 * $distance;
                }
            }
            if (isset($w)) {
                if ($w > 0) {
                    if ($w <= 10) {
                        $rupee = $rupee + 2 * 50;
                    } else if (10 < $w && $w <= 20) {
                        $rupee = $rupee + 2 * 100;
                    } else if ($w > 20) {
                        $rupee = $rupee + 2 * 200;
                    }
                }
            }
        }
    }

    if (!empty($pickup == $destination)) {
        echo "YOUR BOTH LOCATION ARE SAME";
    } elseif ($pickup == "" && $destination == "") {
        echo "Both Location Are Empty";
    } else if ($pickup == "" || $destination == "") {
        if ($pickup == "") {
            echo "Please Write Your Pickup Location";
        } else {
            echo "Please Write Your Drop  Location";
        }
    } else if ($cab == "") {
        echo "Please Select Your Cab Type";
    } else {
        $_SESSION['fare'] = $rupee;
        $_SESSION['start'] = $pickup;
        $_SESSION['end'] = $destination;
        $_SESSION['weight'] = $w;
        $_SESSION['cab'] = $cab;

        echo json_encode($rupee);
    }
}
if (isset($_POST["from_date"], $_POST["to_date"])) {
    $connect = mysqli_connect("localhost", "root", "", "cab");
    $output = '';
    $sql = "SELECT * FROM `tbl_ride` WHERE ride_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "'ORDER by  ride_date ASC";
    // echo $sql;
    $result = mysqli_query($connect, $sql);
    echo '<table>
    <tr>
        <th>USER ID</th>
        <th>RIDE DATE/TIME </th>
        <th>FROM</th>
        <th>TO</th>
        <th>DISTANCE</th>
        <th>WEIGHT</th>
        <th>FARE</th>
    </tr>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
        <td>';
            echo $row['customer_user_id'];
            echo '</td>
        <td>';
            echo $row['ride_date'];
            echo   '</td>
        <td>';
            echo $row['from_distance'];
            echo '</td>
        <td>';
            echo $row['to_distance'];
            echo '</td>
        <td>';
            echo $row['total_distance'];
            echo '</td>
        <td>';
            echo $row['luggage'];
            echo '</td>
        <td>';
            echo $row['total_fare'];
            '</td>
    </tr>';
        }
    }
    echo '<tr><td colspan="6"></td><td>';

    echo '</td></tr>';

    echo '<table>';
}