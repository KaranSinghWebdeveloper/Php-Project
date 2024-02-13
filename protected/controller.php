<?php
//function adminlogininsert($data){
//    global $conn;
//    print_r($data);
//    foreach($data as $key => $value){
//        $update =  "$key  = '$value', ";
//        echo $update;
//    }
//    die();
//    $name = $data['name'];
//    $email = $data['email'];
//    $password = $data['password'];
//    $sql = "insert into adminlogin (name, email, password) values ('$name', '$email', '$password')";
//    $result = mysqli_query($conn, $sql);
//    if($result){
//        $_SESSION['name'] = $name;
//        $_SESSION['email'] = $email;
//        $_SESSION['password'] = $password;
//        $session = $_SESSION['name'];
//        echo "Insert Data Success fully $session";
//    }else{
//        echo "Some Error";
//    }
//}

//function adminselect(){
//    $sql = "select * from adminlogin";
//    $result = mysqli_query($conn, $sql);
//    if(mysqli_num_rows($result) > 0){
//        global $conn;   
//        return $result;
//    }
//}

function adminlogin($data){
    global $conn;
    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $sql = "select * from adminlogin where email='$email' and password='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
           $_SESSION['name'] = $row['name'];
           $_SESSION['id'] = $row['id'];
        }
        header('Location: index.php');
        exit;
    }else{
        return "Please Enter Valid Email Password";
    }
}

//function adminselectfrom($email){
//    global $conn;
//    $sql = "select * from adminlogin where email='$email'";
//    $result = mysqli_query($conn, $sql);
//    if(mysqli_num_rows($result) > 0){
//        while($row = mysqli_fetch_assoc($result)){
//            return $row;
//        }
//    }
//}

//function adminupdate($data){
//    global $conn;
//    $uname = $data['uname'];
//    $uid = $data['uid'];
//    $uemail = $data['uemail'];
//    $upassword = $data['upassword'];
//    $sql = "update adminlogin set name='$uname', email='$uemail', password='$upassword' where id='$uid'";
//    $result = mysqli_query($conn, $sql);
//    if($result){
//        echo "Update Data Success fully";
//    }else{
//        echo "Some Error";
//    }
//}


//function admindelete($did){
//    global $conn;
//    $sql = "delete from adminlogin where id='$did'";
//    $result = mysqli_query($conn, $sql);
//    if($result){
//        echo "Delete Data Success fully";
//        
//       header('Location: addadmin.php');
//    }else{
//        echo "Some Error";
//    }
//}

//function selectTable($table, $id=null){
//    global $conn;
//    if(empty($id)){
//        $result = mysqli_query($conn, "select * from $table");
//        if(mysqli_num_rows($result) > 0){
//            return $result;
//        }else{
//            return "Data Not Avelable";
//        }
//    }else{
//        $result = mysqli_query($conn, "select * from $table where id='$id'");
//        if(mysqli_num_rows($result) > 0){
//            return $result;
//        }else{
//            return "Data Not Avelable";
//        }
//    }
//}


//My All Php Website Querys.....................................

//Select All And With Query.....
function selectWithSql($sql){
    global $conn;
    if(!empty($sql)){
        $result = mysqli_query($conn, $sql);    
        if(mysqli_num_rows($result) > 0){
            return $result;
        }else{
            return false;
        }
    }else{
            return false;
        }
}

