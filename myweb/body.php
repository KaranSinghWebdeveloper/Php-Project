

 <div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post"  enctype="multipart/form-data" class="card shadow p-5"> 
                <input type="file" name="image[]" multiple></br>
                <button class="btn bg-primary text-white fw-bold" name="submit" type="submit">Submit</button>
            </form>
        </div>
    </div>
 </div>
 <?php
    if(isset($_POST['submit'])){
        $extension = array('jpeg', 'jpg', 'png');
        foreach($_FILES['image']['tmp_name'] as $key => $value){
            echo $images = $_FILES['image']['name'][$key];
                $images_tmp = $_FILES['image']['tmp_name'][$key];
                $images_size = $_FILES['image']['size'][$key];
                echo "</br>";
                $ext = pathinfo($images, PATHINFO_EXTENSION);
                if(in_array($ext, $extension)){
                    echo "<img src='images/$images'class='w-25'>";
                    echo "</br>";
                }else{
                    echo "Not Allow";
                    echo "</br>";
                }
                $move = move_uploaded_file($images_tmp, 'images/'.time().$images);
                if($move){
                    echo "Successfully Uploaded";   
                    echo "</br>";
                }else{
                    echo "Not Move";
                    echo "</br>";
                }
        }
    }
 ?>
    