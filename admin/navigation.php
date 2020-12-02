<?php
echo '<h1>ADMIN PANEL</h1>
    <nav class="navbar navbar-expand-lg bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                 <li class="nav-item">
                   <a class="nav-link text-light" href="index.php">HOME</a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="admin.php">MANAGE USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="alluser.php">ALL USER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="rides.php?id=2">RIDE REQUEST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="allrides.php">ALL RIDES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="location.php">ADD LOCATION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="../cabnew/profile.php">RESET PASSWORD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">LOG OUT</a>
                </li>
            </ul>
        </div>
    </nav>';