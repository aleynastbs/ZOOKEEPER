<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="login.css">
        
    </head>
    
    <body>
        <nav class="navbar navbar-expand-md">
          <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Zoo</span>
        </div>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav navbar-center">
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php"><strong>LOGIN</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php">REGISTER</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
        include("configure.php");
        session_start();
        ?>
       
       <div class="wrapper fadeInDown">
        <div id="formContent"><p>&nbsp;</p>
            <!-- Icon -->
            <div class="fadeIn first">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/Italian_traffic_signs_-_icona_zoo.svg" id="icon" alt="User Icon" /><p>&nbsp;</p>
            </div>

            <!-- Login Form -->
            <form method="get">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="login" required/>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required/>
            <input type="submit" class="fadeIn fourth" name= "login" value="Log In">
            </form>

            </div>
        </div>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if(isset($_GET['login'])){
                  if(isset($_GET['username']) && isset($_GET['password'])){
                    $username = $_GET['username'];  
                    $sql = "SELECT * FROM User WHERE User.username = '$username'";
                    $user_info = mysqli_query($mysqli,$sql);
                    $user_id = $user_info->fetch_assoc()['user_id'];
                    
                  }
                }
            }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>