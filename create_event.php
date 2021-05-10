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
    <?php
        include('configure.php');
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if(isset($_GET['gt'])){
                $event_name = $_GET['name_gt'];
                $max_cap = $_GET['max_cap_gt'];
                $date = $_GET['date_gt'];
                $s_time = $_GET['s_time_gt'];
                $e_time = $_GET['e_time_gt'];
                $desc = $_GET['desc_gt'];
                $sql="INSERT INTO Event (event_name, description, max_capacity, date, start_at, end_at)
                            VALUES ('$event_name', '$desc', '$max_cap', '$date', '$s_time' , '$e_time')";
                mysqli_query($mysqli,$sql);
                $id = mysqli_insert_id($mysqli);
                $sql2="INSERT INTO Group_Tour (group_tour_id) VALUES ($id)";
                mysqli_query($mysqli,$sql2);
                $sql3="INSERT INTO Creates_Event (coordinator_id, event_id) VALUES (4, $id)";
                mysqli_query($mysqli,$sql3);
                echo "<script>window.location = 'create_event.php';</script>";
            }

            if(isset($_GET['ep'])){
                $event_name = $_GET['name_ep'];
                $max_cap = $_GET['max_cap_ep'];
                $topic = $_GET['topic_ep'];
                $date = $_GET['date_ep'];
                $s_time = $_GET['s_time_ep'];
                $e_time = $_GET['e_time_ep'];
                $desc = $_GET['desc_ep'];
                $sql="INSERT INTO Event (event_name, description, max_capacity, date, start_at, end_at) VALUES ('$event_name', '$desc', '$max_cap', '$date', '$s_time' , '$e_time')";
                mysqli_query($mysqli,$sql);
                $id = mysqli_insert_id($mysqli);
                $sql2="INSERT INTO Educational_Program (edu_prog_id, topic) VALUES ($id, '$topic')";
                mysqli_query($mysqli,$sql2);
                $sql3="INSERT INTO Creates_Event (coordinator_id, event_id) VALUES (4, $id)";
                mysqli_query($mysqli,$sql3);
                echo "<script>window.location = 'create_event.php';</script>";
            }

            if(isset($_GET['co'])){
                $event_name = $_GET['name_co'];
                $max_cap = $_GET['max_cap_co'];
                $cause = $_GET['cause_co'];
                $goal = $_GET['goal_co'];
                $date = $_GET['date_co'];
                $s_time = $_GET['s_time_co'];
                $e_time = $_GET['e_time_co'];
                $desc = $_GET['desc_co'];
                $sql="INSERT INTO Event (event_name, description, max_capacity, date, start_at, end_at) VALUES ('$event_name', '$desc', '$max_cap', '$date', '$s_time' , '$e_time')";
                mysqli_query($mysqli,$sql);
                $id = mysqli_insert_id($mysqli);
                $sql2="INSERT INTO Conservation_Organization (con_org_id, goal_amount, cause) VALUES ($id, '$goal', '$cause')";
                mysqli_query($mysqli,$sql2);
                $sql3="INSERT INTO Creates_Event (coordinator_id, event_id) VALUES (4, $id)";
                mysqli_query($mysqli,$sql3);
                echo "<script>window.location = 'create_event.php';</script>";
            }
        }
    ?>
        <script type='text/javascript'>
        function show_form(id){document.getElementById(id).style.display='block';}
        function hide_form(id){document.getElementById(id).style.display='none';}</script>
        
        
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
                        <a class="nav-link" href="events_coordinator.php"><strong>Events</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cages_coordinator.php">View & Assign Cages</a>
                    </li>
                </ul>
            </div>
        </nav>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div class="row">
            <div class="column">
                <table style="width:60%" class="margin-left-table">
                    <tr>
                        <th>Please pick an event type</th>
                    </tr>
                    <tr>
                    <td><div class="form-check">
                        <input class="form-check-input" type="radio" value="" id="flexRadioDefault1" name="radio" onclick='hide_form("edu_prog");show_form("group_tour");hide_form("con_org")'> 
                        <label class="form-check-label" for="flexRadioDefault1">Group Tour</label></div></td>
                    </tr>
                    <tr>
                        <td><div class="form-check">
                            <input class="form-check-input" type="radio" value="" id="flexCheckDefault2" name="radio" onclick='show_form("edu_prog");hide_form("group_tour");hide_form("con_org")'>
                            <label class="form-check-label" for="flexRadioDefault2">Educational Program</label></div></td>
                    </tr>
                    <tr>
                        <td><div class="form-check">
                            <input class="form-check-input" type="radio" value="" id="flexCheckDefault3" name="radio" onclick='hide_form("edu_prog");hide_form("group_tour");show_form("con_org")'>
                            <label class="form-check-label" for="flexRadioDefault3">Conservation Organization</label></div></td>
                </table>
                <p>&nbsp;</p>
                <div class="margin-left-button">
                    <a href="events_coordinator.php" class="btn btn-outline-success" type="button">Back To Event List</a>
                </div>
            </div>
            <div class="column">
                <div>
                    <div class="testbox">
                        <form method="get" id="group_tour" style="display:none">
                            <div class="item">
                                <label for="name_gt">Event Name<span>*</span></label>
                                <input id="name_gt" type="text" name="name_gt" placeholder="" required/>
                            </div>
                            <div class="item">
                                <div class="name-item">
                                    <div>
                                        <label for="max_cap_gt">Max Capacity<span>*</span></label>
                                        <input id="max_cap_gt" type="text" name="max_cap_gt" placeholder="" required/>
                                    </div>
                                    <div>
                                        <label for="date_gt">Date<span>*</span></label>
                                        <input id="date_gt" type="date" name="date_gt" required/>
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <label for="s_time_gt">Start Time<span>*</span></label>
                                        <input id="s_time_gt" type="time" name="s_time_gt" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <label for="e_time_gt">End Time<span>*</span></label>
                                        <input id="e_time_gt" type="time" name="e_time_gt" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <label for="description_gt">Description</label>
                                <textarea name="desc_gt" rows="3"></textarea>
                            </div>
                            <div class="margin-left-button">
                                <input type="submit" class="btn btn-outline-success" value="Create Event" name="gt"/>
                            </div>
                        </form>
                    </div>
                    <div class="testbox">
                        <form id="edu_prog" style="display:none">
                            <div class="item">
                                <label for="name_ep">Event Name<span>*</span></label>
                                <input id="name_ep" type="text" name="name_ep" placeholder="" required/>
                            </div>
                            <div class="item">
                                <label for="topic_ep">Topic<span>*</span></label>
                                <input id="topic_ep" type="text" name="topic_ep" placeholder="" required/>
                            </div>
                            <div class="item">
                                <div class="name-item">
                                    <div>
                                        <label for="max_cap_ep">Max Capacity<span>*</span></label>
                                        <input id="max_cap_ep" type="text" name="max_cap_ep" placeholder="" required/>
                                    </div>
                                    <div>
                                        <label for="date_ep">Date<span>*</span></label>
                                        <input id="date_ep" type="date" name="date_ep" required/>
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <label for="s_time_ep">Start Time<span>*</span></label>
                                        <input id="s_time_ep" type="time" name="s_time_ep" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <label for="e_time_gt">End Time<span>*</span></label>
                                        <input id="e_time_ep" type="time" name="e_time_ep" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                    <label for="description_ep">Description</label>
                                    <textarea name="desc_ep" rows="3"></textarea>
                            </div>
                            <div class="margin-left-button">
                            <input type="submit" class="btn btn-outline-success" value="Create Event" name="ep"/>
                            </div>
                        </form>
                    </div>
                    <div class="testbox">
                        <form id="con_org" style="display:none">
                            <div class="item">
                                <label for="name_co">Event Name<span>*</span></label>
                                <input id="name_co" type="text" name="name_co" placeholder="" required/>
                            </div>
                            <div class="name-item"><div>
                                <label for="cause_co">Cause<span>*</span></label>
                                <input id="cause_co" type="text" name="cause_co" placeholder="" required/>
                            </div>
                                    <div>
                                        <label for="max_cap_co">Max Capacity<span>*</span></label>
                                        <input id="max_cap_co" type="text" name="max_cap_co" placeholder="" required/>
                                    </div>
                                    <div>
                                        <label for="goal_co">Goal Amount<span>*</span></label>
                                        <input id="goal_co" type="text" name="goal_co" required/>
                                    </div>
                                </div>
                                <div class="name-item">
                                    <div>
                                        <label for="date_co">Date<span>*</span></label>
                                        <input id="date_co" type="date" name="date_co" required/>
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <label for="s_time_co">Start Time<span>*</span></label>
                                        <input id="s_time_co" type="time" name="s_time_co" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <label for="e_time_co">End Time<span>*</span></label>
                                        <input id="e_time_co" type="time" name="e_time_co" required/>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            <div class="item">
                                    <label for="description_co">Description</label>
                                    <textarea name=desc_co rows="3"></textarea>
                            </div>
                            <div class="margin-left-button">
                            <input type="submit" class="btn btn-outline-success" value="Create Event" name="co"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>