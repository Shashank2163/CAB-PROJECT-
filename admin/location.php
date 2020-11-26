<?php
include('navigation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#btn-1").click(function() {
            var loc_name = $("#location_name").val();
            var distance = $("#distance").val();
            var avail = $("#avail").val();
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    loc_name: loc_name,
                    distance: distance,
                    avail: avail
                },
                success: function(msg) {
                    alert("Your Location IS Added");
                }
            });
        });
    });
    </script>
</head>

<body>
    <div class="container">
        <form action="/action_page.php">
            <div class="row">
                <div class="col-25">
                    <label for="locname">LOCATION NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="location_name" name="firstname" placeholder="Location Name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="distance">DISTANCE</label>
                </div>
                <div class="col-75">
                    <input type="text" id="distance" name="lastname" placeholder="Distance..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="available">AVAILABLE</label>
                </div>
                <div class="col-75">
                    <select id="avail" name="available">
                        <option value="1">Allow</option>
                        <option value="0">Block</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="button" value="Submit" id="btn-1">
            </div>
        </form>
    </div>
</body>

</html>