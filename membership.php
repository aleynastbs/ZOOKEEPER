<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="main.css">
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
                            <a class="nav-link" href="conservation_visitor.php">Conservation Organizations</a>
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
                            <a class="nav-link" href="membership.php"><strong>Membership</strong></a>
                    </ul>
                </div>
            </nav>
        
        <?php
        include("configure.php");
        session_start();
        $visitor_id = 1; //for test purposes
        #$login = $_SESSION['login_user'];
        #$visitor_id = "SELECT user_id FROM User WHERE username = '$login'";
        #$visitor_id = mysqli_query($mysqli,$visitor_id);
        #$visitor_id = $visitor_id->fetch_assoc()['user_id'];

        //check the membership status of the visitor
        $sql = "SELECT *
                FROM Has 
                WHERE '$visitor_id' = Has.user_id";
        $membership = mysqli_query($mysqli,$sql);
        $check = "";
        $row = $membership->fetch_assoc();
        if($row != NULL){
            $check = $row["type"];
            $mem_id = $row["membership_id"];
        }else{
            $check = "";
        }
        ?>

        <div class="list-group">
            <div class="headerCustom">
                <h1>Manage My Membership</h1>
              </div>
              <?php 
              if($check == ""){
                
                echo "<input class='list-group-item list-group-item-action disabled' type='submit' value ='Cancel My Membership'>";
                echo "<form class = 'mem-form' method = 'get'><input class='list-group-item list-group-item-action' name ='gold' type='submit' value='Start a Gold Membership'></form>";
                echo "<form class = 'mem-form' method = 'get'><input class='list-group-item list-group-item-action' name ='silver' type='submit' value='Start a Silver Membership'></form><p>&nbsp;</p>";
              }else{
                echo '<input class="list-group-item list-group-item-action disabled" type="submit" value ="Start a Silver Membership">
                <input class="list-group-item list-group-item-action disabled" type="submit" value="Start a Gold Membership">
                <form class = "mem-form" method = "get"><input class="list-group-item list-group-item-action" name ="cancel" type="submit" value="Cancel My Membership"></form><p>&nbsp;</p>';
              }
              echo '<div class= "funds-margin"><form method = "get"><input class="btn btn-outline-success" type="submit" name = "funds" value="See my Funds"></form></div>';
              if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $sql = "SELECT total_amount_of_money 
                FROM Visitor
                WHERE '$visitor_id' = Visitor.visitor_id";
                $budget  = mysqli_query($mysqli,$sql)->fetch_assoc()["total_amount_of_money"];
                $curr_date = date("Y-m-d");
                $expiration_date = date('Y-m-d', strtotime($curr_date. ' + 1 year')); //curr year + 1 year
                if(isset($_GET['funds'])){
                    echo "<script>
                    var budget = $budget;
                    alert('Your Total Amount of Money: ' + budget);
                    window.location.href='membership.php';
                    </script>";
                }
                if(isset($_GET["gold"])){
                    if($budget > 200){
                        $sql = "INSERT INTO Membership (expiration_date, price) 
                                VALUES ('$expiration_date', 200)";
                        mysqli_query($mysqli,$sql);
                        $last_id = mysqli_insert_id($mysqli);
                        $sql = "INSERT INTO Has VALUES ('$last_id', '$visitor_id', 'gold')";
                        mysqli_query($mysqli,$sql);
                        $sql = "UPDATE Visitor
                                SET total_amount_of_money = total_amount_of_money - 200
                                WHERE '$visitor_id' = Visitor.visitor_id";
                        mysqli_query($mysqli,$sql);
                        echo "<script>
                        var budget = $budget - 100;
                        alert('Your Remaining Money: ' + budget);
                        window.location.href='membership.php';
                        </script>";
                    }
                    else{
                        echo "<script>
                        alert('Your Total Amount of Money is Not Enough');
                        window.location.href='membership.php';
                        </script>";
                    }
                }else if(isset($_GET["silver"])){
                    if($budget > 100){
                        $sql = "INSERT INTO Membership (expiration_date, price) 
                                VALUES ('$expiration_date', 100)";
                        mysqli_query($mysqli,$sql);
                        $last_id = mysqli_insert_id($mysqli);
                        $sql = "INSERT INTO Has VALUES ('$last_id', '$visitor_id', 'silver')";
                        mysqli_query($mysqli,$sql);
                        $sql = "UPDATE Visitor
                                SET total_amount_of_money = total_amount_of_money - 100
                                WHERE '$visitor_id' = Visitor.visitor_id";
                        mysqli_query($mysqli,$sql);
                        echo "<script>
                        var budget = $budget - 100;
                        alert('Your Remaining Money: ' + budget);
                        window.location.href='membership.php';
                        </script>";
                    }
                    else{
                        echo "<script>
                        alert('Your Total Amount of Money is Not Enough');
                        window.location.href='membership.php';
                        </script>";
                    }
                }else if(isset($_GET["cancel"])){
                    echo "a";
                    $sql = "DELETE FROM Has 
                            WHERE membership_id = '$mem_id'";
                    mysqli_query($mysqli,$sql);
                    $sql = "DELETE FROM Membership 
                            WHERE membership_id = '$mem_id'";
                    mysqli_query($mysqli,$sql);
                    echo "<script>
                    var budget = $budget;
                    alert('Your Membership is Cancelled');
                    window.location.href='membership.php';
                    </script>";
                }
            }
            ?>
          </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>