
<?php
    include 'header.php'; 
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
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
            
            //$sql = "insert into adminlogin (name, email, password) values ('$name', '$email', '$password')";
            //if(insertWithSql(/* insert query */$sql)){
            //    $successMessage = "Data inserted successfully!";
            //    header("Location: addadmin.php?message=" . $successMessage);
            //    exit();
            //}
            if(insert("adminlogin", $_POST /* Your Table,  Your Data, imagefolder (Optional)*/)){
                $successMessage = "Data inserted successfully!";
                header("Location: addadmin.php?message=" . $successMessage);
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
                        <h1>Hello <span class="text-warning"><?php echo $_SESSION['name'];?>!</span> Add New Admin</h1>
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
                            <input type="text" value="<?php if(!empty($name)) {echo $name;}else{ echo ''; } ?>" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" value="<?php if(!empty($email)) {echo $email;}else{ echo ''; } ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" value="<?php if(!empty($password)) {echo $password;}else{ echo ''; } ?>" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        </br>
                        <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        if(isset($_GET['search'])){
                            $search = $_GET['search'];
                            $row = select("adminlogin", " name LIKE '%$search%' OR email LIKE '%$search%'");
                            if($row == true){
                            foreach($row as $row){
                        ?>
                        <tr class="bg-info text-white">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><span class="<?php
                            if($row['id'] == $_SESSION['id']){
                                echo "activeAdmin";
                            }else{
                                echo "dactiveAdmin";
                            }
                            ?> status"><i class="fa-solid fa-earth-americas"></i><span></td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');" href="delete.php?delete=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                        </tr>
                        <?php }
                        }else{
                        echo "<div class='text-white bg-warning p-3'>
                            <span class='fw-bold text-danger'>$search!</span> Not Found Please Try Again
                        </div>";
                        }
                        }?>

                        <?php
                            //$row = selectTable(/* Your Table */"adminlogin" /*,  Your id (Optional)*/);
                            $row = select("adminlogin"/* Your Table,  Your Condition (Optional)*/);
                            foreach($row as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><span class="<?php
                            if($row['id'] == $_SESSION['id']){
                                echo "activeAdmin";
                            }else{
                                echo "dactiveAdmin";
                            }
                            ?> status"><i class="fa-solid fa-earth-americas"></i><span></td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');" href="delete.php?delete=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                        </tr>
                        <?php }?>
                    </table>
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
