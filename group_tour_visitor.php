<!DOCTYPE html>
<html lang="en">
<?php
        include("configure.php");
        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === FALSE){
            header("location: login.php");
        } else if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_type'])){
            header("location: login.php");
        } else if($_SESSION['user_type'] != "visitor"){
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
                        <a class="nav-link" href="visitor_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php">Conservation Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="group_tour_visitor.php"><strong>Group Tours</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shops.php">Shops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Animals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="membership.php">Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class='headerCustom'>
            <h3 style="text-align:center">Group Tours</h3>
        </div>
        <form method='post' class='table-form'>
        <table style="width:45%" class="center">
            <tr>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Date</th>
                <td></td>
              </tr>
              <?php
                $display = 'block';
                $date = date("Y-m-d");
                $vis_id = $_SESSION['user_id']; #change this later
                $sql1 = "SELECT * FROM ((Group_Tour INNER JOIN Event ON Group_Tour.group_tour_id = Event.event_id)
                                                INNER JOIN Attends ON Group_Tour.group_tour_id = Attends.group_tour_id) 
                                                WHERE visitor_id = $vis_id";
                $query = mysqli_query($mysqli,$sql1);
                while($result = $query -> fetch_assoc()) {
                    if($result['date'] < $date){
                        $display = 'block';
                    }
                    else{
                        $display = 'none';
                    }
                    echo "<tr><td style='text-align:center'>" . $result['event_name'] . 
                        "</td><td style='text-align:center'>" . $result['description'] . 
                        "</td><td style='text-align:center'>" . $result['date'] . "</td>";
                    echo "<th style='text-align:center' scope='row'>";
                    echo '<input class="form-check-input" type="radio" style="display: ',$display,'" value="', $result["event_id"] , '" name="flexRadioDefault1"/></td>'; 
                    echo "</tr>";
                }
                echo "</table>";
                echo "
                <p>&nbsp;</p>
                <p>&nbsp;</p>";
                echo "
                    <p>&nbsp;</p>
                    <div class=select-margin><input type='submit' name='comment' class='btn btn-outline-success' style='width: 15%' id='comment' value='Leave A Comment'/></div>
                </form>";

                if(isset($_POST['comment'])){
                    if(!empty($_POST['flexRadioDefault1'])){
                        $gt_id = $_POST['flexRadioDefault1'];
                        $_SESSION['gt_id'] = $gt_id;
                        echo "<script>window.location = 'comments_visitor.php';</script>";
                    }
                }
        ?>   
    </body>
</html>