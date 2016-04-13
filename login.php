<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "dbproject");

if (mysqli_connect_errno()) {

    echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

// checking the user
if (isset($_POST['LOGIN'])) {

    $user = mysqli_real_escape_string($con, $_POST["username"]);

    $pass = mysqli_real_escape_string($con, $_POST["password"]);

    $usertype = mysqli_real_escape_string($con, $_POST["usertype"]);

    $sel_user = "";

    if ($usertype == "nominator_user") {
        $sel_user = "select * from gtanominator where nominatorLogin='$user'' AND nominatorPass='$pass'";
    } elseif ($usertype == "gc_user") {
        $sel_user = "select * from gcmember where gcLogin='$user' AND gcPass='$pass'";
    } else {
        $sel_user = "select * from admin where adminLogin='$user' AND adminPass='$pass'";
    }

    $run_user = mysqli_query($con, $sel_user);

    $check_user = mysqli_num_rows($run_user);

    if ($check_user > 0) {

        $sel_session = "select sessionid from session where currentlyActive=1";
        $run_session = mysqli_query($con, $sel_session);

        $_SESSION['user'] = $user;
        $_SESSION['usertype'] = $usertype;
        $_SESSION['sessionid'] = $run_session;

        if ($usertype == "nominator_user") {
            header("Location:Nominator.html");
        } elseif ($usertype == "gc_user") {
            header("Location:GCMember.html");
        } else {
            header("Location:SystemAdmin.html");
        }

    } else {

        echo 'no login';

    }

}
?>
