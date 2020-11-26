<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hello, world!</title>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="style.css" rel="stylesheet">
    <!-- <link href="../admin/style.css" rel="stylesheet"> -->

    <script src="https://kit.fontawesome.com/4b2ee26aaa.js" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function() {
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $.ajax({
                    url: "../cabnew/ajax.php",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        $('#main').html(data);

                    }
                });
            } else {
                alert("Please Select Date");
            }
        });
    });
    </script>
</head>

<body>
    <?php
    include("navigation.php"); ?>
    <div class="container py-5 my-5">
        <div class="row ml-5 px-4">
            <div class="col-md-3 col-sm-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
            </div>
            <div class="col-md-3  col-sm-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
            </div>
            <div class="col-md-3  col-sm-4">
                <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
            </div>
        </div>
    </div>
    <div id="main"></div>
</body>

</html>