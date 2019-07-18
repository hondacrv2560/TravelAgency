<?php
function register($name,$pass,$email)
{
    $conn = new mysqli('localhost', 'test', 'BjVAzm3XR9lYsIgp', 'travels');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connecttest_error);
    }

    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    if ($name == "" || $pass == "" || $email == "") {
        echo "<h3/>
        <span style='color:red;'>
        Fill All Required Fields!
        </span><h3/>";
        return false;
    }
    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3/><span style='color:red;'> Values Length Must Be Between 3 And 30!</span><h3/>";
        return false;
    }

    $conn = new mysqli('localhost', 'test', 'BjVAzm3XR9lYsIgp', 'travels');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connecttest_error);
    }
    $ins = 'insert into users(login,pass,email,roleid) values("' . $name . '","' . md5($pass) . '","' . $email . '",2)';

    $conn->query($ins);
    $err = mysqli_errno($conn);
    if ($err) {
        if ($err == 1062)
            echo "<h3/><span style=’color:red;’>
                This Login Is Already Taken!
              </span><h3/>";
        else
            echo "<h3/><span style='color:red;'>
            Error code:" . $err . "!
              </span><h3/>";
        return false;
    }
    return true;
}

function login($name,$pass)
{
    $conn = new mysqli('localhost', 'test', 'BjVAzm3XR9lYsIgp', 'travels');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connecttest_error);
    }

    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    if ($name == "" || $pass == "") {
        echo "<h3/><span style='color:red;'> Fill All Required Fields!</span><h3/>";
        return false;
    }
    if (strlen($name) < 3 || strlen($name) > 30 ||
        strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3/><span style='color:red;'> Value Length Must Be Between 3 And 30!</span><h3/>";
        return false;
    }

    $sel = 'select * from users where login="' . $name . '" and pass="' . md5($pass) . '"';
    $res = $conn->query($sel);
    if ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        $_SESSION['ruser'] = $name;
        if ($row[5] == 1) {
            $_SESSION['radmin'] = $name;
        }
        return true;
    }
    else {
        echo "<h3/><span style='color:red;'> No Such User!</span><h3/>";
        return false;
    }
}
?>