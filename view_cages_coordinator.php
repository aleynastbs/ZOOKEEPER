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
                    <a class="nav-link" href="view_cages_coordinator.php"><strong>View & Assign Cages</strong></a>
                </li>
            </ul>
        </div>
    </nav>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php
        include('configure.php');
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if(isset($_GET['view_my_cage'])){
                echo "<h3 style='text-align:center'>Cages Assigned By You</h3>
                <table style='width:45%' class='center'>
                <tr>
                <th style='text-align:center'>Cage ID</th>
                <th style='text-align:center'>Keeper ID</th>
                <th style='text-align:center'>Cage Size</th>
                <th style='text-align:center'>Cage Type</th>
                <th style='text-align:center'>Animal Species</th>
                <td></td>
                </tr>";
                $co_id = 4;
                $sql1 = "SELECT Cage.cage_id, cage_size, cage_type, animal_species, Animal.animal_id, Keeper.keeper_id
                        FROM Cage, Belongs_to, Animal, Keeper 
                        WHERE Cage.cage_id = Belongs_to.cage_id and Belongs_to.animal_id = Animal.animal_id 
                            and ('$co_id', Cage.cage_id, Keeper.keeper_id) in (SELECT coordinator_id, cage_id, keeper_id FROM Assigns)";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['cage_id'] . 
                         "</td><td style='text-align:center'>" . $result['keeper_id'] .
                         "</td><td style='text-align:center'>" . $result['cage_size'] . 
                         "</td><td style='text-align:center'>" . $result['cage_type'] ."</td>" .
                         "<td style='text-align:center'>" . $result['animal_species'] ."</td>";
                    echo "<th style='text-align:center' scope='row' ><a href='#link' class='btn btn-outline-success btn-sm' role='button'>More Details</a></th>"; 
                    echo "</tr>";
                 }
                echo "</table>";
                echo "<p>&nbsp;</p>
                <p>&nbsp;</p>
                <div class='text-center'>
                  <a href='assign_cages.html' class='btn btn-outline-success btn' role='button'>Assign Cage</a>
                </div> 
                <p>&nbsp;</p>
                <div class='text-center'>
                  <a href='view_cages_coordinator.php' class='btn btn-outline-success btn' role='button'>Back to Unassigned Cages</a>
                </div> ";
            }
            else{
                echo "<h3 style='text-align:center'>Unassigned Cages</h3>
                <table style='width:45%' class='center'>
                <tr>
                <th style='text-align:center'>Cage ID</th>
                <th style='text-align:center'>Cage Size</th>
                <th style='text-align:center'>Cage Type</th>
                <th style='text-align:center'>Animal Species</th>
                <td></td>
                </tr>";
                $sql1 = "SELECT Cage.cage_id, cage_size, cage_type, animal_species, Animal.animal_id 
                                FROM Cage, Belongs_to, Animal 
                                WHERE Cage.cage_id = Belongs_to.cage_id and Belongs_to.animal_id = Animal.animal_id 
                                                                        and Cage.cage_id not in (SELECT cage_id FROM Assigns)";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['cage_id'] . 
                         "</td><td style='text-align:center'>" . $result['cage_size'] . 
                         "</td><td style='text-align:center'>" . $result['cage_type'] ."</td>" .
                         "<td style='text-align:center'>" . $result['animal_species'] ."</td>";
                    echo "<th style='text-align:center' scope='row' ><a href='#link' class='btn btn-outline-success btn-sm' role='button'>More Details</a></th>"; 
                    echo "</tr>";
                }
                echo "</table>";
                echo "<p>&nbsp;</p>
                <p>&nbsp;</p>
                <div class='text-center'>
                  <a href='assign_cages.html' class='btn btn-outline-success btn' role='button'>Assign Cage</a>
                </div> 
                <form class='cage-form' method='get'>
                <input type='submit'  class='btn btn-outline-success' value='View Cages Assigned By You' name='view_my_cage'/>
                </form>";
            }
        }
        ?>
    
</body>
</html>