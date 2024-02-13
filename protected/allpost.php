<?php 
include "config.php";

if(isset($_GET['load'])){
    $load = $_GET['load'];
    $senddata = $load+4;
}else{
    $senddata = 4;
}

if(isset($_GET['orderby'])){
    $orderby = $_GET['orderby'] ? 'ASC' : 'DESC';
}else{
    $orderby = 'ASC';
}


$sql = "SELECT post.*, category.category, color.color, brand.brand, subcategory.subcategory
        FROM post
        LEFT JOIN category ON post.category_id = category.category_id
        LEFT JOIN color ON post.color_id = color.color_id
        LEFT JOIN brand ON post.brand_id = brand.brand_id
        LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id
        ORDER BY post.id $orderby
        LIMIT 0, $senddata";

    $result = mysqli_query($conn, $sql);
    $data = array();
    if($result){
        if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
        }
        }else{
            $data[] = ['No Data Found......'];
        }
    }else{
        $data[] = ['No Data Found......'];
    }
    header('Content-Type: application/json');
    echo json_encode($data);
// $data = array();
// if($post){
//     $data[] = $result;

// }else{
//     $data[] = ["No Data Found......"];
// }
// mysqli_close($conn);

// header('Content-Type: application/json' );
// echo json_encode($data);









































