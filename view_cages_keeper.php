<!DOCTYPE html>
<html lang="en">
<?php
        include("configure.php");
        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === FALSE){
            header("location: login.php");
        } else if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_type'])){
            header("location: login.php");
        } else if($_SESSION['user_type'] != "keeper"){
            header("location: login.php");
        }
?>
    <head>
        <title>Zoo</title>
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
                    <a class="nav-link" href="keeper_home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_cages_keeper.php"><strong>View My Cages</strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                echo "<div class='headerCustom'><h3 style='text-align:center'>My Cages</h3></div><form class='table-form' method='get'>
                <table style='width:45%' class='center'>
                <tr>
                <th style='text-align:center'>Cage ID</th>
                <th style='text-align:center'>Cage Size</th>
                <th style='text-align:center'>Cage Type</th>
                <th style='text-align:center'>Animal Species</th>
                <td></td>
                </tr>";
                $keep_id = $_SESSION['user_id'];
                $sql1 = "SELECT cage_id, cage_size, cage_type, animal_species
                        FROM ((Cage NATURAL JOIN Belongs_to)NATURAL JOIN Animal)
                        WHERE ($keep_id, cage_id) in (SELECT keeper_id, cage_id FROM Assigns)
                        GROUP BY cage_id";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['cage_id'] . 
                         "</td><td style='text-align:center'>" . $result['cage_size'] . 
                         "</td><td style='text-align:center'>" . $result['cage_type'] ."</td>" .
                         "<td style='text-align:center'>" . $result['animal_species'] ."</td>";
                    echo "<th style='text-align:center' scope='row'>";
                    echo '<input class="form-check-input" type="radio" value="', $result["cage_id"] , '" name="flexRadioDefault1"/></td>';
                    echo "</tr>";
                 }
                echo "</table> ";
                echo "<p>&nbsp;</p>
                <div class='select-margin'>
                <input type='submit' style='width:15%' name='select' class='btn btn-outline-success' id='confirm' value='Select'/></div></form>";
            
            if (isset($_GET['select']))
            {
                if(!empty($_GET['flexRadioDefault1'])){
                    $val = $_GET['flexRadioDefault1'];
                    $_SESSION['cage_id'] = $val;
                    echo ($val);
                    echo "<script>window.location = 'view_animals_keeper.php';</script>";
                }
            }     
        }   
            ?>
</body>
</html>