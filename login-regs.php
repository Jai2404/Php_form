<?php
include("db.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
  $user_name = $_POST['user'];   
  $password =$_POST['pass'] ;
}
if(!empty($user_name) && !empty($password))
{
    $query = "select * from form where user = '$user_name' limit 1";
    $result = mysqli_query($con,$query);


    if($result)
    {
        if($result && mysqli_num_rows($result)>0)
        {
             $user_data = mysqli_fetch_assoc($result);
             if($user_data['pass']==$password)
             {
               header("location:index.php"); 
               die;
             }
        }
    } 
     echo "<script type='text/javascript'>alert('wrong user or password')</script>";
}
else{
    echo "<script type='text/javascript'>alert('wrong user or password')</script>";

}
?>