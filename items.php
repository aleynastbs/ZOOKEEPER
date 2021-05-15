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
        <title>Zoo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    
    <?php
        $shop_name = $_SESSION["shop_name"];
        $sql = "SELECT *
                FROM Shop S
                WHERE '$shop_name' = S.shop_name";
        $shop_id = mysqli_query($mysqli,$sql);
        $shop_id = $shop_id->fetch_assoc()['shop_id'];
        $visitor_id = $_SESSION['user_id'];
        
        #Get the items
        $sql = "CREATE VIEW items_view AS
                SELECT I.item_id, I.item_name, I.item_stock, I.item_price
                FROM Item I , Sells S
                WHERE '$shop_id' = S.shop_id AND S.item_id = I.item_id";
        mysqli_query($mysqli,$sql);        
        $sql2 = "SELECT * FROM items_view";
        $items = mysqli_query($mysqli,$sql2);
        $item_ids = [];
        $item_prices = [];
        $item_stocks = [];
        $item_names = [];
        
    echo 
    '<body>
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
                        <a class="nav-link" href="group_tour_visitor.php">Group Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><strong>',$shop_name,'</strong></a>
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
        </nav>';
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
                array_push($item_prices, $row["item_price"]);
                array_push($item_stocks, $row["item_stock"]);
                array_push($item_names, $row["item_name"]);
              }
            }
          ?>  
          </table>
          <div class="text-center"><form method = "get">
            <a class="btn btn-outline-success" href="shops.php" role="button">Back to the Shops</a>
            <input class="btn btn-outline-success" type="submit" name = 'buy' value="Buy Items" >
            <input class="btn btn-outline-success" type="submit" name = 'funds' value="See my Funds">
            </form>
          </div>
          <?php
          //SQL updates
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
              $sql = "SELECT total_amount_of_money 
              FROM Visitor
              WHERE '$visitor_id' = Visitor.visitor_id";
              $budget  = mysqli_query($mysqli,$sql)->fetch_assoc()["total_amount_of_money"];
              if(isset($_GET['funds'])){
                echo "<script>
                var budget = $budget;
                alert('Your Total Amount of Money: ' + budget);
                window.location.href='items.php';
                </script>";
              }
              if(isset($_GET['buy'])){
                $total_price = 0;
                $total_amount = 0;
                for($i=0; $i < $count; $i++){
                  $amount = $_GET[$item_ids[$i]];
                  $total_amount += (int)$amount;
                  $total_price += (int)$item_prices[$i] * (int)$amount;  
                }
                if($total_price > $budget ){
                  echo "<script>
                  alert('Your Total Amount of Money is Not Enough');
                  window.location.href='items.php';
                  </script>";
                }
                else{
                  $check = 0;
                  $exceed = "These could not be bought: ";
                  for($i=0; $i < $count; $i++){
                    $amount = $_GET[$item_ids[$i]];
                    if($amount <= $item_stocks[$i]){
                      $sql = "UPDATE Item 
                              SET item_stock = item_stock - $amount
                              WHERE item_id = '$item_ids[$i]'";
                      mysqli_query($mysqli,$sql); 
                      $sql = "UPDATE Visitor
                              SET total_amount_of_money = total_amount_of_money - '$total_price'
                              WHERE '$visitor_id' = Visitor.visitor_id";
                      mysqli_query($mysqli,$sql); 
                      if($amount > 0){
                        $date = date("Y-m-d");
                        $sql2 = "INSERT INTO Buys(item_id, user_id, amount, purchase_date) VALUES ('$item_ids[$i]', '$visitor_id', '$amount', '$date')";
                        mysqli_query($mysqli,$sql2);
                      }
                    }else{
                      $exceed = $exceed . $item_names[$i] . " ";
                      $check = 1;
                    } 
                  }
                  if($total_amount > 0){
                    $remaining = $budget - $total_price;
                    if($check == 1){
                      echo "<script>
                      var remaining = $remaining;
                      var exceed = '$exceed';
                      alert('Transaction is partially successful, Remaining Money: ' + remaining + ', ' + exceed);
                      window.location.href='items.php';
                      </script>";
                    }else{
                      echo "<script>
                      var remaining = $remaining;
                      alert('Transaction is successful, Remaining Money: ' + remaining);
                      window.location.href='items.php';
                      </script>";
                    }
                  }else{
                    echo "<script>
                    alert('You did not select an item');
                    window.location.href='items.php';
                    </script>";
                  }
                }
                
              }
            }
          ?>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
        
    </body>

</html>