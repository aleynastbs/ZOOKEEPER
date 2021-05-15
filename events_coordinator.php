<!DOCTYPE html>
<html lang="en">
<?php
        include("configure.php");
        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === FALSE){
            header("location: login.php");
        } else if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_type'])){
            header("location: login.php");
        } else if($_SESSION['user_type'] != "coordinator"){
            header("location: login.php");
        }
?>
    <head>
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="employee.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Zoo</span>
            </div>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav navbar-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events_coordinator.php"><strong>Events</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cages_coordinator.php">View & Assign Cages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reports_coordinator.php">View Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class='headerCustom'>
            <h3 style="text-align:center">Events</h3>
        </div>
        <table style="width:80%" class="center">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Start/End Time</th>
                <th style="text-align:center">Current Participants</th>
                <th style="text-align:center">Max Capacity</th>
                <th style="text-align:center">Description</th>
              </tr>
            <?php
                $sql1 = "SELECT * FROM Event";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['event_id'] . 
                         "</td><td style='text-align:center'>" . $result['event_name'] . 
                         "</td><td style='text-align:center'>" . $result['date'] .
                         "</td><td style='text-align:center'>" . $result['start_at'] . " / " . $result['end_at'] .
                         "</td><td style='text-align:center'>" . $result['num_of_participants'] .
                         "</td><td style='text-align:center'>" . $result['max_capacity'] .
                         "</td><td style='text-align:center'>" . $result['description'] ."</td>";
                    echo "</tr>";
                }
                echo "</table>";
        ?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="text-center">
          <a href="create_event.php" class="btn btn-outline-success btn-lg" role="button">Create A New Event</a>
        </div> 
    </body>
</html>