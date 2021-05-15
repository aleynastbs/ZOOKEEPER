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
                        <a class="nav-link" href="events_coordinator.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cages_coordinator.php">View & Assign Cages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reports_coordinator.php"><strong>View Reports</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class='headerCustom'>
            <h1 style="text-align:center">Reports</h3>
        </div>
        <?php
        include('configure.php');
        session_start();
        echo "<div class='row'>
        <div class='column'>
            <table style='width:80%' class='center'>
                <h3 style='text-align:center'>Comments Made for Group Tours</h3>
                <tr>
                    <th></th>
                    <th style='text-align:center'>ID</th>
                    <th style='text-align:center'>Name</th>
                    <th style='text-align:center'>Date</th>
                    <th style='text-align:center'>Comment Count</th>
                </tr>";
                      
                    $sql1 = "SELECT event_id, event_name, event.date, COUNT(comment_id) AS num_comments
                    FROM group_tour JOIN comments ON group_tour.group_tour_id = comments.groupTour_id JOIN event ON event.event_id = group_tour.group_tour_id
                    WHERE DATEDIFF(CURDATE(), event.date) BETWEEN 0 AND 30
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
                        FROM shop JOIN sells ON shop.shop_id=sells.shop_id JOIN item ON sells.item_id = item.item_id JOIN buys ON item.item_id = buys.item_id
                        WHERE DATEDIFF(CURDATE(), buys.purchase_date) BETWEEN 0 AND 30
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
        </div>
        <p>&nbsp;</p>";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $co_id = 4;
            if (isset($_GET['confirm2']))
            {
                if(!empty($_GET['flexRadioDefault1'])){
                $val = $_GET['flexRadioDefault1'];
                }
                if(!empty($_GET['flexRadioDefault2'])){
                $val2 = $_GET['flexRadioDefault2'];
                }
                if(!empty($_GET['flexRadioDefault1']) && !empty($_GET['flexRadioDefault2'])){
                    $sql="INSERT INTO Assigns (keeper_id, cage_id, coordinator_id) VALUES ('$val2', '$val', '$co_id')";
                    mysqli_query($mysqli,$sql);
                    echo "<script>window.location = 'assign_cages_coordinator.php';</script>";
                }
            }
        }
        ?>
</body>
</html>