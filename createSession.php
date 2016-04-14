<?php
session_start();
include 'connect.php';

// checking the user
if (isset($_POST['addSession'])) {

    //Getting all the values set by the professor for the nomination 
    $sessionSemester = mysqli_real_escape_string($con, $_POST["sessionSemester"]);
    $sessionYear = mysqli_real_escape_string($con, $_POST["sessionYear"]);
    $nominationDeadline = mysqli_real_escape_string($con, $_POST["nominationDeadline"]);
    $nomineeResponseDeadline = mysqli_real_escape_string($con, $_POST["nomineeResponseDeadline"]);
    $nomineeVerificationDeadline = mysqli_real_escape_string($con, $_POST["nomineeVerificationDeadline"]);

    $timestamp = date('y-m-d h:m:s');

    //Need to create session in DB based on values above
    //This new session is also now active

    $queryToExecute1 = "UPDATE session SET currentlyActive = FALSE WHERE currentlyActive = TRUE;";

    $queryToExecute2 = "INSERT INTO session (currentlyActive, nominationDeadline, nomineeResponseDeadline, nomineeVerificationDeadline, sessionid) VALUES (TRUE, '$nominationDeadline', '$nomineeResponseDeadline', '$nomineeVerificationDeadline', '$sessionSemester$sessionYear'); ";

    $execute1 = mysqli_query($con, $queryToExecute1) or trigger_error("Query Failed! SQL: $queryToExecute1 - Error: ". mysqli_error($con), E_USER_ERROR);
    $execute2 = mysqli_query($con, $queryToExecute2) or trigger_error("Query Failed! SQL: $queryToExecute1 - Error: ". mysqli_error($con), E_USER_ERROR);

    $_SESSION['sessionid'] = "$sessionSemester$sessionYear";

    //echo "$queryToExecute1, $queryToExecute2";
    header("Location:SystemAdmin.html");

}
