<?php include "header.php"; 


if($_SESSION['user_role']=='0'){
  header("location: post.php");
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">


            <?php 
          include "config.php";

          $query="SELECT * FROM category ORDER BY category_id DESC "; #data show and pagination
          $result=mysqli_query($connection,$query) or die("Query Failed.");
          
          $count=mysqli_num_rows($result);
          
          if($count>0){

        ?> 

    

                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
    
            <?php 
            $serial_number=1; 
            while($row=mysqli_fetch_assoc($result)){
                ?>
                        <tr>
                            <td class='id'><?php echo $serial_number++?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['post']?></td>
                            
                            <td class='edit'><a href='update-category.php?id=<?php echo  $row['category_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a onclick="return confirm('Are You Sure?')" href='delete-category.php.php?id=<?php echo $row['category_id']?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
             <?php }?>
                        
                    </tbody>
            <?php }?>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
