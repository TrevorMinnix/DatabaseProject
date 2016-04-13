<?php
$con = mysqli_connect("localhost","root","", "dbproject");
if (mysqli_connect_errno())
{
echo "MySQLi Connection was not established: " . mysqli_connect_error();
}
// checking the user
if(isset($_POST['submitNomineeForm'])){
	
	//Getting all the values set by the professor for the nomination 
	$nomineeName = mysqli_real_escape_string($con,$_POST["nomineeName"]);
	$nomineeRank = mysqli_real_escape_string($con,$_POST["nomineeRank"]);
	$nomineePid = mysqli_real_escape_string($con,$_POST["nomineePid"]);	
	$nomineeEmail = mysqli_real_escape_string($con,$_POST["nomineeEmail"]);	
	$nomineePhone = mysqli_real_escape_string($con,$_POST["nomineePhone"]);
	$numberOfSem = mysqli_real_escape_string($con,$_POST["numberOfSem"]);
	$isNomineePassedSpeak = mysqli_real_escape_string($con,$_POST["isNomineePassedSpeak"]);
	$numberOfSemAsGTA = mysqli_real_escape_string($con,$_POST["numberOfSemAsGTA"]);
	$isNomineePhdStudent = mysqli_real_escape_string($con,$_POST["isNomineePhdStudent"]);	
	$isNomineeNewlyAdmitted = mysqli_real_escape_string($con,$_POST["isNomineeNewlyAdmitted"]);	
	$coursesCompleted = mysqli_real_escape_string($con,$_POST["coursesCompleted"]);
	$coursesGPA = mysqli_real_escape_string($con,$_POST["coursesGPA"]);
	$publications = mysqli_real_escape_string($con,$_POST["publications"]);
	$nominatorName = mysqli_real_escape_string($con,$_POST["nominatorName"]);
	$advisorName = mysqli_real_escape_string($con,$_POST["advisorName"]);
	
	
	$timestamp = date('y-m-d h:m:s');
	
	//Update the values for the nominee that just submitted his form
	$updateNominee = "UPDATE gtanominee 
		SET advisor='$advisorName', nomineePhone='$nomineePhone', semestersAsGrad='$numberOfSem',
			passedSpeak='$isNomineePassedSpeak', semestersAsGTA='$numberOfSemAsGTA', 
			gradCourses='$coursesCompleted', gpa='$coursesGPA', publications='$publications'
		WHERE pid='$nomineePid'";
	//Execute the query
	$executeNomineeUpdate = mysqli_query($con, $updateNominee);
	
	//Now the nominee has just filled out the form, an email needs to be sent to the nominator in the block below.
	
}
?>
