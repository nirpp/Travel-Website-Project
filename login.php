<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
    
      <title>Login and Registration Form</title>
      <link rel="stylesheet" href="login.css">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
               Login Form
            </div>
            <div class="title signup">
               Signup Form
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Login</label>
               <label for="signup" class="slide signup">Signup</label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
               <form action="#" class="login">
                  <div class="field">
                     <input type="text" placeholder="Email Address" name="username">
                  </div>
                  <div class="field">
                     <input type="password" placeholder="Password" name="password">
                  </div>
                  <div class="pass-link">
                     <a href="#">Forgot password?</a>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Login">
                  </div>
                 
                  <div class="signup-link">
                     Not a member? <a href="">Signup now</a>
                  </div>
               </form>




               <form action="login.php" method="post" class="signup">
                  <div class="field">
                     <input type="text" placeholder="Full Name" name="full_name" required>
                  </div>
                  <div class="field">
                     <input type="text" placeholder="Email Address" name="email" required>
                  </div>
                  <div class="field">
                     <input type="password" placeholder="Password" name="password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Signup">
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });
      </script>
   </body>
</html>
<?php
$user=$_GET['username'];
$pass=$_GET['password'];
$fl=$_GET['full_name'];
$em=$_GET['email'];
$pa=$_GET['password'];
$query="INSERT INTO login VALUES('$user','$pass')";
$query1="INSERT INTO signup VALUES('$fl','$em','$pa')";
$data=mysqli_query($conn,$query);
$data1=mysqli_query($conn,$query1);
if($data)
{
    echo "data inserted into database";

}
else{
    echo "failed ";
}
if($data1)
{
   echo "data inserted into database";

}
else{
   echo "failed ";
}
?>
