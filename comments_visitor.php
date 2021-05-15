<!DOCTYPE html>
<html lang="en">
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
                        <a class="nav-link" href="#">Home</a>
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
                </ul>
            </div>
        </nav>
        <form method='post' class='table-form'>
        <h3 style="text-align:left">Add Your Comment</h3>
        <div class="item">
                <label for="comment_box"></label>
                <textarea rows="3"></textarea>
        </div>
        <div class='select-margin'><input type='submit' name='leave_comment' class='btn btn-outline-success' style='width: 15%' id='leave_comment' value='Comment'/></div>
        <div class='select-margin'><a href="events_visitor.html" class="btn btn-outline-success btn" role="button">Back To Event List</a></div>
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
            include('configure.php');
            session_start();
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
                            "<button style='border: none; background-color:#6ab446; border-radius: 50%'><i class='fa fa-thumbs-o-up' style='color: #ffffff'></i></button>
                            " .
                    "</td><td style='text-align:center'>" . $result['dislike_amount'] . " " .
                    "<button style='border: none; background-color: red; border-radius: 50%'><i class='fa fa-thumbs-o-down' style='color: #ffffff'></i></button>" . "</td>";
                echo "</tr>";
            }
            echo "</table>
        </form>";
        ?>
        </body>
        <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>
</html>