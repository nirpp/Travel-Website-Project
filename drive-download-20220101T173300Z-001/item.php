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

if(isset($_POST['delete'])){
    $temp = $_GET['id'];
    $sql1 = "DELETE FROM posts WHERE post_id = '$temp';";  
    $result1 = mysqli_query($conn, $sql1);
}

       // $a=$_POST['post_id']; 
if(isset($_POST['submit1']))  
{   
    @$post_id = 21;
    @$rating = $_POST['rating']; 
    @$temp = intval($rating); 
    $sql = "INSERT INTO rating(post_id, rate) VALUES('$post_id', '$temp');";  
            //echo "Your Data Inserted";  
            //mysql_query($sql); 
             
    // Execute the query
    if($conn->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
    }  
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}

if(isset($_POST['submit2']))  
{   
    @$post_id=21;
    $review = $_POST['review'];
    $sql = "INSERT INTO review(post_id, review) VALUES('$post_id', '$review');";  
            //echo "Your Data Inserted";  
            //mysql_query($sql); 
             
    // Execute the query
    if($conn->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
    }  
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}

$sql = "SELECT * FROM posts;";
$result = $conn->query($sql);
if(isset($_POST['edit'])){
    while($row = mysqli_fetch_array($result)){
      if($row['post_id'] == $_POST['id']){
       //if($row['post_id'] == 38){
        session_start();
        $_SESSION['id'] = $row['post_id'];
        $_SESSION['owner_name'] = $row['owner_name'];
        $_SESSION['place_name'] = $row['place_name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['description'] = $row['description'];
        $_SESSION['image'] = "uploadedImages/".$row['image'];
      }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="item.css">
    <title>Item</title>
</head>

<body background="./Images/Travel2.jpg">
    <?php   // LOOP TILL END OF DATA 
            //while($rows=$result->fetch_assoc() &&
            session_start(); 
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
                    <img src="<?php
                            if(isset($_SESSION['owner_name'])) { 
                                echo $_SESSION['image'];
                            } else {
                                echo "ABCD";
                            } 
                        ?>" alt="">
                </div>

                <div class="text">
                    <h3>Location: 
                        <?php
                            echo $rows['location'];
                        ?>
                    </h3>

                    <hr>

                    <h3>Description: 
                        <?php
                            echo $rows['description']; 
                        ?>
                    </h3>

                    <br><hr>

                    <h3>Post By: 
                        <?php
                            echo $rows['owner_name'];
                        ?>
                    </h3>

                    <hr>
                    <div>
                        <form style="display:inline" action="edit.php?id=<?php echo $rows['post_id']?>" method="post"><input type="submit" value="Edit" name="edit" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#33a396;"></form>
                      
                        <form style="display:inline" action="food.php?id=<?php echo $rows['post_id']?>" method="post"><a href="food.php?id=<?php echo $rows['post_id']?>"><input type="submit" id="<?php echo $rows['post_id'];?>" value="Delete" name="delete" class="btn" style="background-color:#f51637;"></a></form>
                    </div> 
                </div>
            </div>
    </section>
    <?php
       }
    }
    ?>

    <section class="item" id="rating">
    <?php
    $post_id=21;
        $ratequery = "SELECT * FROM rating WHERE post_id = '$post_id' "; 
        $rateres =mysqli_query($conn, $ratequery);    
            while($data = mysqli_fetch_assoc($rateres)){
                $rate_db[] = $data;
                $sum_rates[] = $data['rate'];
            }
            if(count($rate_db)){
                $rate_times = count($rate_db);
                $sum_rates = array_sum($sum_rates);
                $rate_value = $sum_rates/$rate_times;
                $rate_bg = (($rate_value)/5)*100;
            }else{
                $rate_times = 0;
                $rate_value = 0;
                $rate_bg = 0;
            }
    ?>

    <h2>Average Rating</h2>
    <div style="margin-top: 10px">
        <div class="result-container">
            <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
            <div class="rate-stars"></div>
        </div>
    </div>                    
    <span class="reviewScore"><?php echo substr($rate_value,0,3); ?></span><span class="reviewCount">(<?php echo $rate_times; ?> reviews)</span>
    

    <br><br><br><br>
    <h2>Give a Rating</h2>
    <form action="item.php" method="post">
        <input type="radio" id="one" name="rating" value="1" required>
        <label for="one" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">1</label>
        <input type="radio" id="two" name="rating" value="2" required>
        <label for="two" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">2</label>
        <input type="radio" id="three" name="rating" value="3" required>
        <label for="three" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">3</label>
        <input type="radio" id="four" name="rating" value="4" required>
        <label for="four" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">4</label>
        <input type="radio" id="five" name="rating" value="5" required>
        <label for="five" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">5</label>
        <input type="submit" name="submit1" value="SUBMIT" id="sub1">
    </form>
    

    <br><br><br>
    <h2>Leave a Review</h2>
    <form action="item.php" method="post">
        <textarea rows=5 cols=35 name="review" required></textarea>
        <input type="submit" name="submit2" value="SUBMIT" id="sub2">
    </form>

</section> 
</body>

</html>