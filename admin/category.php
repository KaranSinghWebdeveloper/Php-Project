
<?php
    include 'header.php'; 
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    $error = "";
    if(isset($_POST['submit'])){
        $category = $_POST['category'];
        $status = $_POST['status'];
        if($_POST['category'] == ""){
            $error = "Category Field Is Required";
        }elseif($_POST['status'] == ""){
            $error = "Status Field Is Required";
        }else{
            
            //$sql = "insert into adminlogin (name, email, password) values ('$name', '$email', '$password')";
            //if(insertWithSql(/* insert query */$sql)){
            //    $successMessage = "Data inserted successfully!";
            //    header("Location: addadmin.php?message=" . $successMessage);
            //    exit();
            //}
            if(insert("category", $_POST /* Your Table,  Your Data, imagefolder (Optional)*/)){
                $successMessage = "Data inserted successfully!";
                header("Location: category.php?message=" . $successMessage);
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
                        <h1 class="text-center">Add <span class="text-warning">Category</span></h1>
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
                            <label for="category">Category</label>
                            <input type="text" value="<?php if(!empty($category)) {echo $category;}else{ echo ''; } ?>" name="category" class="form-control" id="category" placeholder="Category">
                        </div>
                        <div class="form-group">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Status">
                                <option selected>Status</option>
                                <option value="1">Show</option>
                                <option value="2">Draft</option>
                            </select>
                        </div><br>
                        <button type="submit" name="submit"  class="btn btn-primary d-block w-100 shadow">Submit</button>
                    </form>
                </div>
                <h1 class="text-center">My <span class="text-warning">Category</span></h1>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        if(isset($_GET['search'])){
                            $search = $_GET['search'];
                            $row = select("category", " category LIKE '%$search%'");
                            if($row == true){
                            foreach($row as $row){
                        ?>
                        <tr class="bg-info text-white">
                            <td><?php echo $row['category_id'] ?></td>
                            <td><?php echo $row['category'] ?></td>
                            <td><?php
                            if($row['status'] == 1){ ?>
                            <a href="status.php?categorystatus=<?php echo $row['category_id'] ?>">
                                <i class="fa-solid fa-star text-danger status"></i>
                            </a>    
                            <?php }else{ ?>
                            <a href="status.php?categorystatus=<?php echo $row['category_id'] ?>">
                                <i class="fa-solid fa-star text-danger status opacity-50"></i>
                            </a>    
                            <?php } ?>
                            </td>
                            <td>
                                <a href="update.php?category=<?php echo $row['category_id'] ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                            </td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');" href="delete.php?delete=<?php echo $row['category_id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
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
                            $row = select("category"/* Your Table,  Your Condition (Optional)*/);
                            foreach($row as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['category_id'] ?></td>
                            <td><?php echo $row['category'] ?></td>
                            <td><?php
                            if($row['status'] == 1){ ?>
                            <a href="status.php?categorystatus=<?php echo $row['category_id'] ?>">
                                <i class="fa-solid fa-star text-danger status"></i>
                            </a>    
                            <?php }else{ ?>
                            <a href="status.php?categorystatus=<?php echo $row['category_id'] ?>">
                                <i class="fa-solid fa-star text-danger status opacity-50"></i>
                            </a>    
                            <?php } ?>
                            </td>
                            <td>
                                <a href="update.php?category=<?php echo $row['category_id'] ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a>
                            </td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');" href="delete.php?categorydelete=<?php echo $row['category_id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
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
