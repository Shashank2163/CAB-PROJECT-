<?php
session_start();

/* FARE CALCULATION OF CUSTOMER */
if (isset($_POST['pickup']) || isset($_POST['$destination']) || isset($_POST['$cab']) || isset($_POST['$weight'])) {
    $pickup = $_POST['pickup'];
    $destination = $_POST['destination'];
    $cab = $_POST['cab'];
    $w = $_POST['weight'];
    $pick1 = 0;
    $pick2 = 0;
    $rupee = 0;
    include('../ride.php');
    $fare = [];
    $db = new config();
    $obj = new Ride();
    $result4 = $obj->alllocation($db->conn);
    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            array_push($fare, $row);
        }
    }
    foreach ($fare as $key => $value) {
        if ($value['name'] == $pickup) {
            $pick1 = $value['distance'];
        }
        if ($value['name'] == $destination) {
            $pick2 = $value['distance'];
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
/* END FARE CALCULATION OF CUSTOMER */


/* FILTRE ON DATE */
if (isset($_POST["from_date"], $_POST["to_date"], $_SESSION['user_name'])) {
    $connect = mysqli_connect("localhost", "root", "", "cab");
    $output = '';
    $user_id = $_SESSION['user_id'];
    $sql1 = "SELECT * FROM `tbl_ride` where  `customer_user_id`=$user_id AND (ride_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "')";
    // echo $sql1;
    $user_id = 0;
    $result1 = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $user_id = $row1['customer_user_id'];
        }
    }
    $sql = "SELECT * FROM `tbl_ride` WHERE 	`customer_user_id`=$user_id AND ( ride_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "')ORDER by  ride_date ASC";
    // echo $sql;
    $result = mysqli_query($connect, $sql);
    echo '<table>
    <tr>
        <th>USER ID</th>
        <th>RIDE DATE/TIME </th>
        <th>FROM</th>
        <th>TO</th>
        <th>DISTANCE(K.M.)</th>
        <th>WEIGHT(K.G.)</th>
        <th>STATUS</th>
        <th>FARE (₹)</th>
    </tr>';
    $total1 = 0;
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
            echo '</td>';
            echo '<td>';
            if ($row['status'] == 0) {
                echo "<span class='blink-two'>PENDING</span>";
            } else if ($row['status'] == 2) {
                echo "CANCEL";
            } else {
                echo "SUCCESS";
                $total = (int)$row['total_fare'];
                $total1 = $total1 + $total;
            }
            echo '</td>';
            echo '<td>';
            echo $row['total_fare'];
            '</td>
    </tr>';
        }
        echo '<tr><td colspan="7">TOTAL SPEND</td>';
        echo '<td>';
        echo "₹" . $total1;
        echo '</td></tr>';
    }


    echo '<table>';
}
/*END  FILTRE ON DATE */

