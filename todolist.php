<?php
    include "connect.php";
    include "functions.php";
    if(isset($_POST['submit'])){
        $selected = $_POST['sel_act'];
        $custom = $_POST['custom_act'];
        $date = $_POST['todo_date'];
        if($selected == ""){
            $query = "INSERT INTO todolist (todo_date, todo_custom) ";
            $query .= "VALUES ('{$date}', '{$custom}')";
            $insert = mysqli_query($connection, $query);
            if(!$insert){
                die("Query failed: " . mysqli_error($connection));
            }
        }
        else{
            $query = "INSERT INTO todolist (todo_date, todo_act_id, todo_custom) ";
            $query .= "VALUES ('{$date}', $selected, NULL)";
            $insert = mysqli_query($connection, $query);
            if(!$insert){
                die("Query failed: " . mysqli_error($connection));
            }
        }
    }
    if(isset($_GET['done'])){
        $doneid = $_GET['done'];
        $getdone_query = "SELECT * FROM todolist WHERE todo_id=$doneid";
        $getdone = mysqli_query($connection, $getdone_query);
        while($row = mysqli_fetch_assoc($getdone)){
            $done = $row['todo_done'];
        }
        if($done){
            $updatequery = "UPDATE todolist SET todo_done=0 WHERE todo_id=$doneid";
        }
        else{
            $updatequery = "UPDATE todolist SET todo_done=1 WHERE todo_id=$doneid";
        }
        $update = mysqli_query($connection, $updatequery);
        header("Location:todolist.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Activity - TodoList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="fonts.googleapis.com/css?family=Ubuntu+Mono" />
</head>
<body>
    <?php include_once "header.php"; ?>
    <form action="todolist.php" method="post">
    <select class='input-field' name="sel_act" id="">
    <option value="">Select</option>
    <?php
        global $connection;
        $query = "SELECT * FROM categories";
        $query_result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($query_result)){
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            echo "<option value='$cat_id'>$cat_name</option>";
        }
    ?>
    </select>
    <input class='input-field' type="text" name="custom_act" placeholder="or add custom">
    <input class='input-field' type="date" value=<?php $today = date("Y-m-d"); echo $today; ?> name="todo_date">
    <input class='input-field' type="submit" name="submit" value="ADD">
    </form>
    <hr>
    <table>
    <tr>
    <th>Today</th>
    <th>Tomorrow</th>
    <th>Overmorrow</th>
    </tr>
    <tr>
    <td>
    <ul style="list-style-type:none;">
        <?php
            $today = date("Y-m-d");
            getDayTodo($today);
        ?>
    </ul>
    </td>
    <td>
    <ul style="list-style-type:none;">
        <?php
            $tomorrow = date("Y-m-d", strtotime("+1 day"));
            getDayTodo($tomorrow);
        ?>
    </ul>
    </td>
    <td>
    <ul style="list-style-type:none;">
        <?php
            $overmorrow = date("Y-m-d", strtotime("+2 day"));
            getDayTodo($overmorrow);
        ?>
    </ul>
    </td>
    </tr>
    </table>
</body>
</html>