<!doctype html>
<html lang="en">
  <head>
    <title>Add a patient</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>


    <!-- //php validations -->
    <?php
        session_start();
        if (isset($_SESSION['email'])) {
            $hid = $_SESSION['hid'];
        }
        if (isset($_POST['registerpatient'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $blood_group = $_POST['blood_group'];
            $plasma = $_POST['plasma'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];
            $phone = $_POST['phone'];
            $aadhar = $_POST['aadhar'];
            $covid_report_raw = htmlentities($_POST['covid_report']);
            $covid_report = date('Y-m-d',strtotime($covid_report_raw));
            // $recovered_on_raw = htmlentities($_POST['recovered_on']);
            // $recovered_on = date('Y-m-d',strtotime($recovered_on_raw));
            // $plasma_recieved_raw = htmlentities($_POST['plasma_recieved']);
            // $plasma_recieved = date('Y-m-d',strtotime($plasma_recieved_raw));
            


            if ($repassword!= $password) {
                header("location: patient.php");
                echo "<h3>Passwords should match</h3>";
            }else {
                if ($name == "") {
                    header("location: patient.php");
                    echo "<h3>Enter a name</h3>";

                }else {
                    if ($email == "") {
                        header("location: patient.php");
                        echo "<h3>Enter a email</h3>";
                    
                    }else {
                        include "conn.php";
                        $regQuery = "INSERT INTO users (name , email ,type, gender, age, blood_group, plasma , address , pincode , phone , aadhar , covid_report , hid)
                         VALUES (' $name', '$email', 'patient', '$gender', '$age', '$blood_group', '$plasma' , '$address', '$pincode' , '$phone', '$aadhar', '$covid_report', '$hid')";
                        mysqli_query($conn,$regQuery);
                        header("location:hospitaldashboard.php"); 
                        echo "patient Registered Successfully, Login to proceed.";
                    }   
                }
            }
        }

    ?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <li class="nav-item navbar-brand">
                <a class="navbar-brand" href="#">Patient Registration for Hospital ID : <?php echo $hid; 
                ?></a>
            </li>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="hospitaldashboard.php">Dashboard</a>
                </li>
            </ul>
            <!-- <li class="navbar-nav ml-auto">
                
                <a class="nav-link" href="logout.php">
                    <span class="material-icons">login</span>    
                    
                </a>
            </li> -->
                
    </nav>
      <div class="container-fluid bg-dark">
      <div class="container mt-5 p-5 my-5 bg-dark border">
      <div class="row justify-content-center">
      <div class="col-md-8">
      <div class="card">
      <div class="card-header"><b>Add a Patient</b></div>


          <form action="patient.php" method="post">
              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Name:</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="name" placeholder="Enter Patient Name">
              </div></div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Email:</label>
                <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Enter Email">
              </div></div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Gender</label>
                <br>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="male">Male
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="female">Female
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="other">Other
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Age</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="age" placeholder="Enter age">
              </div></div>

              <!-- <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Blood Group</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="blood_group" placeholder="Enter blood group row">
              </div></div> -->

              <div class="form-group row">
              <label for="" class="col-md-4 col-form-label text-md-right">Blood Group</label>
              <div class="col-md-6">
              <select class="form-control" id="" name="blood_group">
                <option value="+A">+A</option>
                <option value="+B">+B</option>
                <option value="+AB">+AB</option>
                <option value="+O">+O</option>
                <option value="-A">-A</option>
                <option value="-B">-B</option>
                <option value="-AB">-AB</option>
                <option value="-O">-O</option>
              </select></div>   
              </div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Plasma</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="plasma" placeholder="Eg: 10ml">
              </div></div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Address:</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="address" placeholder="Enter address">
              </div></div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">pincode</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="pincode" placeholder="Enter pincode">
              </div></div>
              
              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="phone" placeholder="phone no.">
              </div></div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">Aadhar</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="aadhar" placeholder="Enter aadhar card">
              </div></div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">covid report date</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="covid_report" placeholder="Enter date">
              </div></div>

              <!-- <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">plasma_recieved date</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="plasma_recieved" placeholder="Enter date">
              </div></div>

              <div class="form-group row">
                <label for=""class="col-md-4 col-form-label text-md-right">recovered_on date</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="recovered_on" placeholder="Enter date">
              </div></div> -->

              


              <!--  -->
              <div class="col-md-6 offset-md-4">
              <button type="submit" name="registerpatient" value="Register" class="btn btn-success">Register</button>
              </div>
          </form>
          <!-- <a href="plasmabankLogin.php">
                  <button class="btn btn-primary">LogIn</button>
          </a> -->
        </div>
      </div>
    </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>