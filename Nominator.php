<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<script>
	function newSession() {
		document.location.href = "pendingNominees.php";
	}
</script>
<h1>GTAMS <span>GTA Management System</span></h1>
<?php
	//check if user is part of current session
	session_start();
	include 'connect.php';
	
	$sessionNominatorQuery = mysqli_query($con, "SELECT gtaNominatorLogin FROM sessionnominators WHERE sessionid='{$_SESSION['sessionid']}' AND gtaNominatorLogin='{$_SESSION['user']}'");
	$sessionNominator = mysqli_fetch_array($sessionNominatorQuery);
	
	if(!$sessionNominator) :
?>
Nominator not in current session.
<?php else : ?>
<ul class="tabs">
	<div style="float:right;">
		<button onClick="newSession()" style="cursor: pointer; height:50px;width:150px;color:white; background:black; border:0px;">Pending Nominees</button>
	</div>
    <li style="text-align:center;">
        <input type="radio" name="tabs" id="tab1" checked />
        <label for="tab1">Nominator</label>
        <div id="tab-content1" class="tab-content">
		<?php
		
		
		//check if past deadline
		$deadlineQuery = mysqli_query($con, "SELECT nominationDeadline FROM session WHERE sessionid='{$_SESSION['sessionid']}'");
		$deadlineResult = mysqli_fetch_array($deadlineQuery);
		
		if($deadlineResult['nominationDeadline'] < date("Y-m-d H:i:s"))
		{
			echo "Past Nomination Deadline!";
		}
		mysqli_close($con);
		?>
			<form action="submitNominatorForm.php" method="POST">
			
				<h4 style="padding-bottom:15px;">Nomination Form</h4>
			<!-- <p style="padding-bottom:15px;">
				<input required type="text" placeholder="Name" name="nominatorName" id="nominator1name" value=""style="height:40px;width:400px;">				
			</p>
			<p style="padding-bottom:15px;">
				<input required type="email" placeholder="Email" name="nominatorEmail" id="nominator1email" value=""style="height:40px;width:400px;">
			</p> -->
			
			<p style="padding-bottom:15px;">
				<input required type="text" placeholder="Nominee Name" name="nomineeName" id="nominee1name" value=""style="height:40px;width:400px;">
			</p>
			<p style="padding-bottom:15px;">
				<input required type="text" placeholder="Nominee Ranking" name="nomineeRank" id="nominee1ranking" value=""style="height:40px;width:400px;">
			</p>
			<p style="padding-bottom:15px;">
				<input required type="text" placeholder="Nominee PID" name="nomineePid" id="nominee1pid" value=""style="height:40px;width:400px;">
			</p>
			<p style="padding-bottom:15px;">
				<input required type="email" placeholder="Nominee Email" name="nomineeEmail" id="nominee1email" value=""style="height:40px;width:400px;">
			</p>
			<p style="padding-bottom:15px;">
				<select required name="isNomineePhdStudent" style="height:40px;width:400px;">
					<option selected disabled>Is student currently a PhD CS student?</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</p>
			<p style="padding-bottom:15px;">
				<select required name="isNomineeNewlyAdmitted" style="height:40px;width:400px;">
					<option selected disabled>Is student a newly admitted PhD student?</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</p>
			<p style="padding-bottom:15px;">
				<input required type="submit" name="submitNomination" style="height:40px;width:400px;color:white; background:black; border:0px;"></input>
			</p>
			</form>
		</div>
    </li>
 <?php endif; ?>