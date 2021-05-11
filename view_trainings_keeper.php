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
                    <a class="nav-link" href="view_cages_keeper.php"><strong>View My Cages</strong></a>
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
                echo "<h3 style='text-align:center'>Trainings</h3><form class='table-form' method='get'>
                <table style='width:45%' class='center'>
                <tr>
                <th style='text-align:center'>Training Topic</th>
                <th style='text-align:center'>Training Date</th>
                <td></td>
                </tr>";
                $keeper_id = 2;
                $animal_id = $_SESSION['animal_id'];
                $sql1 = "SELECT training_id, training_description, training_date
                        FROM Schedules
                        WHERE $animal_id = Schedules.animal_id";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    echo "<tr><td style='text-align:center'>" . $result['training_description'] . 
                         "</td><td style='text-align:center'>" . $result['training_date'] ."</td>";
                    echo "<th style='text-align:center' scope='row'>";
                    echo '<input class="form-check-input" type="radio" value="', $result["training_id"] , '" name="flexRadioDefault1"/></td>';
                    echo "</tr>";
                 }
                echo "</table> ";
                echo "<p>&nbsp;</p>";
                echo "<p>&nbsp;</p>
                <div class='update-margin'>
                <input id='date' type='date' style='width:15%' name='date'/><i class='fas fa-calendar-alt'></i>
                <input type='submit' style='width:15%' name='update' class='btn btn-outline-success' id='update' value='Update'/></div>
                <div class='select-margin'>
                <input type='submit' style='width:15%' name='remove' class='btn btn-outline-success' id='remove' value='Remove'/></div></form>";
                
                if (isset($_GET['update']))
                {
                    if(!empty($_GET['flexRadioDefault1'])){
                        if(!empty($_GET['date'])){
                            $date = $_GET['date'];
                            $val = $_GET['flexRadioDefault1'];
                            $sql1 = "UPDATE Schedules SET training_date = '$date' WHERE training_id = $val";
                            mysqli_query($mysqli,$sql1);
                        }
                    }
                    echo "<script>window.location = 'view_trainings_keeper.php';</script>";
                } 
                if (isset($_GET['remove']))
                {
                    if(!empty($_GET['flexRadioDefault1'])){
                        $val = $_GET['flexRadioDefault1'];
                        $sql1 = "DELETE FROM Schedules WHERE $val = Schedules.training_id";
                        mysqli_query($mysqli,$sql1);
                    }
                    echo "<script>window.location = 'view_trainings_keeper.php';</script>";
                }    
                if (isset($_GET['back']))
                {
                    echo "<script>window.location = 'view_animals_keeper.php';</script>";
                } 
                  
        }   
            ?>
            <form class='table-form' method='get'>
            <div class='select-margin'>
            <input type='submit' style='width:15%' name='back' class='btn btn-outline-success' id='back' value='Back To Animals'/></div></form>
</body>
</html>