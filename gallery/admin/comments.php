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
                      <p class="bg-success"><?php echo $message ;?></p>
                        <h1 class="page-header">
                           All Comments
                            
                        </h1>
                       
                       <div class="col-sm-12">
                           <table class="table table-hover">
                               <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>Photo</th>
                                       <th>Author</th>
                                       <th>Comments</th>                     
                                       
                                       
                                   </tr>
                               </thead>
                               <tbody>
                                <?php 
                                $comments=comment::find_all();
                        foreach ( $comments as $comment) {?>
                            
                            <tr>
                                        <td><?php echo $comment->id; ?></td>
                                       <td><img class="admin-comment-thumbnail comment_image" src="http://placehold.it/64x64" alt="img">
                                        <td><?php echo $comment->author; ?>
                                        <div class="action_link">
                                          <a class="delete_link" href="delete_comment.php?id=<?php echo $comment->id;?>">Delete</a>
                                          
                                          
                                        </div>
                                        </td>
 
                                       <td><?php echo $comment->body; ?></td>
                                       
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