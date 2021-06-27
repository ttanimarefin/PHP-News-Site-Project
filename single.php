<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">



<?php 
    
    include "admin/config.php";

    $post_id=$_REQUEST['id'];
    
    $query="SELECT post.post_id,post.post_img,post.author, post.title,post.category, post.description, post.post_date, category.category_name,user.username FROM post 
    LEFT JOIN category ON post.category = category.category_id 
    LEFT JOIN user ON post.author = user.user_id 
    WHERE post.post_id={$post_id}";
   
    
      
    
     $result= mysqli_query($connection,$query) or die("die");
    //  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
    $count=mysqli_num_rows($result);
    if($count>0){
        while($row=mysqli_fetch_assoc($result)){

?>





                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                   <a href="category.php?cid=<?php echo $row["category_id"]?>"> <?php echo $row['category_name']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?author_id=<?php echo $row['author']?>'><?php echo $row['username']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']?>" alt=""/>
                            <p class="description">
                            <?php echo $row['description']?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
<?php }
 }else{
    echo "No Post Here";
    }
?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
