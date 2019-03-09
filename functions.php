<?php 
include "connect.php";
function getCategory($catid){
            global $connection;
            $getcat_query = "SELECT * FROM categories WHERE cat_id=$catid";
            $category = mysqli_query($connection, $getcat_query);
            while($row = mysqli_fetch_assoc($category)){
                $cat_name = $row['cat_name'];
            }
            return $cat_name;
}

function getBasic(){
            global $connection;
            $query = "SELECT * FROM act ORDER BY act_date";
            $acts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($acts)){
                $date = $row['act_date'];
                $catid = $row['cat_id'];
                $activity = getCategory($catid);
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$catid'>$activity</a></td></tr>";
            }
}

function postFilterDate(){
            global $connection;
            $getdate = $_POST['getdate'];
            $query = "SELECT * FROM act WHERE act_date='{$getdate}' ORDER BY act_date";
            $acts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($acts)){
                $date = $row['act_date'];
                $catid = $row['cat_id'];
                $activity = getCategory($catid);
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$catid'>$activity</a></td></tr>";
            }
}

function getFilterAct(){
            global $connection;
            $getact = $_GET['act'];
            $query = "SELECT * FROM act WHERE cat_id='{$getact}' ORDER BY act_date";
            $acts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($acts)){
                $date = $row['act_date'];
                $catid = $row['cat_id'];
                $activity = getCategory($catid);
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$catid'>$activity</a></td></tr>";
            }
}

function getFilterDate(){
            global $connection;
            $getdate = $_GET['date'];
            $query = "SELECT * FROM act WHERE act_date='{$getdate}' ORDER BY act_date";
            $acts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($acts)){
                $date = $row['act_date'];
                $catid = $row['cat_id'];
                $activity = getCategory($catid);
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$catid'>$activity</a></td></tr>";
            }
}

function getLevels(){
            global $connection;
            $cat = array();
            $getCatQuery = "SELECT * FROM categories";
            $categories = mysqli_query($connection, $getCatQuery);
            while($row = mysqli_fetch_assoc($categories)){
                $id = $row['cat_id'];
                $cat[$id] = 0;
            }
            $checkActQuery = "SELECT * FROM act";
            $activities = mysqli_query($connection, $checkActQuery);
            while($row = mysqli_fetch_assoc($activities)){
                $rowcat = $row['cat_id'];
                $cat[$rowcat] += 1;
            }
            echo "
            <table>
            <tr>
            <th>Skill</th>
            <th>Level</th>
            </tr>";
            foreach ($cat as $key => $value) {
                $catname = getCategory($key);
                echo "<tr><td><a href='index.php?act=$key'>$catname</a></td><td>$value</td><tr>";
            }
            echo "</table>";
}

function getDayTodo($day){
    global $connection;
    $query = "SELECT * FROM todolist WHERE todo_date='{$day}'";
    $getlist = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($getlist)){
        $todoid = $row['todo_id'];
        $actid = $row['todo_act_id'];
        $custom = $row['todo_custom'];
        $done = $row['todo_done'];
        if($actid == NULL){
            if($done){
                echo "<li style='text-decoration:line-through;'><a href='todolist.php?done=$todoid'>$custom</a></li>";
            }
            else{
                echo "<li><a href='todolist.php?done=$todoid'>$custom</a></li>";
            }
        }
        else{
            $getcat_query = "SELECT * FROM categories WHERE cat_id=$actid";
            $getcat = mysqli_query($connection, $getcat_query);
            if(!$getcat){
                die("Query failed: " . mysqli_error($connection));
            }
            while($one = mysqli_fetch_assoc($getcat)){
                $activity = $one['cat_name'];
            }
            if($done){
                echo "<li style='text-decoration:line-through;'><a href='todolist.php?done=$todoid'>$activity</a></li>";
            }
            else{
                echo "<li><a href='todolist.php?done=$todoid'>$activity</a></li>";
            }
        }
        
    }
}
?>