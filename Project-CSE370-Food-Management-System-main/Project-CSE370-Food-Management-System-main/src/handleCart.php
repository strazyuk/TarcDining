<?php 
require_once('DBconnect.php');
if (isset($_POST['itemName']) && isset($_POST['itemPrice']) && isset($_POST['useremail']) && isset($_POST['itemID']) ){
    $useremail = $_POST['useremail'];
    $itemID = $_POST['itemID'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $sql = "SELECT COUNT(*) AS count FROM cart WHERE email = '$useremail' AND f_id = '$itemID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        // we check if product already exist or not so that we can update quantity
        
        $sql = "INSERT INTO cart (email, f_id, name, token) VALUES ('$useremail', '$itemID', '$itemName', '$itemPrice')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: menu.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
