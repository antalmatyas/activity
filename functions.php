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
            $query = "SELECT * FROM act";
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
            $query = "SELECT * FROM act WHERE act_date='{$getdate}'";
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
            $query = "SELECT * FROM act WHERE cat_id='{$getact}'";
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
            $query = "SELECT * FROM act WHERE act_date='{$getdate}'";
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
                $getCatName = "SELECT * FROM categories WHERE cat_id=$key";
                $category = mysqli_query($connection, $getCatName);
                while($row = mysqli_fetch_assoc($category)){
                    $catname = $row['cat_name'];
                }
                echo "<tr><td>$catname</td><td>$value</td><tr>";
            }
            echo "</table>";
}
?>