/* PENDING ,SUCCESS AND ALL RIDES */
if (isset($_POST['x'])) {
    include('../ride.php');
    if ($_POST['x'] == 0) {
        $db = new Config();
        $obj1 = new Ride();
        $result = $obj1->pending($db->conn);
    } else  if ($_POST['x'] == 1) {
        $db = new Config();
        $obj1 = new Ride();
        $result = $obj1->success($db->conn);
    } else  if ($_POST['x'] == 3) {
        $db = new Config();
        $obj1 = new Ride();
        $result = $obj1->cancelride1($db->conn);
    } else  if ($_POST['x'] == 2) {
        $db = new Config();
        $obj1 = new Ride();
        $result = $obj1->allrides($db->conn);
    }

    echo '<table id="myTable">
    <tr>
        <th onclick="sortTable1(0)">USER ID</th>
        <th onclick="sortTable(1)">RIDE DATE/TIME  &#x2193;</th>
        <th onclick="sortTable(2)">FROM &#x2193;</th>
        <th onclick="sortTable(3)">TO &#x2193;</th>
        <th onclick="sortTable(4)">STATUS &#x2193;</th>
        <th onclick="sortTable(5)">DISTANCE(K.M.) &#x2193;</th>
        <th>WEIGHT(K.G.)</th>
        <th onclick="sortTable1(7)">FARE (₹)</th>
        <th>DETAILS</th>
    </tr>';
    $total1 = 0;

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
            if ($row['status'] == 0) {
                echo "<span class='blink-two'>PENDING</span>";
            } else if ($row['status'] == 2) {
                echo "CANCEL";
            } else {
                echo "SUCCESS";
            }
            echo '</td>
        <td>';
            echo $row['total_distance'];
            echo '</td> 
            <td>';
            echo $row['luggage'];
            echo '</td>
        <td>';

            echo $total = (int) $row['total_fare'];

            $total1 = $total1 + $total;
            echo '</td>';
            echo '<td>';
            if ($row['status'] == 0) {
                echo "<span class='blink-two'>PENDING</span>";
            } else if ($row['status'] == 2) {
                echo "CANCEL";
            } else {
                echo '<a href="invoice.php?user_id=' . $row["ride_id"] . '&action=invoice" id="btn-3">INVOICE</a>';
            }
            echo '</td>';
            echo  '</tr>';
        }
    }
    if ($_POST['x'] == 1) {
        echo '<tr><td colspan="8">TOTAL EARNING </td><td>₹' . $total1 . '</td></tr>';
    }
    echo '</td></tr>';

    echo '<table>';
}
/*END  PENDING ,SUCCESS AND ALL RIDES */


/*  PENDING ,SUCCESS AND ALL USERS */
if (isset($_POST['y'])) {
    include('../user.php');
    if ($_POST['y'] == 10) {
        $db = new Config();
        $obj1 = new User();
        $result = $obj1->pending_user($db->conn);
    } else  if ($_POST['y'] == 11) {
        $db = new Config();
        $obj1 = new User();
        $result = $obj1->success_user($db->conn);
    } else  if ($_POST['y'] == 12) {
        $db = new Config();
        $obj1 = new User();
        $result = $obj1->all_user($db->conn);
    }
    echo '<table id="myTable"><thead>
    <tr>
        <th onclick="sortTable1(0)">USER ID</th>
        <th >USER NAME</th>
        <th>NAME</th>
        <th onclick="sortTable1(1)">DATE/TIME</th>
        <th onclick="sortTable(2)">STATUS &#x2193;</th>
        <th onclick="sortTable(3)">MOBILE &#x2193;</th>
        <th>ALLOW</th>
        <th>DENY</th>
        <th>REMOVE</th>     
    </tr>
    </thead>';
    $count = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            echo '<tbody><tr>
        <td>';
            echo $row['user_id'];
            echo '</td>
        <td>';
            echo $row['user_name'];
            echo   '</td>
        <td>';
            echo $row['name'];
            echo '</td>
        <td>';
            echo $row['dateofsignup'];
            echo '</td>
        <td>';
            if ($row['isblock'] == 0) {
                echo "<span class='blink-two'>PENDING</span>";
            } else {
                echo "APPROVED";
            }
            echo '</td>
        <td>';
            echo $row['mobile'];
            echo '</td>
        </td>';
            echo '<td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=accept" id="btn-3">ACCEPT</a>';
            echo '</td>
        <td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=deny" id="btn-4">DENY</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=remove" id="btn-4">REMOVE</a>';
            echo '</tr></tbody>';
        }
        echo '<tfoot><tr><td colspan="8">';
        echo 'TOTAL NO USER';
        echo '</td><td>';
        echo  $count . '</td></tr></tfoot>';
    }
    echo '<table>';
}

/* END PENDING ,SUCCESS AND ALL USERS */


