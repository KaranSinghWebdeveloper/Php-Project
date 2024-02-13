
<?php
    include 'header.php'; 
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    if(isset($_GET['color'])){
        $id = $_GET['color'];
        if($row = select('color', "color_id='$id'")){
        $update = "Color";
        $name = "color";
        $table = "color";
        foreach($row as $row){
        $value = $row['color'];
        $status = $row['status'];
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['category'])){
        $id = $_GET['category'];
        if($row = select('category', "category_id='$id'")){
        $update = "Category";
        $name = "category";
        $table = "category";
        foreach($row as $row){
        $value = $row['category'];
        $status = $row['status'];
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['subcategory'])){
        $id = $_GET['subcategory'];
        if($row = select('subcategory', "subcategory_id='$id'")){
        $update = "Sub Category";
        $name = "subcategory";
        $table = "subcategory";
        foreach($row as $row){
        $value = $row['subcategory'];
        $status = $row['status'];
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['brand'])){
        $id = $_GET['brand'];
        if($row = select('brand', "brand_id='$id'")){
        $update = "Brand";
        $name = "brand";
        $table = "brand";
        foreach($row as $row){
        $value = $row['brand'];
        $status = $row['status'];
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['post'])){        
        $id = $_GET['post'];
        $sql = "SELECT * FROM post
                LEFT JOIN category ON post.category_id = category.category_id
                LEFT JOIN color ON post.color_id = color.color_id
                LEFT JOIN brand ON post.brand_id = brand.brand_id
                LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id WHERE post.id='$id'";
        if($row = selectWithSql($sql)){
        $update = "Post";
        $name = "newpost";
        $table = "post";
        foreach($row as $row){
        $title = $row['title'];
        $peragraph = $row['peragraph'];
        $color = $row['color'];
        $colorid = $row['color_id'];
        $category = $row['category'];
        $categoryid = $row['category_id'];
        $subcategory = $row['subcategory'];
        $subcategoryid = $row['subcategory_id'];
        $price = $row['price'];
        $brand = $row['brand'];
        $brandid = $row['brand_id'];
        $lessprice = $row['lessprice'];
        $image = $row['image'];
        $qty = $row['qty'];
        $status = $row['status'];
        $condition = "id";
        $folder = "../images/";
        }
        }
    }else{
        echo "<script>history.back();</script>";
        exit();
    }

    $error = "";
    if(isset($_POST['submit'])){ 
        if(update($table, $_POST, "$condition='$id'", $_FILES, $folder  /* Your Table,  Your Data, Condation (Optional)*/)){
            $successMessage = "Data Update successfully!";
            header("Location: $name.php?message=" . $successMessage);
            exit();
        }
    }
if($table == "post"){
?>
<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-12 pb-4">
                    <h2 class="text-warning text-center fw-bold mb-2">Update Post</h2>
                    <form class="row g-2" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="inputtitle4" class="form-label">Title</label>
                            <input type="text" value="<?php echo $row['title'];?>" name="title" class="form-control" id="inputtitle4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Peragraph</label>
                            <input type="text" value="<?php echo $peragraph; ?>" name="peragraph" class="form-control" id="inputperagraph4">
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category_id" aria-label="Default select example">
                                <option value="<?php echo $categoryid; ?>" selected><?php echo $category; ?></option>
                                <?php 
                                    if($row = select("category")){
                                        foreach($row as $row){
                                ?>
                                <option value="<?php echo $row['category_id']?>"><?php echo $row['category']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="subcategory" class="form-label">Sub Category</label>
                            <select class="form-select" name="subcategory_id" aria-label="Default select example">
                                <option value="<?php echo $subcategoryid; ?>" selected><?php echo $subcategory; ?></option>
                                <?php 
                                    if($row = select("subcategory")){
                                        foreach($row as $row){
                                ?>
                                <option value="<?php echo $row['subcategory_id']?>"><?php echo $row['subcategory']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select class="form-select" name="brand_id" aria-label="Default select example">
                                <option value="<?php echo $brandid; ?>" selected><?php echo $brand; ?></option>
                                <?php 
                                    if($row = select("brand")){
                                        foreach($row as $row){
                                ?>
                                <option value="<?php echo $row['brand_id']?>"><?php echo $row['brand']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="color" class="form-label">Color</label>
                            <select class="form-select" name="color_id" aria-label="Default select example">
                                <option value="<?php echo $colorid; ?>" selected><?php echo $color; ?></option>
                                <?php 
                                    if($row = select("color")){
                                        foreach($row as $row){
                                ?>
                                <option value="<?php echo $row['color_id']?>"><?php echo $row['color']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <?php 
                             $image = explode(', ', $image);
                                foreach($image as $image){
                             ?>
                                <img src="../images/<?php echo $image;?>" alt="" style="width:100px;"> 
                            <?php
                                }
                            ?>
                        </div>
                        <div class="col-12">

                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image[]" class="form-control" multiple>
                            <small id="" class="form-text text-muted">Only jpg, jpeg, png and gif Images Allow.</small>
                        </div>
                        <div class="col-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" value="<?php echo $price;?>" name="price" class="form-control" id="price">
                        </div>
                        <div class="col-4">
                            <label for="lessprice" class="form-label">Less Price</label>
                            <input type="number" value="<?php echo $lessprice;?>" name="lessprice" class="form-control" id="lessprice">
                        </div>
                        <div class="col-4">
                            <label for="qty" class="form-label">Available Quantity</label>
                            <input type="number"  name="qty" class="form-control" id="qty" value="<?php echo $qty;?>">
                        </div>
                        <div class="col-md-2">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Status">
                                <option value="<?php if($status == 1){echo "1";}else{echo "2";}?>" selected><?php if($status == 1){echo "Active";}else{echo "Dactive";}?></option>
                                <option value="1">Active</option>
                                <option value="2">Dactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block w-100 shadow">Post</button>
                        </div>
                    </form>
                </div>
                <!----Table ---->
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-12 p-2">
                    <form method="post" action="">
                        <h1 class="text-center">Update <span class="text-warning"><?php echo $update;?></span></h1>
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
                            <label for="category"><?php echo $update;?></label>
                            <input type="text" value="<?php echo $value;?>" name="<?php echo $name;?>" class="form-control" placeholder="<?php echo $update;?>">
                        </div>
                        <div class="form-group">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Status">
                                <option value="1">Active</option>
                                <option value="2">Dactive</option>
                            </select>
                        </div><br>
                        <button type="submit" name="submit"  class="btn btn-primary d-block w-100 shadow">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
    include 'footer.php';
    }else{
        header('Location: adminlogin.php');
        exit;
    }
?>
