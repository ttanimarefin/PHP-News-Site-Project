<?php
include "config.php";

$recv_id=$_REQUEST['id'];

$query="DELETE FROM user WHERE user_id='{$recv_id}' ";
$result=mysqli_query($connection,$query);
if($result){
    header("location: users.php");
}else{
    echo "Can't Delete User. ";
}
mysqli_close($connection);

?>