/* INSERT LOCATION, ALL LOCATION LIST */
if (isset($_POST['loc_name'])) {
    include('../ride.php');
    $db1 = new config();
    $obj = new Ride();
    $loc_name = $_POST['loc_name'];
    $distance = $_POST['distance'];
    $avail = $_POST['avail'];
    $result = $obj->insertloc($db1->conn, $loc_name, $distance, $avail);
    echo $result;
}
if (isset($_POST['dat'])) {
    if ($_POST['dat'] == 5) {
        include('../ride.php');
        $db1 = new config();
        $obj = new Ride();
        $result = $obj->alllocation($db1->conn);
        echo '<table id="myTable">
        <tr>
        <th colspan="9">
            <center>
                <h3>ALL LOCATION LIST</h3>
            </center>
        </th>
    </tr>
    <tr>
        <th onclick="sortTable1(0)">ID &#x2193;</th>
        <th>Name</th>
        <th onclick="sortTable1(1)">Distance (K.M.)&#x2193;</th>
        <th>STATUS</th>
        <th>ACCEPT</th>
        <th>DENY</th>  
        <th>REMOVE</th>      
    </tr>';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
         <td>';
                echo $row['id'];
                echo '</td>
                <td>';
                echo $row['name'];
                echo   '</td>
        <td>';
                echo $row['distance'];
                echo '</td>
        <td>';
                if ($row['is_available'] == 0) {
                    echo "DENY";
                } else {
                    echo "ALLOW";
                }
                echo '</td>';
                echo '<td>';
                echo '<a href="location.php?id=' . $row["id"] . '&action=accept" id="btn-3">ACCEPT</a>';
                echo '</td>';
                echo '<td>';
                echo '<a href="location.php?id=' . $row["id"] . '&action=deny" id="btn-4">DENY</a>';
                echo '</td>';
                echo '<td>';
                echo '<a href="location.php?id=' . $row["id"] . '&action=remove" id="btn-4">REMOVE</a>';
                echo '</td>';
                echo '</tr>';
            }
        }
        echo '<table>';
    }
}
/* END  INSERT LOCATION, ALL LOCATION LIST */


if (isset($_POST["fro_date"], $_POST["t_date"])) {
    $connect = mysqli_connect("localhost", "root", "", "cab");
    $output = '';

    $sql = "SELECT * FROM `tbl_ride` WHERE ride_date BETWEEN '" . $_POST["fro_date"] . "' AND '" . $_POST["t_date"] . "' ORDER by  ride_date ASC";
    // echo $sql;
    $result = mysqli_query($connect, $sql);
    echo '<table>
    <tr>
        <th>USER ID</th>
        <th>RIDE DATE/TIME </th>
        <th>FROM</th>
        <th>TO</th>
        <th>DISTANCE(K.M.)</th>
        <th>WEIGHT(K.G.)</th>
        <th>FARE(₹)</th>
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

if (isset($_POST['filter'])) {
    // if ($_POST['filter'] == 'filter') {
    include('../user.php');
    $db = new config();
    $obj = new User();
    $filter = $_POST['filter'];
    // echo $filter;
    $result = $obj->search_user($db->conn, $filter);
    // echo $result;
    echo '<table>
    <tr>
        <th>USER ID</th>
        <th>RIDE DATE/TIME </th>
        <th>FROM</th>
        <th>TO</th>
        <th>STATUS</th>
        <th>MOBILE</th>
        <th>ALLOW</th>
        <th>DENY</th>
        <th>REMOVE</th>    
    </tr>';
    $count = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            echo '<tr>
        <td>';
            echo $row['user_id'];
            echo '</td>
        <td>';
            echo $row['user_name'];
            echo   '</td>
        <td>';
            echo $row['name'];
            echo '</td>
        <td>';
            echo $row['dateofsignup'];
            echo '</td>
        <td>';
            if ($row['isblock'] == 0) {
                echo "PENDING";
            } else {
                echo "APPROVED";
            }
            echo '</td>
        <td>';
            echo $row['mobile'];
            echo '</td>
        </td>';
            echo '<td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=accept" id="btn-3">ACCEPT</a>';
            echo '</td>
        <td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=deny" id="btn-4">DENY</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="alluser.php?user_id=' . $row["user_id"] . '&action=remove" id="btn-4">REMOVE</a>';
            echo '</tr>';
        }
        echo '<tr><td colspan="8">';
        echo 'TOTAL NO USER';
        echo '</td><td>';
        echo  $count . '</td></tr>';
    }
    echo '<table>';
}