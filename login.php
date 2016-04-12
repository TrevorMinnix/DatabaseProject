<?php
$con = mysqli_connect("localhost","root","", "dbproject");

if (mysqli_connect_errno())

{

echo "MySQLi Connection was not established: " . mysqli_connect_error();

}

// checking the user
if(isset($_POST['LOGIN'])){

$user = mysqli_real_escape_string($con,$_POST["username"]);

$pass = mysqli_real_escape_string($con,$_POST["password"]);

$sel_user = "select * from admin where adminLogin='$user' AND adminPass='$pass'";

$run_user = mysqli_query($con, $sel_user);

$check_user = mysqli_num_rows($run_user);

if($check_user>0){

$_SESSION['user']=$user;

echo 'hello';

}

else {

echo 'test';

}

}
?>
