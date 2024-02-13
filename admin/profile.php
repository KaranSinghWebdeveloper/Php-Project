
<?php
    include 'header.php'; 
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    //$row = adminselectfrom($_SESSION['email']);
    $session = $_SESSION['email'];
    $sql = "select * from adminlogin where email='$session'";
    $row = selectWithSql($sql);
    foreach($row as $row){
        $id = $row['id'];
    }
    $id = $id;
    $error = "";
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($_POST['name'] == ""){
            $error = "Name Field Is Required";
        }elseif($_POST['email'] == ""){
            $error = "Email Field Is Required";
        }elseif($_POST['password'] == ""){
            $error = "Password Required";
        }else{
            // $sql = "update adminlogin set 
            // name='$name', email='$email', password='$password' where id='$uid'";
            // if(updateWithSql($sql)){
            //     $successMessage = "Data Update successfully!";
            //     header("Location: addadmin.php?message=" . $successMessage);
            //     exit();
            // }else{
            //     $notsuccess = "Data Not inserted Something Error";
            //     header("Location: addadmin.php?notsuccess=" . $notsuccess);
            //     exit();
            // }
            if(update("adminlogin", $_POST, "id='$id'"/* Your Table,  Your Data, Your Condition*/)){
                $successMessage = "Profile Update successfully!";
                header("Location: addadmin.php?message=" . $successMessage);
                exit();
            }else{
                $notsuccess = "Profile Not Updated Something Error!";
                header("Location: addadmin.php?notsuccess=" . $notsuccess);
                exit();
            }
        }
    }
?>
<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-12 p-2">
                    <form method="post" action="">
                        <h1>Hello <span class="text-warning"><?php echo $_SESSION['name']?>!</span> Update Your Profile</h1>
                        <?php if(!empty($error)){?>
                        <div class="alert alert-danger"><?php echo $error;?></div>
                        <?php }else{
                        if(isset($_GET['message'])){
                        ?>
                        <div class="alert alert-success"><?php echo $_GET['message'];?></div>
                        <?php
                        }else if(isset($_GET['notsuccess'])){ ?>
                        <div class="alert alert-danger"><?php echo $_GET['notsuccess'];?></div>
                        <?php } }?>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="<?php echo $_SESSION['name']; ?>" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" value="<?php echo $_SESSION['email']; ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" value="" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        </br>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include 'footer.php';
    }else{
        header('Location: adminlogin.php');
        exit;
    }
?>
