<?php
include "config.php";

$recv_id=$_REQUEST['id'];

$query="DELETE FROM category WHERE category_id='{$recv_id}' ";
$result=mysqli_query($connection,$query);
if($result){
    header("location: category.php");
}else{
    echo "Can't Delete category. ";
}
mysqli_close($connection);

?>