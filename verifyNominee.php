<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
    <li>
        <input type="radio" name="tabs" id="tab3" checked/>
        <label for="tab3">Nominee Info</label>
        <div id="tab-content3" class="tab-content" align="center">
            <?php
			session_start();
            include 'connect.php';

			//check if past deadline
			$deadlineQuery = mysqli_query($con, "SELECT nomineeVerificationDeadline FROM session WHERE sessionid='{$_SESSION['sessionid']}'");
			$deadlineResult = mysqli_fetch_array($deadlineQuery);
			
			if($deadlineResult['nomineeVerificationDeadline'] < date("Y-m-d H:i:s"))
			{
				echo "Past Verification Deadline!";
			}
			
			//get nominee info from database
			$nomineeQuery = mysqli_query($con, "SELECT * FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid WHERE gtanominee.pid='{$_GET['pid']}' AND sessionid='{$_SESSION['sessionid']}'");
			$nomineeInfo = mysqli_fetch_array($nomineeQuery);
			
			//information table
			echo "<table border='1'>
					<tr>
                    <th>Nominee</th>
                    <th>PID</th>
					<th>Email</th>
					<th>PHD Student</th>
					<th>Semesters As Grad</th>
					<th>Passed SPEAK</th>
					<th>Semesters As GTA</th>
					<th>Grad Courses</th>
					<th>GPA</th>
					<th>Publications</th>
					<th>New or Existing</th>
					<th>Verified</th>
					<th>Rank</th></tr>";
			echo "<td>" . $nomineeInfo['nomineeName'] . "</td>";
			echo "<td>" . $nomineeInfo['pid'] . "</td>";
			echo "<td>" . $nomineeInfo['nomineeEmail'] . "</td>";
			//echo "<td>" . $nomineeInfo['isPHDStudent'] . "</td>";
			if($nomineeInfo['isPHDStudent']){
				echo "<td>Yes</td>";
			}else{
				echo "<td>No</td>";
			}
			echo "<td>" . $nomineeInfo['semestersAsGrad'] . "</td>";
			//echo "<td>" . $nomineeInfo['passedSPEAK'] . "</td>";
			if($nomineeInfo['passedSpeak'] == 1){
				echo "<td>Yes</td>";
			}else if($nomineeInfo['passedSpeak'] == 2){
				echo "<td>Graduated from US Institution</td>";
			}else{
				echo "<td>No</td>";
			}
			echo "<td>" . $nomineeInfo['semestersAsGTA'] . "</td>";
			echo "<td>" . $nomineeInfo['gradCourses'] . "</td>";
			echo "<td>" . $nomineeInfo['gpa'] . "</td>";
			echo "<td>" . $nomineeInfo['publications'] . "</td>";
			//echo "<td>" . $nomineeInfo['newlyAdmitted'] . "</td>";
			if($nomineeInfo['newlyAdmitted']){
				echo "<td>New</td>";
			}else{
				echo "<td>Existing</td>";
			}
			//echo "<td>" . $nomineeInfo['verified'] . "</td>";
			if($nomineeInfo['verified']){
				echo "<td>Yes</td>";
			}else{
				echo "<td>No</td>";
			}
			echo "<td>" . $nomineeInfo['ranking'] . "</td>";
			
			echo '<br>
				<form action="" method="POST">
					<input type="submit" name="submit" value="Verify Nominee">
				</form>';
				
			if(isset($_POST['submit'])){
				$nomineeVerificationUpdate = mysqli_query($con, "UPDATE nomination SET verified=1 WHERE pid='{$_GET['pid']}' AND sessionid='{$_SESSION['sessionid']}'");
				
				header("Refresh:0");
			}
			
            mysqli_close($con);
            ?>
            </table>
        </div>
    </li>
</ul>
