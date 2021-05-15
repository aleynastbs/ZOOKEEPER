<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Zoo Sample Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="register.css">
        
    </head>
    
    <body>
        <nav class="navbar navbar-expand-md">
          <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Zoo</span>
        </div>
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav navbar-center">
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="conservation_visitor.php"><strong>REGISTER</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        include("configure.php");
        session_start();
        if(isset($_POST['submit'])){
            $username = $_POST['uname'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $birthday = $_POST['date'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if(strcmp($password, $cpassword) !== 0){
                echo "<script>
                alert('Passwords do not match!');
                </script>";
            }
            else{
                $sql="SELECT EXISTS (SELECT username FROM User WHERE username = '$username)";
                $result = mysqli_query($mysqli,$sql);
                $sql2="SELECT EXISTS (SELECT email FROM User WHERE email = '$email)";
                $result2 = mysqli_query($mysqli,$sql2);

               
                if($result) #doesnt work???
                    echo "<script>
                    alert('Username taken.');
                    </script>";
                }
                else if($result2){ #doesnt work???
                    echo "<script>
                    alert('Email has already been used for registiration.');
                    </script>";
                }
                else{
                    $sql3="INSERT INTO User (username, email, full_name, address, bio, birth_date, password) 
                            VALUES ('$username', '$email', '$name', '$address', '', '$birthday', '$password')";
                    mysqli_query($mysqli,$sql3);
                    $id = mysqli_insert_id($mysqli);
                    $date2 = date("Y-m-d");
                    $sql4="INSERT INTO Visitor (visitor_id, last_visit, total_amount_of_money) VALUES ($id, '$date2', 500)";
                    mysqli_query($mysqli,$sql4);
                    echo "<script>window.location = 'login.php';</script>";
                }
            }
        }
        ?>
       
       <div class="col-md-4 col-md-offset-4" id="login">
						<section id="inner-wrapper" class="login">
							<article>
								<form method='post'>
									<div class="form-group">
                                        <label for="lname">Name<span style="color: red">*</span></label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"> </i></span>
											<input type="text" name="name" class="form-control" placeholder="Name" required/>
										</div>
									</div>
                                    <div class="form-group">
                                    <div class="input-group">
                                    <label for="luname">Username<span style="color: red">*</span><span style="color: white">**********************</span></label>
                                    <label for="ldate">Birthday<span style="color: red">*</span></label>
                                    </div>
										<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"> </i></span>
											<input type="text" name="uname" class="form-control" placeholder="Username" required/>
                                            <p>&nbsp;</p>
											<span class="input-group-addon"><i class="fa fa-date"> </i></span>
											<input type="date" name="date" class="form-control" placeholder="Birthday" required/>
										</div>
									</div>
									<div class="form-group">
                                    <label for="lmail">E-Mail<span style="color: red">*</span></label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
											<input type="email" name="email" class="form-control" placeholder="Email Address" required/>
										</div>
									</div>
									<div class="form-group">   
                                        <label for="lpassword">Password<span style="color: red">*</span><span style="color: white">**********************</span></label>
                                        <label for="lcpassword">Confirm Password<span style="color: red">*</span></label>
										<div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"> </i></span>
											<input type="password" name="password" class="form-control" placeholder="Password" required/>
                                            <p>&nbsp;</p>
											<span class="input-group-addon"><i class="fa fa-key"> </i></span>
											<input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required/>
										</div>
									</div>
                                    <div class="form-group">
                                        <label for="laddress">Address<span style="color: red">*</span></label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"> </i></span>
											<input type="text" name="address" class="form-control" placeholder="Address" required/>
										</div>
									</div>
									  <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
								</form>
							</article>
						</section></div>
    </body>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>
</html>