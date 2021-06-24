<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){

 $errors = array();


 $file_name = $_FILES['fileToUpload']['name'];
 $file_size = $_FILES['fileToUpload']['size'];
 $file_tmp = $_FILES['fileToUpload']['tmp_name'];
 $file_type = $_FILES['fileToUpload']['type'];
 $exploded = explode('.', $file_name);
 $file_ext = end($exploded);


//  $file_ext = end(explode('.',$file_name));



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


if(empty($errors)==true){
    move_uploaded_file($file_tmp,$target);
}else{
    print_r($errors);
    die();
}

}


session_start();



$title=mysqli_real_escape_string($connection, $_POST['post_title']);
$description=mysqli_real_escape_string($connection, $_POST['postdesc']);
$category=mysqli_real_escape_string($connection, $_POST['category']);
$date=date("Y-m-d h:i:s"); 
// Problem was here check your code
$author=$_SESSION['user_id'];



$sql= "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date}','{$author}','{$new_name}');";
// Problem was here. 
// Write '{$author}','{$new_name}'

$sql .= "UPDATE category SET post= post + 1 WHERE category_id={$category}";

if(mysqli_multi_query($connection,$sql)){
    header("location: post.php");
}else{
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}

?>