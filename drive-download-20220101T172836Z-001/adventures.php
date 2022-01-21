<?php
  // Set connection variables
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "dbms_project";

  // Create a database connection
  $con = mysqli_connect($server, $username, $password, $dbname);

  // Check for connection success
  if(!$con){
    die("Connection to this database failed due to" . mysqli_connect_error());
  }

  $sql = "SELECT * FROM posts;";
  $result = $con->query($sql);

  // Close the database connection
  $con->close();
?>



<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="adventures.css">
      <title>Adventures Category</title>
   </head>
   <body>
      <header>
         <a href="#" class="logo">Tourist's Stop<span>.</span></a>
         <ul class="navigation">
           <li><a href="http://localhost/Project/addAdventures.php">Add a Place to Enjoy +</a></li>
         </ul>
      </header>
      <section class="adventures">
         <div class="title">
           <h2 class="title-text">The <span>ADVENTURES</span> category</h2>
           <h3>Places Which Impress You</h3>
         </div>
        
        <table style="border:5px solid #fabe28; width:100%;">
          <tr style="color:white; font-size:35px">
            <th style="border:3px solid #fabe28;">Post By</th>
            <th style="border:3px solid #fabe28;">Image</th>
            <th style="border:3px solid #fabe28;">Place Name</th>
            <th style="border:3px solid #fabe28;">Location</th>
            <th style="border:3px solid #fabe28;">Description</th>
            <th style="border:3px solid #fabe28;">More</th>
          </tr>
          <!-- PHP CODE TO FETCH DATA FROM ROWS-->
          <?php   // LOOP TILL END OF DATA 
            while($rows=$result->fetch_assoc()){
              if($rows['category']=="Adventure"){
          ?>
          <tr style="color:white;">
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['owner_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><img src="uploadedImages/<?php echo $rows['image'];?>" width="300" height="200"></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['place_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['location'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['description'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><a href="http://localhost/Project/item.php"><input type="submit" value="VIEW RECORD" name="btn" style="font-size:15px; font-weight:500"></a></td>
          </tr>
          <?php
              }
            }
          ?>
        </table>

        <!--
        <div class="content">
          <div class="card">
            <a href="food.php" class="card-links">
            <div class="imgBx">
              <img src="./Images/Pizza.jpg" alt="">
            </div>
            <div class="text">
              <h3>Pizza</h3>
            </div></a>
          </div>
        </div>-->
      </section>
   </body>
</html>