<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ZOOKEEPER</title>
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
                        <a class="nav-link"><strong>Home</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php">Conservation Organizations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="group_tour_visitor.php">Group Tours</a>
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
        $username = $_SESSION['username'];
        
        echo
        '<div class="headerCustom">
                <h1>Welcome, ', $username,'</h1>
        </div>'

        ?>
        <p class="aligncenter">
        <center><img src="https://image.flaticon.com/icons/png/512/2093/2093797.png" alt="centered image" class="center" id="icon" /></center>
        </p>
        
       
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>