//Select With id................
function select($table, $condition=null){
    global $conn;
    if(!empty($condition)){
        $sql = "SELECT * FROM $table WHERE $condition";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            return $result;
        }else{
            return false;
        }
    }else{
        $result = mysqli_query($conn, "select * from $table");
        if(mysqli_num_rows($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
}

//Insert Data Query.....
function insert($table, $data, $file=null, $imagefolder=null){
    global $conn;
    if(!empty($data)){
    unset($data['submit']);
    if(!empty($file['image']['name'][0])){
    foreach($file['image']['name'] as $all){
    $allfiles[] = $all;
    }
    foreach($file['image']['tmp_name'] as $key => $alltmpname){
        $alltmp[] = $alltmpname;
    }
    foreach($allfiles as $key => $value){
        $upload = move_uploaded_file($alltmp[$key], "../images/".$value);
    }
    $images = implode(", ", $allfiles);
    }

    $insert = array();
    foreach ($data as $key => $value) {
        $insert[$key] = mysqli_real_escape_string($conn, $value);
    }
    $names = implode(", ", array_keys($insert));
    $values = implode("', '", $insert);
    $sql = "INSERT INTO $table ($names) VALUES ('$values')";
    $result = mysqli_query($conn, $sql);
    if($result){
        if(!empty($file['image']['name'][0])){
            $id = mysqli_insert_id($conn);
            $sql = "UPDATE $table SET image='$images' WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
        }
        if($result){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    }else{
        return false;
    }
}

//insert with Sql Query.........
function insertWithSql($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    if($result){
        return $result;
    }else{
        return false;
    }
}

//Delete Data Query.....
function delete($table, $condition){
    global $conn;
    $sql = "DELETE FROM $table WHERE $condition";
    $result = mysqli_query($conn, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//Update Query.............
function update($table, $data,  $condition, $file=null, $imagefolder=null){
    global $conn;
    unset($data['submit']);
    $sql = "UPDATE $table SET ";
    foreach($data as $key => $value){
        $sql .=  "$key  = '$value', ";
    }
    $sql = rtrim($sql, ', ');
    $sql .= " WHERE  $condition";
    $result = mysqli_query($conn, $sql);
    if(!empty($file['image']['name'][0])){
        $files = $file['image'];
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
                $sql = "UPDATE post SET image='$images' WHERE $condition";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "Successfully Update.....";
            }
            }else{
                echo "Image Not Upload In Folder";
            }
        // end update
}

    if(!empty($file['logo']['name'])){
        $image = $file['logo']['name'];
        $image_tmp = $file['logo']['tmp_name'];
        $image_size = $file['logo']['size'];
        $path = pathinfo($image, PATHINFO_EXTENSION);
        $extension = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        if(in_array($path, $extension)){
            $uploadimage = time().$image;
            move_uploaded_file($image_tmp, $imagefolder.$uploadimage);
            $sql = "UPDATE $table SET logo='$uploadimage' WHERE $condition";
            $result = mysqli_query($conn, $sql);
        }else{
            return false;
        }
    }
    if(!empty($file['icon']['name'])){
        $image = $file['icon']['name'];
        $image_tmp = $file['icon']['tmp_name'];
        $image_size = $file['icon']['size'];
        $path = pathinfo($image, PATHINFO_EXTENSION);
        $extension = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        if(in_array($path, $extension)){
            $uploadimage = time().$image;
            move_uploaded_file($image_tmp, $imagefolder.$uploadimage);
            $sql = "UPDATE $table SET icon='$uploadimage' WHERE $condition";
            $result = mysqli_query($conn, $sql);
        }else{
            return false;
        }
    }
    if(!empty($file['image1']['name'])){
        $image = $file['image1']['name'];
        $image_tmp = $file['image1']['tmp_name'];
        $image_size = $file['image1']['size'];
        $path = pathinfo($image, PATHINFO_EXTENSION);
        $extension = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        if(in_array($path, $extension)){
            $uploadimage = time().$image;
            move_uploaded_file($image_tmp, $imagefolder.$uploadimage);
            $sql = "UPDATE $table SET image1='$uploadimage' WHERE $condition";
            $result = mysqli_query($conn, $sql);
        }else{
            return false;
        }
    }
    if(!empty($file['image2']['name'])){
        $image = $file['image2']['name'];
        $image_tmp = $file['image2']['tmp_name'];
        $image_size = $file['image2']['size'];
        $path = pathinfo($image, PATHINFO_EXTENSION);
        $extension = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        if(in_array($path, $extension)){
            $uploadimage = time().$image;
            move_uploaded_file($image_tmp, $imagefolder.$uploadimage);
            $sql = "UPDATE $table SET image2='$uploadimage' WHERE $condition";
            $result = mysqli_query($conn, $sql);
        }else{
            return false;
        }
    }
    if(!empty($file['image3']['name'])){
        $image = $file['image3']['name'];
        $image_tmp = $file['image3']['tmp_name'];
        $image_size = $file['image3']['size'];
        $path = pathinfo($image, PATHINFO_EXTENSION);
        $extension = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
        if(in_array($path, $extension)){
            $uploadimage = time().$image;
            move_uploaded_file($image_tmp, $imagefolder.$uploadimage);
            $sql = "UPDATE $table SET image3='$uploadimage' WHERE $condition";
            $result = mysqli_query($conn, $sql);
        }else{
            return false;
        }
    }

    if(isset($data['name']) || isset($data['email']) || isset($data['password'])){
    if($result){
        $_SESSION['email'] = $data['email'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['password'] = $data['password'];
        return true;
    }else{
        return false;
    }
    }else{
        return true;
    }
}

//Update with Sql................
function updateWithSql($sql){
    global $conn;
    $result = mysqli_query($conn, $sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

//count post 
function dataCount($table){
    global $conn;
    if(!empty($table)){
        $sql = "SELECT COUNT(*) as num FROM $table";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $num = $row['num'];
        return $num;
    }else{
        return false;
    }
}







