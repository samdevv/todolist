<?php
include 'config.php';
$id=$_GET['id'];
$sql = "UPDATE list  set status='done'WHERE id=$id";
if(mysqli_query($link, $sql)){
    header('Location: ./mylist.php');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?> 
