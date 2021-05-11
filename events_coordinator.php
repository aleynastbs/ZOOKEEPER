<!DOCTYPE html>
<html lang="en">
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
                </ul>
            </div>
        </nav>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        
        <h3 style="text-align:center">Events</h3>
        <table style="width:45%" class="center">
            <tr>
                <th style="text-align:center">Event ID</th>
                <th style="text-align:center">Event Name</th>
                <th style="text-align:center">Event Date</th>
                <td></td>
              </tr>
            <?php
                include('configure.php');
                session_start();
                $sql1 = "SELECT * FROM Event";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['event_id'] . 
                         "</td><td style='text-align:center'>" . $result['event_name'] . 
                         "</td><td style='text-align:center'>" . $result['date'] ."</td>";
                    echo "<th style='text-align:center' scope='row' ><a href='#link' class='btn btn-outline-success btn-sm' role='button'>More Details</a></th>"; 
                    echo "</tr>";
                }
                echo "</table>";
        ?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="text-center">
          <a href="create_event.html" class="btn btn-outline-success btn-lg" role="button">Create A New Event</a>
        </div> 
    </body>
</html>