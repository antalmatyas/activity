<?php
    include "connect.php";
    if(isset($_POST['submit'])){
        $new_item = $_POST['item_value'];
        $newitem_query = "INSERT INTO categories (cat_name) VALUES('$new_item')";
        $insert = mysqli_query($connection, $newitem_query);
        if(!$insert){
            die("Insertion failed: ".mysqli_error($connection));
        }
        header("Location:categories.php");
    }

    if(isset($_GET['delete'])){
        $deleteid = $_GET['delete'];
        $delete_query = "DELETE FROM categories WHERE cat_id=$deleteid";
        $delete = mysqli_query($connection, $delete_query);
        if(!$delete_query){
            die("Deletion unsuccessful: ".mysqli_error($connection));
        }
        header("Location:categories.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>dolog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="index.php">Activity</a>
<form action="" method="post">
    <table>
        <tr>
            <th>ITEM</th>
            <th>DEL</th>
        </tr>
        <?php
            $get_items_query = "SELECT * FROM categories";
            $get_items = mysqli_query($connection, $get_items_query);
            if(!$get_items){
                die("Something's not good: " . mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($get_items)){
                $cat_name = $row['cat_name'];
                $cat_id = $row['cat_id'];
                echo("
                <tr>
                    <td>$cat_name</td>
                    <td><a href='categories.php?delete=$cat_id'>DEL</a></td>
                </tr>
                ");
            }
        ?>
        <tr>
        <td><input type="text" name="item_value" autofocus></td>
        <td><input type="submit" name="submit" value="Add"></td>
        </tr>
    </table>
    </form>
<!--Create diary system to store daily activities in connection to each area
    note down every learning activity here -- should be grouped by date..?
 -->
</body>
</html>