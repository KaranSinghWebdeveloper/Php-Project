
<?php
    include 'header.php'; 
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    if(isset($_GET['subcategorystatus'])){
        $id = $_GET['subcategorystatus'];
        if($row = select('subcategory', "subcategory_id='$id'")){
        $name = "subcategory";
        $table = "subcategory";
        foreach($row as $row){
        $status = $row['status'];
        if($status == 1){
            $newstatus = 2;
        }else{
            $newstatus = 1;
        }
        $post = "status = '$newstatus'";
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['categorystatus'])){
        $id = $_GET['categorystatus'];
        if($row = select('category', "category_id='$id'")){
        $name = "category";
        $table = "category";
        foreach($row as $row){
        $status = $row['status'];
        if($status == 1){
            $newstatus = 2;
        }else{
            $newstatus = 1;
        }
        $post = "status = '$newstatus'";
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['colorstatus'])){
        $id = $_GET['colorstatus'];
        if($row = select('color', "color_id='$id'")){
        $name = "color";
        $table = "color";
        foreach($row as $row){
        $status = $row['status'];
        if($status == 1){
            $newstatus = 2;
        }else{
            $newstatus = 1;
        }
        $post = "status = '$newstatus'";
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['brandstatus'])){
        $id = $_GET['brandstatus'];
        if($row = select('brand', "brand_id='$id'")){
        $name = "brand";
        $table = "brand";
        foreach($row as $row){
        $status = $row['status'];
        if($status == 1){
            $newstatus = 2;
        }else{
            $newstatus = 1;
        }
        $post = "status = '$newstatus'";
        $condition = $table."_id";
        }
        }
    }else if(isset($_GET['poststatus'])){
        $id = $_GET['poststatus'];
        if($row = select('post', "id='$id'")){
        $name = "newpost";
        $table = "post";
        foreach($row as $row){
        $status = $row['status'];
        if($status == 1){
            $newstatus = 2;
        }else{
            $newstatus = 1;
        }
        $post = "status = '$newstatus'";
        $condition = "id";
        }
        }
    }else{
        echo "<script>history.back();</script>";
        exit();
    }

    if(isset($table)){   
        global $conn;
        $sql = "UPDATE $table SET `status`='$newstatus' WHERE $condition='$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
        $successMessage = "Data Update successfully!";
        header("Location: $name.php?message=" . $successMessage);
        exit();
        }else{
            $successMessage = "Data Not Updated Something Error!!";
            header("Location: $name.php?notsuccess=" . $successMessage);
            exit();
        }
        
    }
?>
<?php

    include 'footer.php';
    }else{
        header('Location: adminlogin.php');
        exit;
    }
?>
