<?php 
require_once('DBconnect.php');
if (isset($_POST['productid']) && isset($_POST['useremail'])){
    $productid = $_POST['productid'];
    $useremail = $_POST['useremail'];
    $sql = "DELETE FROM cart WHERE email = '$useremail
    ' AND f_id = '$productid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: Cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // $sql = "SELECT quantity FROM carts WHERE useremail = '$useremail' AND productId = '$productid'";
    // $result = mysqli_query($conn, $sql);
    // if ($result && mysqli_num_rows($result) > 0) {
    //     $row = mysqli_fetch_assoc($result);
    //     $quantity = $row['quantity'];
    //     if ($quantity > 1) {
    //         $sql = "UPDATE carts SET quantity = quantity - 1 WHERE useremail = '$useremail' AND productId = '$productid'";
    //         $result = mysqli_query($conn, $sql);
    //         if ($result) {
    //             header("Location: Cart.php");
    //         } else {
    //             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //         }
    //     } else {
    //         $sql = "DELETE FROM carts WHERE useremail = '$useremail' AND productId = '$productid'";
    //         $result = mysqli_query($conn, $sql);
    //         if ($result) {
    //             header("Location: Cart.php");
    //         } else {
    //             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //         }
    //     }
    // } else {
    //     echo "Error: Quantity not found";
    // }
}
?>