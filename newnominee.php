<?php
session_start();

include 'connect.php';

// checking the user
if (isset($_GET['pid'])) {
    $sel_session = "select sessionid from session where currentlyActive=TRUE";
    $run_session = mysqli_query($con, $sel_session);

    $data = $run_session->fetch_array();
    $_SESSION['sessionid'] = (string)$data['sessionid'];


    $_SESSION['user'] = $_GET['pid'];
    $_SESSION['usertype'] = 'nominee';

    header("Location:Nominee.php");
}
?>
