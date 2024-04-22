<?php 
require_once('DBconnect.php');
if (isset($_POST['itemID']) && isset($_POST['useremail']) && isset($_POST['totalCost'])){
    $productid = $_POST['itemid'];
    $useremail = $_POST['useremail'];
    $totalCost=$_POST['totalCost'];
    $sql = "DELETE FROM cart WHERE email = '$useremail' AND f_id = '$productid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        header("Location: Cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
}
?>