<?php
include('class.php');

$ob=new Project;

error_reporting(0);

if(!empty($_GET['edit'])){
    $sel=$ob->edit($_GET['edit']);
    $id=$_GET['edit'];
    
    $arr=mysqli_fetch_assoc($sel);
}

$email=$_POST["email"];

//error variables
$unameErr = $emailErr = $nameErr = $ageErr = $cityErr = $imageErr = '';

$tmp = $_FILES["image"]["tmp_name"];
$fname = $_FILES["image"]["name"];

// validation
if(isset($_POST['sub'])){
   
    if(empty($_POST['uname'])){
        $unameErr="Username  is required";
      }
      else if (!preg_match("/^[a-zA-Z0-9 ]+$/", $_POST['uname'])) {
        $unameErr = "Only Characters, Numbers and white spaces are allowed.";
    } 

      if(empty($_POST['email'])){
        $emailErr="Email is required";
      }
      else if (!preg_match("/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/",$_POST['email'])) {
        $emailErr = "Invalid Email Address.";
    }

    if(empty($_POST['name'])){
        $nameErr="Name is required";
      }
      else if (!preg_match("/^[a-zA-Z ]+$/", $_POST['name'])) {
        $nameErr = "Only Characters, Numbers and white spaces are allowed.";
    }

      if(empty($_POST['age'])){
        $ageErr="Age is required";
      }

      if(empty($_POST['city'])){
        $cityErr="City is required";
      }

     
      $ext = pathinfo($fname, PATHINFO_EXTENSION);
      $fn =  "$email". "." .$ext;

      if ($nameErr === "" && $emailErr === "" && $unameErr === ""  && $ageErr ==  ""  && $cityErr === "") 
      { 
        if ($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
               
                $msg=$ob->update($id,$_POST['uname'],$_POST['email'],$_POST['name'],$_POST['age'],$_POST['city'],$fn);
                move_uploaded_file($tmp,"uploads/$fn");
            }
            else {
              $imageErr = "Please Select image file png, jpg or jpeg";
            }
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Index</title>
  </head>
  <body>
   
  <!-- Form -->
  
  <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/img3.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">To Do</h3>

            <h5 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Edit Employee</h5>

            <form method="post" enctype="multipart/form-data">
            <div class="px-md-2">

            <div class="container text-success text-center mt-5 ">
           <?php
            if(isset($_POST['sub']) && empty($unameErr) && empty($emailErr) && empty($nameErr) && empty($ageErr) && empty($cityErr) && empty($imageErr)){
            if(!empty($msg)){
                if($msg=="Updated Successful"){
                    header("location:details.php");
                }
                else{
        ?>
        <div class="container alert alert-danger">
            <?php  echo $msg; ?>
        </div>
        <?php
                }
                
            }
          }
            ?>
            </div>

              <div class="form-outline mb-4">
                <input type="text" id="uname" name="uname" value="<?php echo $arr['uname']; ?>" class="form-control" />
                <label class="form-label" for="uname">User Name</label>
                <small id="err" class="form-text text-danger"><?php echo $unameErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="email" name="email"  value="<?php echo $arr['email']; ?>" class="form-control" />
                <label class="form-label" for="email">Email</label>
                <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="name" name="name"  value="<?php echo $arr['name']; ?>" class="form-control" />
                <label class="form-label" for="name">Name</label>
                <small id="err" class="form-text text-danger"><?php echo $nameErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="age" name="age"  value="<?php echo $arr['age']; ?>" class="form-control" />
                <label class="form-label" for="age">Age</label>
                <small id="err" class="form-text text-danger"><?php echo $ageErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="city" name="city"  value="<?php echo $arr['city']; ?>" class="form-control" />
                <label class="form-label" for="city">City</label>
                <small id="err" class="form-text text-danger"><?php echo $cityErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="file" id="image" name="image" class="form-control" />
                <label class="form-label" for="image">Image</label>
                <small id="err" class="form-text text-danger"><?php echo $imageErr; ?></small>
              </div>

              <input type="submit" value="Update" name="sub" id="sub" class="btn btn-success"/>

              </form>

            
             
              
             

            </div>
        </div>
      </div>
    </div>
  </div>
  </section>
  <?php
    include('footer.php')
    ?>
    
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>