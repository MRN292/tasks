<?php
require 'CRUD.php';

CREATE_DATABASE('F1');
CREATE_TABLE('F1', 'MyPosts');
$SeERR = '';


session_start();

// if (isset($_SESSION["user"])) {
//     if (time() - $_SESSION["login_time_stamp"] > 10) {
//         $SeERR="session ended";
//         session_unset();
//         session_destroy();

//         // header("Location:login.php");
//     }
// } else {
//     header("Location:login.php");
// }




if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    DeleteR('F1', 'MyPosts', $id);
    header("Refresh:0; url=ManagePosts.php");
}
if (isset($_GET['CSV'])) {
    CSV('F1');
    exit;
}
if (isset($_GET['PDF'])) {
    PDF('F1');
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>

</head>

<body>
    <div class="conrainer my-5">
        <h2>My Posts</h2>
        <?php
        if (!empty($SeERR)) {
            echo "
                    <div class='alert alert-warning alert-dismissible fale show' role='alert'>
                    <strong>$SeERR</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' >
                    </div>
                ";
        }

        ?>


        <div class="col-sm-3 d-inline-flex">

            <form action="" method="GET">
                <div class="input-group mb-3">
                    <input type="text" value="<?php
                    if (isset($_GET['search'])) {
                        echo $_GET['search'];
                    }
                    ?>" name="search" class="form-control" placeholder="search">
                    <button type="submit" class="btn btn-primary">SEARCH</button>
                </div>
            </form>
        </div>
        <a style="margin-left: 68%;" href="/PROJ/CreatePost.php" class="btn btn-primary" role="button">New Post</a>
        <hr>
        <div class="col-sm-3 d-inline-flex">

            <form action="" method="GET">
                <div class="input-group mb-3">
                    <!-- <input type="text" name="search" class="form-control"> -->
                    <select name="sort" class="form-control">
                        <option value="reset">-Select Option-</option>
                        <option value="Alphabet" <?php if (isset($_GET['sort']) && $_GET['sort'] == "Alphabet") {
                            echo 'selected';
                        } ?>>Alphabet</option>
                        <option value="CreationDateOLD" <?php if (isset($_GET['sort']) && $_GET['sort'] == "CreationDateOLD") {
                            echo 'selected';
                        } ?>>Creation Date(OLDER)</option>
                        <option value="CreationDateNEW" <?php if (isset($_GET['sort']) && $_GET['sort'] == "CreationDateNEW") {
                            echo 'selected';
                        } ?>>Creation Date(NEWER)</option>
                    </select>
                    <button type="submit" class="input-group-text btn btn-primary">SORT</button>
                </div>
            </form>
        </div>


        <div style=" margin-left :44%" class="d-sm-inline-flex">
            <form action="" method="get">

                Enabled Post : &nbsp;<input class='form-check-input mt-2' type='checkbox' name='EnPost' <?php if (isset($_GET['EnPost']) && !empty($_GET['EnPost'])) {
                    echo "checked";
                } ?>>
                &nbsp;&nbsp;&nbsp;&nbsp;
                Enabled Comments : &nbsp;<input class='form-check-input mt-2' type='checkbox' name='EnComment' <?php if (isset($_GET['EnComment']) && !empty($_GET['EnComment'])) {
                    echo "checked";
                } ?>>
                &nbsp; &nbsp;
                <input type="submit" class="btn btn-primary btn-sm" name="filter" value="FILTER">
                <a href="/PROJ/ManagePosts.php" class="btn btn-danger  btn-sm" role="button">RESET</a>
            </form>
        </div>


    </div>

    <br>
    <table class='table table-boarderd'>
        <thead>
            <tr>
                <th>Icon</th>
                <th>Id</th>
                <th>Title</th>
                <th>Article</th>
                <th>Banner</th>
                <th>State</th>
                <th>Comments</th>
                <th>Published at</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>

            <?php

            if (isset($_GET['search'])) {
                $quary = SEARCHER('F1', 'MyPosts', $_GET['search']);


                while ($res = mysqli_fetch_assoc($quary)) {
                    out($res);

                }
            } else {
                if (isset($_GET['sort'])) {
                    $sort = '';
                    if ($_GET['sort'] == "Alphabet") {
                        $sort = 'ASC';
                        $quary = sorter('F1', 'MyPosts', 'title', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            out($res);

                        }

                    }
                    if ($_GET['sort'] == "reset") {
                        header("Refresh:0; url=ManagePosts.php");

                    }
                    if ($_GET['sort'] == "CreationDateOLD") {
                        $sort = 'ASC';
                        $quary = sorter('F1', 'MyPosts', 'date_published', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            out($res);

                        }

                    }
                    if ($_GET['sort'] == "CreationDateNEW") {
                        $sort = 'DESC';
                        $quary = sorter('F1', 'MyPosts', 'date_published', $sort);
                        while ($res = mysqli_fetch_assoc($quary)) {
                            out($res);

                        }

                    }

                } else {
                    if (isset($_GET['filter'])) {
                        if (!empty($_GET['EnComment']) && empty($_GET['EnPost'])) {
                            $quary = SpecialRead('F1', 'MyPosts', '*', 'comments_enabled', 1);
                            while ($res = mysqli_fetch_assoc($quary)) {
                                out($res);

                            }


                        }
                        if (empty($_GET['EnComment']) && !empty($_GET['EnPost'])) {
                            $quary = SpecialRead('F1', 'MyPosts', '*', 'enabled', 1);
                            while ($res = mysqli_fetch_assoc($quary)) {
                                out($res);

                            }


                        }
                        if (!empty($_GET['EnComment']) && !empty($_GET['EnPost'])) {
                            $quary = SpecialReadTwo('F1', 'MyPosts', '*', 'enabled', 'comments_enabled', 1, 1);
                            while ($res = mysqli_fetch_assoc($quary)) {
                                out($res);

                            }

                        }
                        if (empty($_GET['EnComment']) && empty($_GET['EnPost'])) {
                            $quary = SpecialReadTwo('F1', 'MyPosts', '*', 'enabled', 'comments_enabled', 0, 0);
                            while ($res = mysqli_fetch_assoc($quary)) {
                                out($res);

                            }

                        }

                    } else {
                        $quary = Read('F1', 'MyPosts', '*');


                        while ($res = mysqli_fetch_assoc($quary)) {
                            out($res);

                        }
                    }

                }

            }

            ?>


        </tbody>


    </table>
    </div>
    <center>
        <form action="" method='GET'>
            <button name='CSV' class="btn btn-success">Export to CSV</button>
            <button onclick="window.print()" class="btn btn-danger">PRINT</button>
            <button name='PDF' class="btn btn-success">Export to PDF</button>

        </form>


    </center>
</body>

</html>