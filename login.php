<?php
include "dbconnect.php";

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die($con->error);
        if(mysqli_num_rows($result) > 0 )
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             header("Location: index.php?login=" . "Đăng nhập thành công!!!");
        }
        else
          echo "Sai tài khoản hoặc mật khẩu!";
   }
}
