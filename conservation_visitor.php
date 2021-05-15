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
                        <a class="nav-link" href="conservation_visitor.php"><strong>Conservation Organizations</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="group_tour_visitor.php">Group Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shops.html">Shops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Animals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="membership.php">Membership</a>
                </ul>
            </div>
        </nav>
        <div class='headerCustom'>
            <h3 style="text-align:center">Conservation Organizations</h3>
        </div>
        <form method='post' class='table-form'>
        <table style="width:45%" class="center">
            <tr>
                <th style="text-align:center">Name</th>
                <th style="text-align:center">Cause</th>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Goal</th>
                <th style="text-align:center">Collected</th>
                <td></td>
              </tr>
        <?php
            include('configure.php');
            session_start();
            $vis_id = 1; #change this later
            if(isset($_POST['donate'])){
                if(!empty($_POST['flexRadioDefault1'])){
                    $con_id = $_POST['flexRadioDefault1'];
                    $donation = $_POST['donation_amount'];
                    $sql = "UPDATE conservation_organization SET collected_amount=collected_amount + $donation WHERE con_org_id=$con_id;";
                    mysqli_query($mysqli, $sql);
                    $sql = "UPDATE visitor SET total_amount_of_money=total_amount_of_money - $donation WHERE visitor_id=$vis_id;";
                    mysqli_query($mysqli, $sql);
                    unset($_POST['donate']);
                    $_SESSION['donation_amt'] = $donation;
                    $sql1 = "SELECT * FROM conservation_organization INNER JOIN event ON conservation_organization.con_org_id = event.event_id";
                    $query = mysqli_query($mysqli,$sql1);
                    while($result = $query -> fetch_assoc()) {
                        if($result['event_id'] == $con_id){
                            $_SESSION['donation_target'] = $result['event_name'];
                            break;
                        }
                    } 
                }
            }
            $sql = "SELECT * FROM visitor WHERE visitor_id = $vis_id";
            $query = mysqli_query($mysqli, $sql);
            $result = $query -> fetch_assoc();
            $max_donation = $result['total_amount_of_money'];
            $sql1 = "SELECT * FROM conservation_organization INNER JOIN event ON conservation_organization.con_org_id = event.event_id";
            $query = mysqli_query($mysqli,$sql1);
            while($result = $query -> fetch_assoc()) {
                echo "<tr><td style='text-align:center'>" . $result['event_name'] . 
                    "</td><td style='text-align:center'>" . $result['cause'] .
                    "</td><td style='text-align:center'>" . $result['description'] . 
                    "</td><td style='text-align:center'>$" . $result['goal_amount'] . 
                    "</td><td style='text-align:center'>$" . $result['collected_amount'] ."</td>";
                echo "<th style='text-align:center' scope='row'>";
                echo '<input class="form-check-input" type="radio" value="', $result["event_id"] , '" name="flexRadioDefault1"/></td>'; 
                echo "</tr>";
            }
            echo "</table>";
            echo "
            <p>&nbsp;</p>
            <p>&nbsp;</p>";
            if(isset($_SESSION['donation_amt'])){
                echo"<div style='text-align: center'>Donated $" . $_SESSION['donation_amt'] . " to " . $_SESSION['donation_target'] . "</div>";
                echo "
                <p>&nbsp;</p>";
                unset($_SESSION['donation_amt']);
                unset($_SESSION['donation_target']);
            }
            echo"<div style='text-align: center'>Remaining Money: $" . $max_donation . "</div>";
            echo "
                <p>&nbsp;</p>
                <div class=select-margin><input type='number' name='donation_amount' style='width: 15%' value='Donation Amount' min='1' max='$max_donation'/></div>
                <div class=select-margin><input type='submit' name='donate' class='btn btn-outline-success' style='width: 15%' id='donate' value='Donate'/></div>
            </form>";
        ?>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>    
    </body>
</html>