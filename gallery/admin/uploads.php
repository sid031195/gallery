<?php include("includes/header.php"); ?>
<?php 
if(!$session->is_sign_in()){
    redirect("login.php");
}
?>
<?php

if(isset($_FILES['file'])){
    $photo=new photo();
    $photo->title=$_POST['title'];
    $photo->set_file($_FILES['file']);
    //$photo->save();
  
    if($photo->save_photo()){
        $the_message="Photo Uploaded Successfully.";
        //echo  "Photo Uploaded Successfully.";

    }else{
        $the_message=join("<br>",$photo->error);
    }
}else{
    $the_message="";
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
                        <h1 class="page-header">
                            Uploads
                            
                        </h1>
                        <div class="row">
                        <div class="col-sm-6">
                            <?php echo $the_message; ?>
                            
                        <form action="uploads.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-roup">
                                <input type="text" name="title" class="form-control">
                            </div><br>
                            <div class="form-roup">
                                <input type="file" name="file" >
                            </div><br>
                            <div class="form-roup">
                                <input type="submit" name="submit" value="submit" >
                            </div>

                        </form>
                        </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="uploads.php"
                                  class="dropzone"
                                  id="my-awesome-dropzone">
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>