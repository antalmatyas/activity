<?php 
    include "functions.php";
    include "connect.php";
    
    if(isset($_POST['additem'])){
        $addcat_id = $_POST['category'];
        $date = $_POST['date'];
        $query = "INSERT INTO act (cat_id, act_date) VALUES ($addcat_id, '{$date}');";
        $insert = mysqli_query($connection, $query);
        if(!$insert){
            die("Insertion failed: " . mysqli_error($connection));
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Activity DB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Ubuntu+Mono" />
</head>
<body>
    <a href="categories.php" style="color:lightgreen">Categories</a>
    <hr>
    <form action='' method='post'>
        Add new activity: 
        <select name="category">
        <?php 
            $cat_query = "SELECT * FROM categories";
            $categories = mysqli_query($connection, $cat_query);
            while($row = mysqli_fetch_assoc($categories)){
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                echo "<option value='$cat_id'>$cat_name</option>";
            }  
        ?>
        </select>
        <input type='date' value="<?php echo $today; ?>" name="date">
        <input type="submit" name="additem" value="ADD">
    </form>
    <hr>
    <div>
    <form action='index.php' method='post'>
    Filter by date: 
    <input type='date' name=getdate>
    <input type='submit' name='filterdate' value="Filter">
    </form>
    <hr>
    <button onclick="window.location.href='index.php'">RESET</button>
    <hr>
    <table>
    <tr>
    <th>Date</th>
    <th>Activity</th>
    </tr>
    <?php
        if(isset($_GET['date'])){
            getFilterDate();
        }
        else if(isset($_GET['act'])){
            getFilterAct();
        }
        else if(isset($_POST['filterdate'])){
            postFilterDate();
        }
        else{
            getBasic();
        }
        
    ?>
    </table>
    </div>
    <hr>
    <div>
        <?php
            getLevels();
        ?>
    </div>
</body>
</html>