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
                        <a class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><strong>Gift Shop</strong></a>
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
        $shop_name = "Gift_Shop";
        $shop_id = 1;
        $visitor_id = 1; //for test purposes
        #$login = $_SESSION['login_user'];
        #$visitor_id = "SELECT user_id FROM User WHERE username = '$login'";
        #$visitor_id = mysqli_query($mysqli,$visitor_id);
        #$visitor_id = $visitor_id->fetch_assoc()['user_id'];
        
        #Get the items
        $sql = "SELECT *
                FROM Item I , Sells S
                WHERE $shop_id = S.shop_id AND S.item_id = I.item_id";
        $items = mysqli_query($mysqli,$sql);
        $item_ids = [];
        ?>

        <table class="table table-hover" data-link="row">
            <thead>
              <tr>
                <th scope="col">Amount</th>
                <th scope="col">Item Name</th>
                <th scope="col">Price($)</th>
                <th scope="col">Stock</th>
              </tr>
            </thead>
            <?php
            if (!$items) {
              echo "0 results";
            }
            else{
              $count = 0;
              while($row = $items->fetch_assoc()) {
              echo 
              '<tbody><tr>
                  <th scope="row" ><form method = "get" ><input type = "input" name ="', $row["item_id"], '" style = "width:50px;"/><form/></th>',
                  '<td>', $row["item_name"], '</td>
                  <td>',$row["item_price"],'</td>
                  <td>',$row["item_stock"],'</td>
                </tr></tbody>';
                $count++;
                array_push($item_ids, $row["item_id"]);
              }
            }
          ?>  
          </table>
          <div class="text-center"><form method = "get">
            <a class="btn btn-outline-success" href="shops.php" role="button">Back to the Shops</a>
            <input class="btn btn-outline-success" type="submit" name = 'buy' value="Buy Items" >
            </form>
          </div>
          <?php
          //SQL updates
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
              if(isset($_GET['buy'])){
                for($i=0; $i < $count; $i++){
                  $amount = $_GET[$item_ids[$i]];
                  $sql = "UPDATE Item 
                          SET item_stock = item_stock - '$amount'
                          WHERE item_id = '$item_ids[$i]'";
                  mysqli_query($mysqli,$sql); 
                  if($amount > 0){
                    $sql2 = "INSERT INTO Buys VALUES ('$item_ids[$i]', '$visitor_id', '$amount')";
                    mysqli_query($mysqli,$sql2);
                  } 
                }
                echo "<script>
                alert('Transaction is successfull');
                window.location.href='gift_shop.php';
                </script>";
              }
            }
          ?>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>