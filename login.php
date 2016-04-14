<?php
session_destroy();
session_start();

include 'connect.php';

// checking the user
if (isset($_POST['LOGIN'])) {

    $user = mysqli_real_escape_string($con, $_POST["username"]);

    $pass = mysqli_real_escape_string($con, $_POST["password"]);

    $usertype = mysqli_real_escape_string($con, $_POST["usertype"]);

    $sel_user = "";

    if ($usertype == "admin_user") {
        $sel_user = "select * from admin where adminLogin='$user' AND adminPass='$pass'";
    } elseif ($usertype == "gc_user") {
        $sel_user = "select * from gcmember where gcLogin='$user' AND gcPass='$pass'";
    } else {
        $sel_user = "select * from gtanominator where nominatorLogin='$user' AND nominatorPass='$pass'";
    }

    $run_user = mysqli_query($con, $sel_user);

    $check_user = mysqli_num_rows($run_user);

    if ($check_user > 0) {

        $sel_session = "select sessionid from session where currentlyActive=TRUE";
        $run_session = mysqli_query($con, $sel_session);

        $data = $run_session->fetch_array();
        $_SESSION['sessionid'] = (string)$data['sessionid'];


        $_SESSION['user'] = $user;
        $_SESSION['usertype'] = $usertype;


        if ($usertype == "nominator_user") {
            header("Location:Nominator.html");
        } elseif ($usertype == "gc_user") {
            header("Location:GCMember.html");
        } else {
            header("Location:SystemAdmin.html");
        }

    } else {

        echo 'Invalid Login';

    }

}
?>
