<?php

require 'FUNC_VALID.php';
require 'CRUD.php';

CREATE_DATABASE('F1');
CREATE_TABLE_USER('F1', 'MyAcc');


$usernameErr = $emailErr = $passwordErr = $imgErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $flag = false;

    $username = VALID_USER($_POST['username']);
    if (is_array($username)) {
        $usernameErr = $username[1];
        $flag = $username[0];
    }



    $email = VALID_EMAIL($_POST['email']);
    if (is_array($email)) {
        $emailErr = $email[1];
        $flag = $email[0];
    }
    

    $password = VALID_PASS($_POST['password']);
    
    if (is_array($password)) {
        $passwordErr = $password[1];
        $flag = $password[0];
    }
    

    
    // $img= '';
    // if ($flag == false) {
    //     $img = VALID_IMG($_FILES['fileToUpload']);
    //     if (is_array($img)) {
    //         $imgErr = $img[1];
    //         $flag = $img[0];
    //     }

    // }
    if($flag==false){
        // INSERT($dbname, $table, $what, $input)
        INSERT_USER('F1','MyAcc',$username,$email,$password);
        header("Refresh:0; url=login.php");

    }





}





$Vusername = "";
$Vpassword = "";
$Vemail = "";
$Vimg = "";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <div class="conrainer my-5">
        <h2>Sign in</h2>


        <?php
        if (!empty($usernameErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$usernameErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($emailErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$emailErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";
        }
        if (!empty($passwordErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$passwordErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }

        ?>


        <form method="post" enctype='multipart/form-data' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" value="<?php echo $Vusername ; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $Vemail ; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" value="<?php echo $Vpassword ; ?>">
                </div>
            </div>

            <!-- <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Your Image</label>
                <div class="col-sm-6">
                    <input type='file' name='fileToUpload'>
                    
                </div>
            </div> -->

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
                <div class="col-sm-3 d-grid ">
                    <a role="button" class="btn btn-outline-primary" href="/PROJ/login.php">Login</a>
                </div>
            </div>

        </form>


    </div>

</body>

</html>