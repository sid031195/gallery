<?php include("includes/header.php"); ?>
<?php 
if(!$session->is_sign_in()){
    redirect("login.php");
}
?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php");?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <?php include("includes/side_nav.php");?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                      
                        <?php
                  if(isset($_SESSION['message'])):?>
                  <div class="alert alert-<?=$_SESSION['msg_type']?>" >
                  <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>
                      
                        <h1 class="page-header">
                           Photos
                            
                        </h1>
                       <div class="col-sm-12">
                           <table class="table table-hover">
                               <thead>
                                   <tr>
                                       <th>Photo</th>
                                       <th>Id</th>
                                       <th>File Name</th>                     
                                       <th>Title</th>
                                       <th>Size</th>
                                       <th>Comments</th>
                                   </tr>
                               </thead>
                               <tbody>
                                <?php 
                                $photos=photo::find_all();
                        foreach ( $photos as $photo) {?>
                            
                            <tr>
                                       <td>
                                        <a href="../photo.php?id=<?php echo $photo->id;?>">
                                        <img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt=""></a>

                                        <div class="pic_link">
                                          <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a>
                                          <a href="edit_photo.php?id=<?php echo $photo->id;?>">Edit</a>
                                          <a href="../photo.php?id=<?php echo $photo->id;?>">View</a>
                                        </div>

                                       </td>
                                       <td><?php echo $photo->id; ?></td>
                                       <td><?php echo $photo->filename; ?></td>
                                       <td><?php echo $photo->title; ?></td>
                                       <td><?php echo $photo->size; ?></td>
                                       <td>
                                       <a href="comment_photo.php?id=<?php echo $photo->id;?>"> <?php 
                                   $comments=comment::find_the_comment($photo->id);
                                   echo count($comments);
                                          ?></a>
                                       </td>
                                   </tr>
                                   
                        <?php } ?>
                        

                               
                               </tbody>
                           </table>
                       </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>