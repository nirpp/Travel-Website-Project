<?php
$insert = false;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);   

if(!$conn){
    die("Connection to this database failed due to" . mysqli_connect_error());
}

$sql = "SELECT * FROM posts;";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="record.css">
    <title>Record</title>
</head>

<body background="./Images/Visit7.jpg">
    <?php  
        $temp = $_GET['id'];
        while($rows = mysqli_fetch_array($result)){
            if($rows['post_id'] == $temp){
    ?>
    <section class="item" id="item">
        <div class="content">
            <div class="card">
                <div class="title">
                    <h2 class="title-text">
                        <?php 
                            echo $rows['place_name'];
                        ?>
                    </h2>
                </div>

                <div class="imgBx">
                    <img src="uploadedImages/<?php echo $rows['image'];?>" width="700" height="330">
                </div>

                <div class="text">
                    <h3>Location: <?php echo $rows['location'];?></h3><br><hr>
                    <h3>Description: <?php echo $rows['description'];?></h3><br><br><hr>
                    <h3>Post By: <?php echo $rows['owner_name'];?></h3> 
                </div>
            </div>
    </section>
    <?php
       }
    }
    ?>

</body>

</html>