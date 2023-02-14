<?php

require 'FUNC_VALID.php';
require 'CRUD.php';
CREATE_DATABASE('F1');
CREATE_TABLE('F1', 'MyPosts');

$SECONDimgErr = $FIRSTimgErr = $articleErr = $titleErr = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $flag = false;

    $title = VALID_TITLE($_POST['title']);
    if (is_array($title)) {
        $titleErr = $title[1];
        $flag = $title[0];
    }



    $article = VALID_ARTICLE($_POST['article']);
    if (is_array($article)) {
        $articleErr = $article[1];
        $flag = $article[0];
    }
    $article = str_replace("'", "''", $article);


    $img = '';
    $file = '';
    if ($flag == false) {
        $file = VALID_IMG($_FILES['FirstImgToUpload']);
        if (is_array($file)) {
            $FIRSTimgErr = $file[1];
            $flag = $file[0];
        }
        $img = VALID_IMG($_FILES['SecondImgToUpload']);
        if (is_array($file)) {
            $SECONDimgErr = $img[1];
            $flag = $img[0];
        }

    }
    $Cs = '';
    if (empty($_POST['Comments'])) {
        $Cs = false;

    } else {
        $Cs = true;
    }


    if ($flag == false) {
        // INSERT($dbname, $table, $what, $input)
        INSERT('F1', 'MyPosts', $title, $article, $file, $img, $Cs, date("Y-m-d H:i:s"));
        header("Refresh:0; url=ManagePosts.php");

    }

    // date("Y/m/d")



}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
</head>

<body>
    <div class="conrainer my-5">
        <h2>New Post</h2>


        <?php
        if (!empty($titleErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$titleErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($articleErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$articleErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($FIRSTimgErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$FIRSTimgErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }
        if (!empty($SECONDimgErr)) {
            echo "
            <div class='alert alert-warning alert-dismissible fale show' role='alert'>
            <strong>$SECONDimgErr</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></strong>
            </div>
            ";

        }

        ?>


        <form method="post" enctype='multipart/form-data'
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" value="<?php if (isset($_POST['title'])) {
                        echo $_POST['title'];
                    } ?>"
                        class="form-control" name="title">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Article</label>
                <div class="col-sm-6">
                    <textarea type="text" rows='10' class="form-control" name="article"><?php if (isset($_POST['article'])) {echo $_POST['article'];}?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 ">Comments</label>
                <input class='form-check-input' type='checkbox' name='Comments'>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-6">
                    <input type='file' name='FirstImgToUpload'>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Banner</label>
                <div class="col-sm-6">
                    <input type='file' name='SecondImgToUpload'>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
                <div class="col-sm-3 d-grid ">
                    <a role="button" class="btn btn-outline-primary" href="/PROJ/ManagePosts.php">Cancel</a>
                </div>
            </div>

        </form>


    </div>

</body>

</html>