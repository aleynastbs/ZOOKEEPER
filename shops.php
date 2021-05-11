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
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><strong>Shops</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Animals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="membership.php">Membership</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
        include("configure.php");
        session_start();
        #$login = $_SESSION['login_user'];
        #$visitor_id = "SELECT user_id FROM User WHERE username = '$login'";
        #$visitor_id = mysqli_query($mysqli,$visitor_id);
        #$visitor_id = $visitor_id->fetch_assoc()['user_id'];
        $sql = "SELECT shop_name, shop_description, area_name
                FROM Shop NATURAL JOIN Is_In_S NATURAL JOIN Area";
        $shops = mysqli_query($mysqli,$sql);
       
        ?>
        <table class="table table-hover" data-link="row">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Shop Name</th>
                <th scope="col">Area</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <?php
            if (!$shops) {
            echo "0 results";
            }
            else{ 
              while($row = $shops->fetch_assoc()) {
              $link = $row["shop_name"].".php";
              $link = strtolower($link);
              echo 
              '<tbody><tr>
                  <th scope="row"><a href=',$link, ' class="btn btn-outline-success btn-sm" role="button">Go</a></th>
                  <td>', $row["shop_name"], '</td>
                  <td>',$row["area_name"],'</td>
                  <td>',$row["shop_description"],'</td>
                </tr></tbody>';
              }
            }
            ?>
          </table>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>