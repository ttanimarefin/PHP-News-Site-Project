<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">


        <?php 
          include "config.php";
          $query="SELECT * FROM user ORDER BY user_id DESC ";
          $result=mysqli_query($connection,$query) or die("Query Failed.");
          $count=mysqli_num_rows($result);
          
          if($count>0){

        ?>

               <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

        <?php  
            while($row=mysqli_fetch_assoc($result)){

                $user_id=$row['user_id'];
                $first_name_id=$row['first_name'];
                $last_name_id=$row['last_name'];
                $username_id=$row['username'];
                $password_id=$row['password'];
                $role_id=$row['role'];

            
        
        
        ?>
                          <tr>
                              <td class='id'><?php echo $user_id?></td>
                              <td><?php echo $first_name_id." ".$last_name_id?></td>
                              <td><?php echo $username_id?></td>
                              <td><?php 
                                if($role_id==1){
                                    echo "Admin";
                                }else{
                                    echo "Modarator";
                                }
                              
                              
                              ?>
                               </td>                          
                               <td class='edit'><a href='update-user.php?id=<?php echo $user_id?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?deleted=<?php echo $user_id?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
            <?php } ?>          
                          
                      </tbody>

                      <?php 
                            }
                      ?>
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
