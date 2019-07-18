<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hotel Info</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/info.css">
    <style>
        #show{
            list-style-type: none;
        }

    </style>
</head>
<body>
    <?php
        $conn=new mysqli('localhost','test','BjVAzm3XR9lYsIgp','travels');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connecttest_error);
            }
        if(isset($_GET['hotel'])){
            $hotel=$_GET['hotel'];
            $sel='select * from hotels where id='.$hotel;
            $res = $conn->query($sel);;
            $row=mysqli_fetch_array($res,MYSQLI_NUM);
            $hname=$row[1];
            $hstars=$row[4];
            $hcost=$row[5];
            $hinfo=$row[6];
        mysqli_free_result($res);
        echo '<h2 class="text-uppercase text-center">'.$hname.'</h2>';
            echo '<span class="label label-info">Level of comfort and service provided by the hotel</span>';
            for ($i=0; $i<$hstars; $i++)
            {
                echo '<image src="../images/star.png" width="60" height="33" alt="star">';
            }
        echo '<div class="row"><div class="col-md-6 text- center">';
        $sel='select imagepath from images where hotelid='.$hotel;
        $res = $conn->query($sel);
        echo '<span class="label label-info">Watch our pictures</span>';
        echo'<ul id="gallery">';
         $i=0;
        while($row=mysqli_fetch_array($res,MYSQLI_NUM)){
            echo '<li id="show"><img src="../'.$row[0].'"></li>';
        }

        mysqli_free_result($res);
        echo ' </ul>';
        echo '<h2 class="text-uppercase text-left">Price per day: '.$hcost.'</h2>';
        echo '</br>';
        echo '<h2 class="text-uppercase text-center">About: '.$hname.' '.$hinfo.'</h2>';
        echo '</br>';
        echo '<h2 class="text-uppercase text-center">Comments: '.$hname.' '.$hinfo.'</h2>';
            $selcom='SELECT info from comments WHERE hotelid='.$hotel;
            $rescom = $conn->query($selcom);
            $err=mysqli_errno($conn);
            echo '<table class="table" width="100%">';
            while ($row=mysqli_fetch_array($rescom,MYSQLI_NUM)) {
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
//                echo '<td><input type="checkbox" name="hb' . $row[2] . '"></td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>