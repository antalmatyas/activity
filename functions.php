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
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$activity'>$activity</a></td></tr>";
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
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$activity'>$activity</a></td></tr>";
            }
}
function getFilterAct(){
            global $connection;
            $getact = $_GET['act'];
            $query = "SELECT * FROM act WHERE act_value='{$getact}'";
            $acts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($acts)){
                $date = $row['act_date'];
                $catid = $row['cat_id'];
                $activity = getCategory($catid);
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$activity'>$activity</a></td></tr>";
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
                echo "<tr><td><a href='index.php?date=$date'>$date</a></td><td><a href='index.php?act=$activity'>$activity</a></td></tr>";
            }
}
?>