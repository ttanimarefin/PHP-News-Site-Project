<?php
include "config.php";
print_r($_POST['old-image']);

if(empty($_FILES['new-image']['name'])){
    $new_name = $_POST['old-image'];
}else{
    $errors=array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $exploded = explode('.', $file_name);
    $file_ext = end($exploded);

    $extensions= array("jpge" ,"jpg","png");

if(in_array($file_ext,$extensions) === false)
{

    $errors[]="This extension file not allowed,please choose a JPG or PNG file.";

}
if($file_size > 2097152){
    $errors[]= "File size must be 2 MB or Less ";
}
$new_name= time(). "-".basename($file_name);
$target= "upload/".$new_name;
$image_name=$new_name;


if(empty($errors)==true){
    move_uploaded_file($file_tmp,$target);
}else{
    print_r($errors);
    die();
}
}

$query= "UPDATE post SET 
       title= '{$_POST["post_title"]}',description='{$_POST["postdesc"]}', category={$_POST["category"]},post_img='{$image_name}' WHERE post_id={$_POST["post_id"]};";

if($_POST['old_category']!=$_POST["category"]){
    $query.="UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";
    $query.="UPDATE category SET post=post+1 WHERE category_id={$_POST['old_category']};";
}
$result=mysqli_multi_query($connection,$query);
if($result){
    header("location:../admin/post.php");
}else{
    echo "Query Failed";
}












?>