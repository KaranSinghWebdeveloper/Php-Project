<?php include "header.php"; 

if(isset($_GET['update'])){
    if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $id = $_GET['update'];
    $files = $_FILES['images'];

        if(!empty($files['name'][0])){
            foreach($files['name'] as $all){
                $allfiles[] = $all;
            }
            foreach($files['tmp_name'] as $key => $alltmpname){
                $alltmp[] = $alltmpname;
            }
            foreach($allfiles as $key => $value){
                $upload = move_uploaded_file($alltmp[$key], "image/".$value);
            }

            $images = implode(", ", $allfiles);
            
            if($upload){
                $sql = "UPDATE images SET title='$title', images='$images' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "Successfully Update.....";
            }
            }else{
                echo "Image Not Upload In Folder";
            }
        }else{
            $sql = "UPDATE images SET title='$title' WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Successfully Update....";
            }else{
                echo "Something Error...";
            }
        }
}
}else{
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $files = $_FILES['images'];
    foreach($files['name'] as $all){
        $allfiles[] = $all;
    }
    foreach($files['tmp_name'] as $key => $alltmpname){
        $alltmp[] = $alltmpname;
    }
    foreach($allfiles as $key => $value){
        $upload = move_uploaded_file($alltmp[$key], "image/".$value);
    }
    $images = implode(", ", $allfiles);
    
    if($upload){
        $sql = "INSERT INTO images (title, images) VALUES ('$title', '$images')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Successfully Insert All Images.....";
    }
    }else{
        echo "Image Not Upload In Folder";
    }
}
}


?>

<div class="container">
    <div class="row p-5">
        <div class="col-md-12 p-5">
            <?php if(isset($_GET['update'])){
                $id = $_GET['update'];
                if($row = select('images', "id='$id'")){
                    foreach($row as $row){
                    $image = explode(", ", $row['images']);
            ?>
                <form action="" enctype="multipart/form-data" method="post">
                <label for="" style="display:block;">Title</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
                <label for="" style="display:block;">Image</label>
                <div class="mb-2">
                <?php foreach($image as $key => $value){?>
                <img src="image/<?php echo $image[$key]; ?>" alt="" style="width:50px;">
                <?php }?></div>
                <?php
                    }
                 } ?>
                <input type="file" name="images[]" multiple><br><br>
                <input type="submit" name="submit">
                </form>
            <?php
            }else{?>
            <form action="" enctype="multipart/form-data" method="post">
                <label for="" style="display:block;">Title</label>
                <input type="text" name="title"><br>
                <label for="" style="display:block;">Image</label>
                <input type="file" name="images[]" multiple><br><br>
                <input type="submit" name="submit">
            </form>
            <?php }?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class=" text-center p-5">
                <?php if($row = select('images')){
                    foreach($row as $row){
                    $image = explode(", ", $row['images']);
                ?>
                <h1><?php echo $row['title']; ?></h1>
                <?php foreach($image as $key => $value){?>
                <img src="image/<?php echo $image[$key]; ?>" alt="" style="width:200px;">
                <?php }?>
                <a href="multipleimage.php?update=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                <?php
                    }
                 } ?>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>