<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">


<?php 
    
    include "admin/config.php";
    
    
    #pagination
    $limit=7;
    if(isset($_GET['page'])){
    $page_number=$_GET['page'];
    }else{
    $page_number=1;
    }
    
    $offset=($page_number-1) * $limit;

    // var_dump($_SESSION['user_role']);

    
    
    $query="SELECT post.post_id,post.post_img, post.title,post.category, post.description, post.post_date, category.category_name,user.username FROM post 
    LEFT JOIN category ON post.category = category.category_id 
    LEFT JOIN user ON post.author = user.user_id
    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
   
    
      
     #data show and pagination
     $result= mysqli_query($connection,$query) or die("die");
    //  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
    $count=mysqli_num_rows($result);
    if($count>0){
        while($row=mysqli_fetch_assoc($result)){

?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                              <?php echo substr($row['description'],0,60)."..."?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php }
        }else{
            echo "No Post Here";
        }



#-----------------------------------pagination---------
  
  $query2="SELECT * FROM post"; 
  $result2=mysqli_query($connection,$query2)  or die("Failed");
  if(mysqli_num_rows($result2)) {
      $total_records=mysqli_num_rows($result2);
      $total_page=ceil($total_records/$limit);

      echo "<ul class='pagination admin-pagination'>";

      if($page_number>1){
        echo '<li><a href="index.php?page='.($page_number-1).'">prev</a></li>';
      }
      
      for($i=1; $i<=$total_page; $i++){

        if($i==$page_number){
            $active="active";
        }else{
            $active="";
        }

        echo '<li class='.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';

      }

      if($total_page>$page_number){
        echo '<li><a href="index.php?page='.($page_number+1).'">Next</a></li>';
      }
    echo "</ul>";
  }  



?>                   
                    



                <!-- </div>
                        <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>
                    </div> -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
