<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ZOOKEEPER</title>
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
                        <a class="nav-link" href="login.php"><strong>LOGIN</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">REGISTER</a>
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
            <form method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="login" required/>
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required/>
            <input type="submit" class="fadeIn fourth" name= "login" value="Log In">
            </form>

            </div>
        </div>

        <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
                echo $_SESSION['logged_in'];
                switch($_SESSION['user_type']){
                    case "coordinator":
                        echo "<script>window.location.href='coordinator_home.php';</script>";
                        break;
                    case "keeper":
                        echo "<script>window.location.href='keeper_home.php';</script>";
                        break;
                    case "visitor":
                        echo "<script>window.location.href='visitor_home.php';</script>";
                        break;
                    default:
                        echo $_SESSION['user_type'];
                        break;
                }
            }

            if(isset($_POST['login'])){
                if(isset($_POST['username']) && isset($_POST['password'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];  
                    $sql = "SELECT * FROM user WHERE user.username = '$username' AND user.password = '$password';";
                    $user_info = mysqli_query($mysqli,$sql);
                    if($user_info->num_rows==1){
                        $user_id = $user_info->fetch_assoc()['user_id'];
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $user_id;
                        $sql = "CALL get_user_type($user_id)";
                        $query = mysqli_query($mysqli, $sql);
                        $result = $query->fetch_assoc();
                        $_SESSION['user_type'] = $result['user_type'];
                        $_SESSION['logged_in'] = true;
                        switch($_SESSION['user_type']){
                            case "coordinator":
                                echo "<script>window.location.href='coordinator_home.php';</script>";
                                break;
                            case "keeper":
                                echo "<script>window.location.href='keeper_home.php';</script>";
                                break;
                            case "visitor":
                                echo "<script>window.location.href='visitor_home.php';</script>";
                                break;
                            default:
                                echo $_SESSION['user_type'];
                                break;
                        }
                    }
                }
            }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    </body>

</html>