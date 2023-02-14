<?php

require 'CRUD.php';
session_start();



$Err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $tmp = $_POST['username'];
    $tmp2 = hash('md5', $_POST['password']);
    $query = SpecialRead("F1", 'MyAcc', 'password', 'username', $tmp);
    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['password'] == $tmp2) {

                $_SESSION["user"] = $username;
                $_SESSION["login_time_stamp"] = time();
                header("Location:ManagePosts.php");


            }else{
                $Err = "Username or Password is incorrect";
            }
        }
    } else {
        $Err = "Username or Password is incorrect";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <div class="conrainer my-5">
        <h2>Login</h2>


        <?php
        if (!empty($Err)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$Err</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        ?>


        <form method="post" enctype='multipart/form-data'
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username">
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="col-sm-3 d-grid ">
                    <a role="button" class="btn btn-outline-primary" href="/PROJ/Sign.php">Cancel</a>
                </div>
            </div>

        </form>


    </div>

</body>

</html>