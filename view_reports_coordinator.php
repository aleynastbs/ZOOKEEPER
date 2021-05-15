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
                        <a class="nav-link" href="coordinator_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events_coordinator.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cages_coordinator.php">View & Assign Cages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reports_coordinator.php"><strong>View Reports</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class='headerCustom'>
            <h1 style="text-align:center">Reports</h1>
        </div>
        <?php
        $filter_days = 10000;
        if(isset($_POST['filter'])){
            $filter_days = (int) $_POST['date-range'];
            unset($_POST['filter']);
        }
        echo "<div class='row'>
        <div class='column'>
            <table style='width:80%' class='center'>
                <h3 style='text-align:center'>Comments Made for Group Tours</h3>
                <tr>
                    <th style='text-align:center'>ID</th>
                    <th style='text-align:center'>Name</th>
                    <th style='text-align:center'>Date</th>
                    <th style='text-align:center'>Comment Count</th>
                </tr>";
                      
                    $sql1 = "SELECT event_id, event_name, event.date, COUNT(comment_id) AS num_comments
                    FROM group_tour LEFT JOIN comments ON group_tour.group_tour_id = comments.groupTour_id JOIN event ON event.event_id = group_tour.group_tour_id
                    WHERE DATEDIFF(CURDATE(), event.date) BETWEEN 0 AND $filter_days
                    GROUP BY event_id;";
                    
                    $query = mysqli_query($mysqli,$sql1);
                    while($result = $query -> fetch_assoc()) {
                        echo '<tr>';
                        echo "<td style='text-align:center'>" . $result['event_id'] .
                            "</td><td style='text-align:center'>" . $result['event_name'] . 
                            "</td><td style='text-align:center'>" . $result['date'] .
                            "</td><td style='text-align:center'>" . $result['num_comments'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>
                    <p>&nbsp;</p>
            </div>
            <div class='column'>
                <table style='width:80%' class='center'>
                    <h3 style='text-align:center'>Items Sold by Shop</h3>
                    <tr>
                        <th style='text-align:center'>ID</th>
                        <th style='text-align:center'>Name</th>
                        <th style='text-align:center'>Total Items Sold</th>
                    </tr>";
                      
                        $sql1 = "SELECT shop.shop_id, shop.shop_name, SUM(amount) AS items_sold
                        FROM shop LEFT JOIN sells ON shop.shop_id=sells.shop_id JOIN item ON sells.item_id = item.item_id JOIN buys ON item.item_id = buys.item_id
                        WHERE DATEDIFF(CURDATE(), buys.purchase_date) BETWEEN 0 AND $filter_days
                        GROUP BY shop.shop_id;";
                        $query = mysqli_query($mysqli,$sql1);
                        while($result = $query -> fetch_assoc()) {
                            echo '<tr>';
                            echo "<td style='text-align:center'>" . $result['shop_id'] .
                                "</td><td style='text-align:center'>" . $result['shop_name'] .
                                "</td><td style='text-align:center'>" . $result['items_sold'] ."</td>";
                            echo "</tr>";
                        }
                    echo "</table>
                    <p>&nbsp;</p>
            </div>
        </div>"
        ?>
        
        <form method='post' class='table-form'>
            <div class='select-margin'>
                <select name='date-range'>
                    <option value='10000'<?php if ($filter_days == 10000) echo ' selected="selected"'; ?>>All</option>
                    <option value='365'<?php if ($filter_days == 365) echo ' selected="selected"'; ?>>Last Year</option>
                    <option value='90'<?php if ($filter_days == 90) echo ' selected="selected"'; ?>>Last 3 Months</option>
                    <option value='30'<?php if ($filter_days == 30) echo ' selected="selected"'; ?>>Last Month</option>
                </select>
            </div>
            <div class='select-margin'>
                <input type='submit'  class='btn btn-outline-success' style='width: 20%' value='Filter Reports' name='filter'/>
            </div>
        </form>
        <p>&nbsp;</p>
    </body>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</html>