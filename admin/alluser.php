<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script>
    $(document).ready(function() {
        $("#btn").click(function() {
            var y = $("#ride").val();
            // console.log(x);
            $.ajax({
                url: "../cabnew/ajax.php",
                method: "POST",
                data: {
                    y: y
                },
                success: function(msg) {

                    $(".main").html(msg);
                }
            });
        });

    });
    </script>
</head>

<body>
    <?php include("navigation.php") ?>
    <select id="ride">
        <option value="12">
            ALL USERS
        </option>
        <option value="10">
            PENDING REQUESTS
        </option>
        <option value="11">
            APPROVED REQUESTS
        </option>
    </select>
    <input type="button" id="btn" value="PRESS">
    <div class="main"></div>
</body>

</html>