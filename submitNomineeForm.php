<?php
include 'connect.php';

// checking the user
if (isset($_POST['submitNomineeForm'])) {

    //Getting all the values set by the professor for the nomination
    $nomineeName = mysqli_real_escape_string($con, $_POST["nomineeName"]);
    $nomineeRank = mysqli_real_escape_string($con, $_POST["nomineeRank"]);
    $nomineePid = mysqli_real_escape_string($con, $_POST["nomineePid"]);
    $nomineeEmail = mysqli_real_escape_string($con, $_POST["nomineeEmail"]);
    $nomineePhone = mysqli_real_escape_string($con, $_POST["nomineePhone"]);
    $numberOfSem = mysqli_real_escape_string($con, $_POST["numberOfSem"]);
    $isNomineePassedSpeak = mysqli_real_escape_string($con, $_POST["isNomineePassedSpeak"]);
    $numberOfSemAsGTA = mysqli_real_escape_string($con, $_POST["numOfSemAsGTA"]);
    $isNomineePhdStudent = mysqli_real_escape_string($con, $_POST["isNomineePhdStudent"]);
    $isNomineeNewlyAdmitted = mysqli_real_escape_string($con, $_POST["isNomineeNewlyAdmitted"]);
    $coursesCompleted = mysqli_real_escape_string($con, $_POST["coursesCompleted"]);
    $coursesGPA = mysqli_real_escape_string($con, $_POST["coursesGPA"]);
    $publications = mysqli_real_escape_string($con, $_POST["publications"]);
    $nominatorName = mysqli_real_escape_string($con, $_POST["nominatorName"]);
    $advisorName = mysqli_real_escape_string($con, $_POST["advisorName"]);


    $timestamp = date('y-m-d h:m:s');

    //Update the values for the nominee that just submitted his form
    $updateNominee = "INSERT INTO gtanominee 	(advisor, newlyAdmitted, nomineeName, nomineeEmail, isPHDStudent, nomineePhone, semestersAsGrad, passedSpeak, semestersAsGTA, gradCourses, gpa, publications, pid)
								VALUES 			('$advisorName', $isNomineeNewlyAdmitted , '$nomineeName' , '$nomineeEmail' , $isNomineePhdStudent , '$nomineePhone',$numberOfSemAsGTA,$isNomineePassedSpeak,$numberOfSemAsGTA,'$coursesCompleted',$coursesGPA, '$publications', '$nomineePid');";
    //Execute the query
    $executeNomineeUpdate = mysqli_query($con, $updateNominee) or trigger_error("Query Failed! SQL: $updateNominee - Error: " . mysqli_error($con), E_USER_ERROR);

    //Now the nominee has just filled out the form, an email needs to be sent to the nominator in the block below.

}
?>
