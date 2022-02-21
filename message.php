<?php

$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'dbm1');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$experience = $_POST['experience'];

$sql = "INSERT INTO message(firstname, lastname, email, experience) VALUES ('$firstname', '$lastname', '$email' , '$experience')";
if(mysqli_query($con, $sql)){
    echo "<h3>data stored in a database successfully.</h3>";
}
else{
    echo "ERROR: Hush! Sorry $sql. " 
        . mysqli_error($con);
}
  
// Close connection
mysqli_close($con);
?>
