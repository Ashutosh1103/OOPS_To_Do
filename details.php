<?php
include('class.php');

$obj=new Project();

$sel=$obj->details();

error_reporting(0);



//delete details 
if(!empty($_GET['del'])){
    $obj->delete($_GET['del']);
   
    header("location:details.php");
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body style="background-color: #8fc4b7;">
    <div class="container">
<table class="mt-5 mb-5 table table-dark text-light table-hover ">
 
<tbody>
<thead>
            <tr>
                <td colspan="9" align="center">
                    <a href="index.php">Add Details</a>
            </td>
            </tr>
            <tr>
                <th>S.No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
                <th>Image</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php
           
            if(mysqli_num_rows($sel)>0){
                $sn=1;
                while($arr=mysqli_fetch_assoc($sel)){
                    ?>
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $arr['uname']; ?></td>
                        <td><?php echo $arr['email']; ?></td>
                        <td><?php echo $arr['name']; ?></td>
                        <td><?php echo $arr['age']; ?></td>
                        <td><?php echo $arr['city']; ?></td>
                        <td><?php $image=$arr['image']; echo "<img style='height:50px;width:50px' src='uploads/$image' >"; ?></td>
                        <td><?php echo $arr['created_at']; ?></td>
                        <td><a href="edit.php?edit=<?php echo $arr['id'];?>">Edit</a> 
                         &nbsp; &nbsp; &nbsp; 
                        <a href="?del=<?php echo $arr['id'];?>">Delete</a></td>

                    </tr>
                    <?php
                    $sn++;
                }
            }
            
            else{
                ?>
                <tr>
                    <td colspan="9" align="center">No Records Found</td>
                </tr>
                <?php
            }
            ?>
           
        </tbody>
            
           
  </tbody>
</table>
</div>
</body>
</html>