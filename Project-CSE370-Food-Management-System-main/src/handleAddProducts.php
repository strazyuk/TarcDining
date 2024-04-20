<?php
require_once('DBconnect.php');
if (isset($_POST['itemName']) && isset($_POST['tokenCount'])  && isset($_POST['itemType']) && isset($_POST['itemImage'])){
    $itemName = $_POST['itemName'];
    $tokenCount = $_POST['tokenCount'];
    $itemType = $_POST['itemType'];
    $itemImage = $_POST['itemImage'];
    $sellcount = 0;
    $publishdate = date("Y-m-d");
    $status = "pending";
    $query = "INSERT INTO curMenu (name, img, token , sellcount, type , status) VALUES ('$itemName', '$itemImage', '$tokenCount', '$sellcount', '$itemType', '$status')";
    $result = mysqli_query($conn, $query);
    if ($result){
        header("Location: addProducts.php");
    } else {
        echo "failed";
    }
} 
?>