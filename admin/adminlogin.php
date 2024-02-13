<?php
    session_start();
    include('../protected/config.php');
    include '../protected/controller.php';
    $error = "";
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if($_POST['email'] == ""){
            $error = "Email Field Is Required";
        }elseif($_POST['password'] == ""){
            $error = "Password Required";
        }else{
            $error = adminlogin($_POST);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
	  <link rel="stylesheet" href="css/style.css">
</head>
    <body class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card shadow w-25 p-2">
            <h1 class="card-header text-center">Log in</h1>
            <?php if(!empty($error)){?>
                <div class="alert alert-danger mt-2"><?php echo $error;?></div>
            <?php }?>
            <form action="" method="post" class="card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="<?php if(!empty($email)) {echo $email;}else{ echo ''; } ?>" name="email" class="form-control" placeholder="Email..">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" value="" name="password" class="form-control" id="" aria-describedby="emailHelp" placeholder="*******">
                </div></br>
                <button name="login" class="btn bg-primary text-white fw-bold w-100 shadow d-block" type="submit">Log In</button>
            </form>
        </div>
    </body>
</html>