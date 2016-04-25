<?php
session_start();
include 'connect.php';

// checking the user
if (isset($_POST['addFaculty'])) {

    //Getting all the values set by the professor for the nomination 
    $facultyName = mysqli_real_escape_string($con, $_POST["facultyName"]);
    $facultyLogin = mysqli_real_escape_string($con, $_POST["facultyLogin"]);
    $facultyPass = mysqli_real_escape_string($con, $_POST["facultyPass"]);
    $facultyEmail = mysqli_real_escape_string($con, $_POST["facultyEmail"]);
    $facultyType = mysqli_real_escape_string($con, $_POST["facultyType"]);
    $sessionid = $_SESSION['sessionid'];

    //Admin is adding a gcchair to a session
    if ($facultyType == "gcchair") {
        $queryToExecute = "INSERT INTO gcchair (gcLogin, sessionid) VALUES ('$facultyLogin', '$sessionid'); INSERT INTO gcmember (gcName, gcEmail, gcLogin, gcPass) VALUES ('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass');INSERT INTO sessiongc (sessionid, gcLogin)VALUES('$sessionid', '$facultyLogin')";
    } //Admin is adding a gcmember
    else if ($facultyType == "gcmember") {
        $insertInto = "gcmember";
        $queryToExecute = "INSERT INTO gcmember (gcName, gcEmail, gcLogin, gcPass) 
			VALUES ('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass');
			INSERT INTO sessiongc (sessionid, gcLogin)
			VALUES('$sessionid', '$facultyLogin')";
    } //Admin is adding a professor
    else if ($facultyType == "professor") {
        $insertInto = "gtanominator";
        $queryToExecute = "INSERT INTO gtanominator (nominatorName, nominatorEmail, nominatorLogin, nominatorPass) VALUES ('$facultyName', '$facultyEmail', '$facultyLogin', '$facultyPass'); INSERT INTO sessionnominators (sessionid, gtaNominatorLogin) VALUES ('$sessionid', '$facultyLogin')";
    }

    $timestamp = date('y-m-d h:m:s');

    //Execute the query
    if ($queryToExecute != "") {
        $executeNomineeUpdate = mysqli_multi_query($con, $queryToExecute) or trigger_error("Query Failed! SQL: $queryToExecute - Error: ". mysqli_error($con), E_USER_ERROR);
    }
    //The system admin has just submitted the form, the form has been saved, and it should be cleared now

    $messagebody = urlencode ("Your account has been made. Username: $facultyLogin Password: $facultyPass");
	$subject = urlencode ("GTA Nomination Account");
    header("Location:sendmail.py?recipient=$facultyEmail&body=$messagebody&subject=$subject");

}
?>
