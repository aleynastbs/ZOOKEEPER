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
        <title>ZOOKEEPER</title>
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
                        <a class="nav-link" href="view_cages_coordinator.php"><strong>View & Assign Cages</strong></a>
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
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <?php
        echo "
        <div class='headerCustom'>
            <h1 style='text-align:center'>Assign Cage</h1>
        </div>
        <div class='row'>
        <div class='column'>
        <form class='table-form' method='get'>
                <table style='width:80%' class='center'>
                    <h3 style='text-align:center'>Cage List</h3>
                    <tr>
                        <th></th>
                        <th style='text-align:center'>Cage ID</th>
                        <th style='text-align:center'>Cage Type</th>
                        <th style='text-align:center'>Cage Size</th>
                        <th style='text-align:center'>Species In Cage</th>
                      </tr>";
                      
                        $sql1 = "SELECT Cage.cage_id, cage_size, cage_type, animal_species, Animal.animal_id 
                        FROM ((Cage NATURAL JOIN Belongs_to)NATURAL JOIN Animal)
                        WHERE cage_id not in (SELECT cage_id FROM Assigns)
                        GROUP BY cage_id";
                        $query = mysqli_query($mysqli,$sql1);
                        while($result = $query -> fetch_assoc()) {
                            echo '<tr><td>
                            <input class="form-check-input" type="radio" value="', $result["cage_id"] , '" name="flexRadioDefault1"/></td>';
                            echo "<td style='text-align:center'>" . $result['cage_id'] . 
                                "</td><td style='text-align:center'>" . $result['cage_size'] . 
                                "</td><td style='text-align:center'>" . $result['cage_type'] ."</td>" .
                                "<td style='text-align:center'>" . $result['animal_species'] ."</td>";
                            echo "</tr>";
                        }
                    echo "</table>
                    <p>&nbsp;</p>
            </div>
            <div class='column'>
                <table style='width:80%' class='center'>
                    <h3 style='text-align:center'>Keeper List</h3>
                    <tr>
                        <th></th>
                        <th style='text-align:center'>Keeper ID</th>
                        <th style='text-align:center'>Keeper Name</th>
                      </tr>";
                      
                      $sql1 = "SELECT keeper_id, username FROM Keeper, User WHERE User.user_id=keeper_id";
                        $query = mysqli_query($mysqli,$sql1);
                        while($result = $query -> fetch_assoc()) {
                            echo '<tr><td>
                            <input class="form-check-input" type="radio" value="', $result["keeper_id"], '" name="flexRadioDefault2"/>
                            </td>';
                            echo "<td style='text-align:center'>" . $result['keeper_id'] . 
                                "</td><td style='text-align:center'>" . $result['username'] ."</td>";
                            echo "</tr>";
                        }
                    echo "</table>
                    <p>&nbsp;</p>
            </div>
            <div class='confirm-margin'>
            <input type='submit' style='width:5%' name='confirm2' class='btn btn-outline-success' id='confirm' value='Confirm'/></div>
            </form>
        </div>
        <p>&nbsp;</p>";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $co_id = $_SESSION['user_id'];
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
        <div class="text-center">
            <a href="view_cages_coordinator.php" class="btn btn-outline-success" role="button">Back To Assigned Cages</a>
        </div>
</body>
</html>