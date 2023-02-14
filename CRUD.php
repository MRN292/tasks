<?php
// $servername = "localhost";
// $Suser = "root";

// $Spass = "";

// $dbname = "mehran";

// $table = "MyAcc";


function CREATE_DATABASE($dbname)
{

    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE $dbname";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
function CREATE_TABLE($dbname, $table)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE TABLE $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(30),
        article LONGTEXT NOT NULL,
        file VARCHAR(255) NULL,
        banner_img VARCHAR(255), 
        date_published DATETIME,        
        enabled  BOOLEAN default true,
        comments_enabled BOOLEAN default true,
        shower BOOLEAN default true)";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

}
function CREATE_TABLE_USER($dbname, $table)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE TABLE $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30),
        email VARCHAR(255),
        password VARCHAR(255))";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

}




function INSERT($dbname, $table, $input1, $input2, $input3, $input4, $input5, $time)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO $table (title,article," . "file" . ",banner_img,comments_enabled,date_published)
    VALUES ('$input1','$input2','$input3','$input4','$input5','$time')";

    // echo $sql;
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
function INSERT_USER($dbname, $table, $input1, $input2, $input3)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO $table (username,email,password)
    VALUES ('$input1','$input2','$input3')";

    // echo $sql;
    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}






function DELETE_DATABASE($dbname)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Create database
    $sql = "DROP DATABASE $dbname";

    mysqli_query($conn, $sql);


    mysqli_close($conn);

}

function DELETE_TABLE($dbname, $table)
{

    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Create database
    $sql = "DROP Table $table";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
function Read($dbname, $table, $what)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);
    $sql = "SELECT $what from $table";
    $quary = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return $quary;
}
function Update($dbname, $table, $what, $input, $where)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    $sql = "UPDATE $table SET $what='$input' WHERE id=$where";

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

}
function DeleteR($dbname, $table, $where)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $sql = "UPDATE $table SET shower='0' WHERE id=$where";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}

function SpecialRead($dbname, $table, $what, $where, $input)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);
    $sql = "SELECT $what from $table where $where='$input'";
    $quary = mysqli_query($conn, $sql);
    if (!$quary) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        mysqli_close($conn);

        return $quary;
    }
    mysqli_close($conn);
}

function SEARCHER($dbname, $table, $input)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = " SELECT * FROM $table WHERE CONCAT(title,article) LIKE  '%$input%'";

    $quary = mysqli_query($conn, $sql);
    if (!$quary) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        mysqli_close($conn);

        return $quary;
    }
    mysqli_close($conn);

}

function sorter($dbname, $table, $what, $sort)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = " SELECT * FROM $table ORDER BY $what $sort";

    $quary = mysqli_query($conn, $sql);
    if (!$quary) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    } else {
        mysqli_close($conn);

        return $quary;
    }
    mysqli_close($conn);
}

function out($res)
{
    $Cf = '';
    $Cs = '';

    if ($res['enabled'] == 1) {
        $Cf = "checked";
    }
    if ($res['comments_enabled'] == 1) {
        $Cs = "checked";
    }


    $temp = $res['shower'];

    if ($temp == 1) {
        echo "
                                    <tr>
                                        <td> <img width='80%' height='35' src='uploads/img/" . $res['file'] . "' </td>
                                        <td> " . $res['id'] . "</td>
                                        <td> " . $res['title'] . " </td>
                                        <td > <div style=' width : 500px ; height : 25px' class= 'overflow-hidden text-truncate'>" . $res['article'] . "</div> </td>
                                        <td><img width='60px' height='50' src='uploads/img/" . $res['banner_img'] . "'  </td>
        
        
                                        <td> <input class='form-check-input' type='checkbox' name='state' " . $Cf . " disabled> </td>
                                        <td> <input class='form-check-input' type='checkbox' name='comment' " . $Cs . " disabled> </td>
        
                                        
                                        <td > " . $res['date_published'] . " </td>
        
        
            
                                        <td>
        
                                        <form method='get' action='EditPosts.php' class='d-sm-inline-flex'>
                                        <button method='get' class='btn btn-primary btn-sm' name ='edit' value='" . $res['id'] . "'>Edit</button>
                                        </form>
        
                                        <form method='get' class='d-sm-inline-flex'>
                                        <button method='get' class='btn btn-danger btn-sm' name ='delete' value='" . $res['id'] . "'>Delete</button>
                                        </form>
        
                                        </td>
                                    </tr>
                    
                                    ";
    }
}
function SpecialReadTwo($dbname, $table, $what, $where1, $where2, $input1, $input2)
{
    $servername = "localhost";
    $Suser = "root";

    $Spass = "";

    $conn = mysqli_connect($servername, $Suser, $Spass, $dbname);
    $sql = "SELECT $what from $table where $where1=$input1 AND $where2=$input2";
    $quary = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return $quary;
}
?>