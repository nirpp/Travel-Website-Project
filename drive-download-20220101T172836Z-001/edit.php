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

  /*if(isset($_POST['btn'])){
    while($row = mysqli_fetch_array($result)){
      if($row['post_id'] == 38){
       //if($row['post_id'] == 38){
        session_start();
        $_SESSION['owner_name'] = $row['owner_name'];
        $_SESSION['place_name'] = $row['place_name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['description'] = $row['description'];
        $_SESSION['image'] = "uploadedImages/".$row['image'];
      }
    }
  }*/

  if(isset($_POST['update'])){
    $place_name = $_POST['place_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];    
    $folder = "uploadedImages/".$image;

    $temp1 = $_GET['id'];
    $sql1 = "UPDATE posts SET place_name = '$place_name', location = '$location', description = '$description', image = '$image' WHERE post_id = '$temp1';";
    
    mysqli_query($con, $sql1);
    //$result1 = $con->query($sql);
    //alert("Successfully updated!");
  }

  // Close the database connection
  $con->close();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit.css">
    <title>Edit Page</title>
</head>

<body background="./Images/Travel.jpg">
    <div class="card">
        <div>
            <h2>Edit Page</h2>
        </div>
        <hr>
        <?php   // LOOP TILL END OF DATA 
            //while($rows=$result->fetch_assoc() &&
            $temp = $_GET['id'];
            while($rows = mysqli_fetch_array($result)){
               if($rows['post_id'] == $temp){
          ?>
        <div class="form"></div>
        <form action="food.php?id=<?php echo $rows['post_id']?>" method="post" class="edit" enctype="multipart/form-data">
            <div class="field">
                <p>Name: 
                    <input type="text" value="<?php echo $rows['place_name'];?>" name="place_name" required>
                </p>

            </div>
            <div class="field">
                <p>Location: 
                    <input type="text" value="<?php echo $rows['location'];?>" name="location" required>
                </p>
            </div>
            <div class="field">
                <p>Description: 
                    <textarea name="description" rows="3" cols="40" required><?php echo $rows['description'];?></textarea>
                </p>
            </div>
            <div class="field">
                <p>Image: 
                    <input type="file" name="image" id="image" src="<?php echo $rows['image'];?>" required>
                </p>
            </div>
            <div class="btn">
                <input type="submit" value="Save Changes" name="update">
            </div>
        </form>
    </div>
    <?php
}
}
?>
</body>

</html>