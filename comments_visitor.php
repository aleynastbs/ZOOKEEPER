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
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                        <a class="nav-link">Home</a>
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
        <form method='post' class='table-form'>
        <h3 style="text-align:left">Add Your Comment</h3>
        <div><textarea rows="3" name='comment_box' id='comment_box'></textarea></div>
        <div class='select-margin'><input type='submit' name='leave_comment' class='btn btn-outline-success' style='width: 15%' id='leave_comment' value='Comment'/></div>
        <div class='select-margin'><a href="group_tour_visitor.php" class="btn btn-outline-success btn"  style='width: 15%' role="button">Back To Event List</a></div>
        <p>&nbsp;</p>
        <h3 style="text-align:left">Comments</h3>
        <table style="width:100%" class="center">
            <tr>
                <th style="text-align:center">Username</th>
                <th style="text-align:center">Content</th>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Likes</th>
                <th style="text-align:center">Dislikes</th>
              </tr>
        <?php
            $vis_id = $_SESSION['user_id'];
            $gt_id = $_SESSION['gt_id'];
            $sql1 = "SELECT * FROM Comments INNER JOIN Comment ON Comments.comment_id = Comment.comment_id
                                            INNER JOIN User ON Comments.user_id = User.user_id 
                                            WHERE Comments.groupTour_id = $gt_id";
            $query = mysqli_query($mysqli,$sql1);
            while($result = $query -> fetch_assoc()) {
                echo "<tr><td style='text-align:center'>" . $result['full_name'] . 
                    "</td><td style='text-align:center'>" . $result['content'] . 
                    "</td><td style='text-align:center'>" . $result['date'] . 
                    "</td><td style='text-align:center'>". $result['like_amount'] . " " .
                    "<button name='like' style='border: none; background-color:#6ab446; border-radius: 50%'><i class='fa fa-thumbs-o-up' style='color: #ffffff'></i></button>" .
                    "</td><td style='text-align:center'>" . $result['dislike_amount'] . " " .
                    "<button name='dislike' style='border: none; background-color: red; border-radius: 50%'><i class='fa fa-thumbs-o-down' style='color: #ffffff'></i></button>" . "</td>";
                echo "</tr>";
            }
            echo "</table></form>";
            if(isset($_POST['leave_comment'])){
                if(!empty($_POST['comment_box'])){
                    $comment = $_POST['comment_box'];
                    $date = date("Y-m-d");
                    $sql2="INSERT INTO Comment (content, like_amount, dislike_amount) VALUES ('$comment', 0, 0)";
                    mysqli_query($mysqli,$sql2);
                    $id = mysqli_insert_id($mysqli);
                    $sql3="INSERT INTO Comments (comment_id, user_id, groupTour_id, date) VALUES ($id, $vis_id, $gt_id, '$date')";
                    mysqli_query($mysqli,$sql3);
                    echo "<script>window.location = 'comments_visitor.php';</script>";
                }
            }


        ?>
        </body>
        <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>
</html>