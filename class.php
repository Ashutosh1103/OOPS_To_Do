<?php
class Project{
    public $msg;
    private $conn;
    public $sel;
    
    function __construct()
    {
        $this->conn=mysqli_connect("localhost","root","","project_oops");
    }

    function register($uname,$email,$name,$age,$city,$image){
        if(mysqli_query($this->conn,"insert into to_do(uname,email,name,age,city,image) values ('$uname','$email','$name',$age,'$city','$image')")){
            $msg="Registered Successful";
            return $msg;
        }
        else{
            $msg="Not Registered";
            return $msg;
        }
    }

    function details(){
        $sel=mysqli_query($this->conn,"select * from to_do;");
        return $sel;
    }

    function delete($id){
        mysqli_query($this->conn,"delete from to_do where id=$id");

    }

    function edit($id){
        $sel=mysqli_query($this->conn,"select * from to_do where id=$id");
        return $sel;
    }

    function update($id,$uname,$email,$name,$age,$city,$image){
        if(mysqli_query($this->conn,"update to_do set uname='$uname',email='$email',name='$name',age=$age,city='$city',image='$image' where id=$id;")){
            $msg="Updated Successful";
            return $msg;
        }
        else{
            $msg="Not Updated";
            return $msg;
        }
    }
}
?>