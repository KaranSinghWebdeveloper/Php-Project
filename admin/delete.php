<?php
include 'header.php';  
if(isset($_SESSION['email']) && isset($_SESSION['email'])){

if(isset($_GET['categorydelete'])){
    $id = $_GET['categorydelete'];
    $table = "category";
    $page = "category";
    $condation = "category_id='$id'";
}else if(isset($_GET['colordelete'])){
    $id = $_GET['colordelete'];
    $table = "color";
    $page = "color";
    $condation = "color_id='$id'";

}else if(isset($_GET['branddelete'])){
    $id = $_GET['branddelete'];
    $table = "brand";
    $page = "brand";
    $condation = "brand_id='$id'";

}else if(isset($_GET['subcategorydelete'])){
    $id = $_GET['subcategorydelete'];
    $table = "subcategory";
    $page = "subcategory";
    $condation = "subcategory_id='$id'";

}else if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $table = "post";
    $page = "newpost";
    $condation = "id='$id'";

}else if($_GET['imagedelete']){
    $image = $_GET['imagedelete'];
    $id = $_GET['imageid'];
    $page = "newpost";
    $sql = "SELECT * FROM post WHERE id='$id'";
    $row = selectWithSql($sql);
    foreach($row as $row){
        $dataimage[] = $row['image'];
    }
    foreach($dataimage as $key => $value){
        $key ."=". $value;
    }
    $images = explode(', ', $value);
    $withdelte = array_search($image, $images);
    unset($images[$withdelte]);
    $myvalue = implode(", ", $images);
    $sql = "UPDATE post SET image='$myvalue' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $successMessage = "Data Delete successfully!";
        header("Location: $page.php?message=" .$successMessage);
        exit();
    }else{
        $successMessage = "Something Error Data Not Deleted";
        header("Location: $page.php?notsuccess=" .$successMessage);
        exit();
    }
}else{
    echo "<script>history.back();</script>";
    exit();
}
if(isset($id)){
    //admindelete($_GET['delete']);
    if(delete($table, $condation)){
        $successMessage = "Data Delete successfully!";
        header("Location: $page.php?message=" .$successMessage);
        exit();
    }else{
        $successMessage = "Something Error Data Not Deleted";
        header("Location: $page.php?notsuccess=" .$successMessage);
        exit();
    }
    }
}else{
    header('Location: adminlogin.php');
    exit;
}

            