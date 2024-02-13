<?php
    include 'header.php';
    if(isset($_SESSION['email']) && isset($_SESSION['email'])){
    // $error = "";
    // if(isset($_POST['submit'])){
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     if($_POST['name'] == ""){
    //         $error = "Name Field Is Required";
    //     }elseif($_POST['email'] == ""){
    //         $error = "Email Field Is Required";
    //     }elseif($_POST['password'] == ""){
    //         $error = "Password Required";
    //     }else{
    //         adminlogininsert($_POST);
    //         return true;
    //     }
    // }
?>
<div class="page d-flex">
    <?php include 'sidebar.php';?>                                                                               
    <div class="body w-100">
        <div class="container">
            <div class="row p-3 pt-4">
                <div class="col-md-4 col-sm-6">
                    <div class="card mycards mt-2 mb-2">
                        <span class="position-absolute"><i class="fa-solid fa-pen-fancy"></i></span>
                        <h2 class="card-header text-center">Total Post</h2>
                        <div class="card-body text-center">
                            <p class=""><?php if($post =  dataCount("post")){
                            echo $post;
                            }?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mycards mt-2 mb-2">
                        <span class="position-absolute"><i class="fa-solid fa-list"></i></span>
                        <h2 class="card-header text-center">Total Category</h2>
                        <div class="card-body">
                            <p class=""><?php if($post =  dataCount("category")){
                            echo $post;
                            }?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mycards mt-2 mb-2">
                        <span class="position-absolute"><i class="fa-solid fa-layer-group"></i></span>
                        <h2 class="card-header text-center">Total Sub-Category</h2>
                        <div class="card-body">
                            <p class=""><?php if($post =  dataCount("subcategory")){
                            echo $post;
                            }?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mycards mt-2 mb-2">
                        <span class="position-absolute"><i class="fa-solid fa-layer-group"></i></span>
                        <h2 class="card-header text-center">Total Brands</h2>
                        <div class="card-body">
                            <p class=""><?php if($post =  dataCount("brand")){
                            echo $post;
                            }?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mycards mt-2 mb-2">
                        <span class="position-absolute"><i class="fa-solid fa-layer-group"></i></span>
                        <h2 class="card-header text-center">Total Colors</h2>
                        <div class="card-body">
                            <p class=""><?php if($post =  dataCount("color")){
                            echo $post;
                            }?></p>
                        </div>
                    </div>
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
