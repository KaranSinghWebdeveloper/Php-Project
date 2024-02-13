<?php
    include 'header.php';
    if(isset($_SESSION['name']) && isset($_SESSION['email'])){
    $error = "";
    if(isset($_POST['submit'])){
        if(insert("post", $_POST, $_FILES, "../images/"/* Your Table,  Your Data, $_FILES, imagefolder (Optional)*/)){
            $successMessage = "Data inserted successfully!";
            header("Location: newpost.php?message=" . $successMessage);
            exit();
        }else{
            $successMessage = "Data Not inserted successfully!";
            header("Location: newpost.php?notsuccess=" . $successMessage);
            exit();
        }
        // $name = $_POST['name'];
        // $title = $_POST['title'];
        // $peragraph = $_POST['peragraph'];
        // if($_POST['name'] == ""){
        //     $error = "Name Field Is Required";
        // }elseif($_POST['title'] == ""){
        //     $error = "title Field Is Required";
        // }elseif($_POST['peragraph'] == ""){
        //     $error = "peragraph Required";
        // }else{
        //     adminlogininsert($_POST);
        //     return true;
        // }
    }
?>

<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-12 pb-4">
                    <h2 class="text-warning text-center fw-bold mb-2">Add New Product</h2>
                    <?php
                    if(isset($_GET['message'])){
                    ?>
                    <div class="alert alert-success"><?php echo $_GET['message'];?></div>
                    <?php
                    }else if(isset($_GET['notsuccess'])){ ?>
                    <div class="alert alert-danger"><?php echo $_GET['notsuccess'];?></div>
                    <?php } ?>
                    <form class="row g-2" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="inputtitle4" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="inputtitle4" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputperagraph4" class="form-label">Peragraph</label>
                            <input type="text" name="peragraph" class="form-control" id="inputperagraph4"required>
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category_id" aria-label="Default select example"required>
                                <option selected>Select Category</option>
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
                            <select class="form-select" name="subcategory_id" aria-label="Default select example"required>
                                <option selected>Select Sub Category</option>
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
                            <select class="form-select" name="brand_id" aria-label="Default select example"required>
                                <option selected>Select Brand</option>
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
                            <select class="form-select" name="color_id" aria-label="Default select example"required>
                                <option selected>Select Color</option>
                                <?php 
                                    if($row = select("color")){
                                        foreach($row as $row){
                                ?>
                                <option value="<?php echo $row['color_id']?>"><?php echo $row['color']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image[]" class="form-control" multiple required>
                            <small id="" class="form-text text-muted">Only jpg, jpeg, png and gif Images Allow.</small>
                        </div>
                        <div class="col-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" id="price" placeholder="1500"required>
                        </div>
                        <div class="col-4">
                            <label for="lessprice" class="form-label">Less Price</label>
                            <input type="number" name="lessprice" class="form-control" id="lessprice" placeholder="1299"required>
                        </div>
                        <div class="col-4">
                            <label for="qty" class="form-label">Available Quantity</label>
                            <input type="number"  name="qty" class="form-control" id="qty" placeholder="Quantity"required>
                        </div>
                        <div class="col-md-2">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select" name="status" aria-label="Status"required>
                                <option selected>Status</option>
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
                <div class="col-12">
                    <table class="table table-striped overflow-auto">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        if(isset($_GET['search'])){
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM post
                                LEFT JOIN category ON post.category_id = category.category_id
                                LEFT JOIN color ON post.color_id = color.color_id
                                LEFT JOIN brand ON post.brand_id = brand.brand_id
                                LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id 
                                WHERE post.title LIKE '%$search%' 
                                OR post.peragraph LIKE '%$search%'
                                OR color.color LIKE '%$search%'
                                OR brand.brand LIKE '%$search%'
                                OR category.category LIKE '%$search%'
                                OR subcategory.subcategory LIKE '%$search%'
                                ";
                            $row = selectWithSql($sql);
                            if($row){
                            foreach($row as $row){
                        ?>
                        <tr class="">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td>
                            <?php
                                $image = explode(', ', $row['image']);
                                foreach($image as $image){
                            ?>
                                <img src="../images/<?php if($image != ""){ echo $image; }else{ echo "blank.jpg";}?>" style="width:50px;">
                                <span>X</span>
                            <?php
                            }
                            ?>
                            </td>
                            <td><?php echo $row['category'] ?></td>
                            <td><?php echo $row['brand'] ?></td>
                            <td><?php
                            if($row['status'] == 1){ ?>
                            <a href="status.php?poststatus=<?php echo $row['id'] ?>">
                                <i class="fa-solid fa-star text-primary status"></i>
                            </a>    
                            <?php }else{ ?>
                            <a href="status.php?poststatus=<?php echo $row['id'] ?>">
                                <i class="fa-solid fa-star text-danger status opacity-50"></i>
                            </a>    
                            <?php } ?>
                            </td>
                            <td><a href="update.php?post=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a></td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');"  href="delete.php?delete=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                                
                        </tr>
                        <?php } } } ?>

                        <?php
                        $total = select('post');
                        $totaldata = mysqli_num_rows($total);
                        $limit = 8;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start = ($page - 1) * $limit;
                        $sql = "SELECT post.*, category.category, color.color, brand.brand, subcategory.subcategory FROM post
                                LEFT JOIN category ON post.category_id = category.category_id
                                LEFT JOIN color ON post.color_id = color.color_id
                                LEFT JOIN brand ON post.brand_id = brand.brand_id
                                LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id 
                                LIMIT $start, $limit";
                            $row = selectWithSql($sql);
                            if($row){
                            foreach($row as $row){
                        ?>
                        <tr class="" style="position:relative;">
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td>
                            <?php
                                $image = explode(', ', $row['image']);
                                foreach($image as $image){
                            ?>
                                <img src="../images/<?php if($image != ""){ echo $image; }else{ echo "blank.jpg";}?>" style="width:50px;" >
                                    <a href="delete.php?imagedelete=<?php echo $image;?>&imageid=<?php echo $row['id'] ?>" style="position: absolute;top: 0;color: red;font-weight: bold;text-decoration:none;">x</a>
                            <?php
                            }
                            ?>
                            </td>
                            <td><?php echo $row['category'] ?></td>
                            <td><?php echo $row['brand'] ?></td>
                            <td><?php
                            if($row['status'] == 1){ ?>
                            <a href="status.php?poststatus=<?php echo $row['id'] ?>">
                                <i class="fa-solid fa-star text-primary status"></i>
                            </a>    
                            <?php }else{ ?>
                            <a href="status.php?poststatus=<?php echo $row['id'] ?>">
                                <i class="fa-solid fa-star text-danger status opacity-50"></i>
                            </a>    
                            <?php } ?>
                            </td>
                            <td><a href="update.php?post=<?php echo $row['id'] ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a></td>
                            <td><a onclick="return confirm('Are You Sure Data Delete');"  href="delete.php?delete=<?php echo $row['id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                                
                        </tr>
                        <?php } } ?>
                    </table>
                </div>
                <div class="text-center">
                    <?php 
                        $total = ceil($totaldata / $limit);
                        if($page > 1){
                    ?>
                        <a href="newpost.php?page=<?php echo $page - 1?>" class="bg-primary p-2 text-white text-decoration-none rounded">Prev...</a>
                    <?php
                        }
                        for($i=1; $i <= $total; $i++){ ?>
                        <a href="newpost.php?page=<?php echo $i?>" class="bg-primary p-2 text-white text-decoration-none rounded"><?php echo $i?></a>
                    <?php
                        }
                        if($total > $page){
                    ?>
                        <a href="newpost.php?page=<?php echo $page + 1?>" class="bg-primary p-2 text-white text-decoration-none rounded">Next....</a>
                    <?php
                        }
                    ?>
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