<?php
$patient = '';
if (isset($_GET['patientid'])) 
{
  $patientid=$_GET['patientid'];
  include "conn.php";
  $query = "SELECT * FROM users WHERE type ='patient' AND id = '$patientid' ";
  $result= mysqli_query($conn,$query);
  
  if(mysqli_num_rows($result)==1){
      $patient=mysqli_fetch_assoc($result);
  }
  else{
    header("location:hospitaldashboard.php");
  }
}
else{
  header("location:hospitaldashboard.php");
}

            if (isset($_POST['patientupdate'])) {
                $id = $_POST['id'];
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
                $plasma_recieved_raw = htmlentities($_POST['plasma_recieved']);
                $plasma_recieved = date('Y-m-d',strtotime($plasma_recieved_raw));
                if($_POST['recovered_on'] == ""){
                  $recovered_on = "";
                } else {
                  $recovered_on_raw = htmlentities($_POST['recovered_on']);
                  $recovered_on = date('Y-m-d',strtotime($recovered_on_raw));
                }

                include "conn.php";
                try {
                  // $regQuery = "UPDATE users SET name='$_POST[name]', email='$_POST[email]' ,type='$_POST[type]', gender='$_POST[gender]', age='$_POST[age]', blood_group='$_POST[blood_group]', address='$_POST[address]' , phone='$_POST[phone]' , aadhar='$_POST[aadhar]' , covid_report='$_POST[covid_report]' , recovered_on='$_POST[recovered_on]' , plasma_donated='$_POST[plasma_donated]' WHERE id='$_GET['donorid'] ";
                  $regQuery = "UPDATE users SET name='$name', email='$email', age='$age', blood_group='$blood_group',plasma='$plasma' , address='$address', pincode='$pincode', phone='$phone', aadhar='$aadhar',covid_report='$covid_report', plasma_recieved='$plasma_recieved',recovered_on='$recovered_on'  WHERE id='$id'";
                  $query_run = mysqli_query($conn,$regQuery);
                  if($query_run){
                    header("location:hospitaldashboard.php"); 
                    echo "Patient Details Updated";
                  } else {
                    echo "Error" . mysqli_error($conn);
                  }
                } catch(Exception $e) {
                  echo $e;
                }
            }

?>

<html>
<head>
<title>update Patient</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
</head>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <li class="nav-item navbar-brand">
                <a class="navbar-brand" href="#">Patient Details Update</a>
            </li>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="hospitaldashboard.php">Dashboard</a>
                </li>
            </ul>
            <li class="navbar-nav ml-auto">
                <a class="nav-link" href="logout.php">
                    <span class="">Logout</span>    
                    
                </a>
            </li>
                
    </nav>
<body>
    <div class="container">
        <h1>Update form</h1>
    </div>
</body>

<!-- donor update -->
<div class="container mt-5 p-5 my-5 border">
      <div class="row justify-content-center">
      <div class="col-md-8">
      <div class="card">
      <div class="card-header"><b>update</b></div>
      
          <form action="patientupdate.php" method="post">
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">ID:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="id" value="<?php echo $patient['id']; ?>" placeholder="Enter Name">
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="name" value="<?php echo $patient['name']; ?>" placeholder="Enter Name">
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Email:</label>
                <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="<?php echo $patient['email']; ?>" placeholder="Enter Email">
              </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Age</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="age" value="<?php echo $patient['age']; ?>" placeholder="Enter age">
                </div>
              </div>

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
                <label for="" class="col-md-4 col-form-label text-md-right">Address:</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="address" value="<?php echo $patient['address']; ?>" placeholder="Enter address">
              </div>   
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">pincode</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="pincode" value="<?php echo $patient['pincode']; ?>" placeholder="Enter blood group">
              </div>   
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $patient['phone']; ?>" placeholder="phone no.">
              </div>   
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">covid report date</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="covid_report" value="<?php echo $patient['covid_report']; ?>" placeholder="Enter date">
              </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">plasma_recieved</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="plasma_recieved" value="<?php echo $patient['plasma_recieved']; ?>" placeholder="Enter date">
              </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">recovered_on date</label>
                <div class="col-md-6">
                <input type="date" class="form-control" name="recovered_on" value="<?php echo $patient['recovered_on']; ?>" placeholder="Enter date">
              </div>
              </div>


              


              <!--  -->
              <div class="col-md-6 offset-md-4">
              <button type="submit" name="patientupdate" value="patientupdate" class="btn btn-info">Update</button>
              <button type="" name="patientupdate" value="patientupdate" class="btn btn-danger">Delete</button>
              
          </form>
          <!-- <a href="plasmabankLogin.php">
                  <button class="btn btn-primary">LogIn</button>
          </a> -->
          </div>
          </div>
          </div>
      </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>