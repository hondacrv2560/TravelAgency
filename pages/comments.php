<?php
$conn=new mysqli('localhost','test','BjVAzm3XR9lYsIgp','travels');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connecttest_error);
}
?>
<div class="col">
    <div class="col-sm-12 col-md-12 col-lg-12 left">
        <?php
        echo '<form action="index.php?page=2" method="post" class="input-group" id="formcomment">';
        $sel='SELECT ho.id, ho.hotel, ho.countryid, ho.info, co.id, co.country
                    from hotels ho, countries co WHERE ho.countryid=co.id';

        $res = $conn->query($sel);
        $err=mysqli_errno($conn);
//        echo '<table class="table" width="100%">';
//        while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
//            echo '<tr>';
//            echo '<td>' . $row[5] . "-" . $row[1] . '</td>';
//            echo '<td><input type="checkbox" name="hb' . $row[2] . '"></td>';
//            echo '</tr>';
//        }
//        echo '</table>';

        echo '<select name="com" class="">';
        while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
            echo '<option value="'.$row[0].'">'.$row[5]." : ".$row[1].'</option>';
            $sel[$row[1]]=$row[3];
        }
        mysqli_free_result($res);

        echo '<textarea name="comment" >Comment</textarea>';
        echo '<input type="submit" name="addcomment" value="добавить" class="btn btn-sm btn-info">';
        echo '<input type="submit" name="delcommnet" value="удалить" class="btn btn-sm btn-warning">';
        echo '</form>';

//        $sel='SELECT ho.id, ho.hotel, ho.countryid, ho.info, co.id, co.country
//                    from hotels ho, countries co, cities ci WHERE ho.countryid=co.id';
        $selcom='SELECT ho.id, ho.hotel, co.hotelid,co.info from hotels ho, comments co WHERE ho.id=co.hotelid';
        $rescom = $conn->query($selcom);
        $err=mysqli_errno($conn);
        echo '<table class="table" width="100%">';
                while ($row=mysqli_fetch_array($rescom,MYSQLI_NUM)) {
                    echo '<tr>';
                    echo '<td>' . $row[1] . "-" . $row[3] . '</td>';
                    echo '<td><input type="checkbox" name="hb' . $row[2] . '"></td>';
                    echo '</tr>';
                }
                echo '</table>';
//        echo '<select name="com" class="">';
//        while ($row=mysqli_fetch_array($res,MYSQLI_NUM)) {
//            echo '<option value="'.$row[0].'">'.$row[5]." : ".$row[1].'</option>';
//            $sel[$row[1]]=$row[3];
//        }
        mysqli_free_result($rescom);

        if(isset($_POST['addcomment'])){
            $hotel=trim(htmlspecialchars($_POST['comment']));
            if ($hotel=="")
                exit();
            $hotelid=$_POST['com'];
            $cityid=$sel[$hotelid];
           // $ins='insert into comments (hotelid, info) values("'.$hotelid.'","'.$hotel.'")';
            $ins="INSERT INTO comments(hotelid, info) VALUES ('".$hotelid."','".$hotel."')";
           /* $ins.=",".$hotelid.','.$hotel;
            $ins.='")';*/
            $conn->query($ins);
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }

        if(isset($_POST['delcommnet'])){
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == "hb") {
                    $idc = substr($k, 2);
                    $del = 'delete from comments where id=' . $idc;
                    $conn->query($del);
                    if ($err) {
                        echo 'Error code:' . $err . '<br>';
                        exit();
                    }
                }
            }
            echo "<script>";
            echo "window.location=document.URL;";
            echo "</script>";
        }
        ?>

    </div>

</div>

