<?php include "header.php";
if(isset($_SESSION['name']) && isset($_SESSION['email'])){
    $error = "";
    if(isset($_POST['submit'])){
        if(update("homepage", $_POST, "id='1'",  $_FILES, "../images/"/* Your Table,  Your Data,condation,  $_FILES, imagefolder (Optional)*/)){
            $successMessage = "Data inserted successfully!";
            header("Location: homepage.php?message=" . $successMessage);
            exit();
        }else{
            $successMessage = "Data Not inserted successfully!";
            header("Location: homepage.php?notsuccess=" . $successMessage);
            exit();
        }
    }
?>

<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-12 pb-4">
                    <h2 class="text-warning text-center fw-bold mb-2">Home Page Design</h2>
                    <?php
                    if(isset($_GET['message'])){
                    ?>
                    <div class="alert alert-success"><?php echo $_GET['message'];?></div>
                    <?php
                    }else if(isset($_GET['notsuccess'])){ ?>
                    <div class="alert alert-danger"><?php echo $_GET['notsuccess'];?></div>
                    <?php } ?>
                    <?php 
                        if($home = select("homepage")){
                            foreach($home as $home){
                    ?>
                    <form class="row g-2" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <img class="" src="../images/icons/<?php echo $home['logo']?>" alt="" style="width:100px; display:block;">
                            <label for="inputtitle4" class="form-label">Logo...</label>
                            <input type="file" value="" name="logo" class="form-control" id="inputtitle4" >
                        </div>
                        <div class="col-md-6">
                            <img class="" src="../images/<?php echo $home['icon']?>" alt="" style="width:50px; display:block;">
                            <label for="inputtitle4" class="form-label">Icon...</label>
                            <input type="file" value="" name="icon" class="form-control" id="inputtitle4" >
                        </div>
                        <div class="col-md-6">
                            <img class="shadow" src="../images/<?php echo $home['image1']?>" alt="" style="width:100px; display:block;">
                            <label for="inputtitle4" class="form-label">Image-1...</label>
                            <input type="file" value="" name="image1" class="form-control" id="inputtitle4"  >
                            <small id="emailHelp" class="form-text text-muted">image size is 1920 X 930</small>
                        </div>
                        <div class="col-md-6">
                            <img class="shadow" src="../images/<?php echo $home['image2']?>" alt="" style="width:100px; display:block;">
                            <label for="inputtitle4" class="form-label">Image-2...</label>
                            <input type="file" value="" name="image2" class="form-control" id="inputtitle4"  >
                            <small id="emailHelp" class="form-text text-muted">image size is 1920 X 930</small>
                        </div>
                        <div class="col-md-12">
                            <img class="shadow" src="../images/<?php echo $home['image3']?>" alt="" style="width:100px; display:block;">
                            <label for="inputtitle4" class="form-label">Image-3...</label>
                            <input type="file" value="" name="image3" class="form-control" id="inputtitle4"  >
                            <small id="emailHelp" class="form-text text-muted">image size is 1920 X 930</small>

                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Heading-1</label>
                            <input type="text" value="<?php echo $home['heading1'];?>" name="heading1" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Heading-2</label>
                            <input type="text" value="<?php echo $home['heading2'];?>" name="heading2" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Heading-3</label>
                            <input type="text" value="<?php echo $home['heading3'];?>" name="heading3" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Small Heading1</label>
                            <input type="text" value="<?php echo $home['span1'];?>" name="span1" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Small Heading2</label>
                            <input type="text" value="<?php echo $home['span2'];?>" name="span2" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Small Heading3</label>
                            <input type="text" value="<?php echo $home['span3'];?>" name="span3" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block w-100 shadow">Change Home Page</button>
                        </div>
                    </form>
                    <?php }}?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } include "footer.php";?>
