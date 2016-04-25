<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<script>
	function newSession() {
		document.location.href = "prevSessions.php";
	}
</script>
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
	<div style="float:right;">
		<button onClick="newSession()" style="cursor: pointer; height:50px;width:150px;color:white; background:black; border:0px;">Previous Sessions</button>
	</div>
    <li>
        <input type="radio" name="tabs" id="tab3" checked/>
        <label for="tab3">GC Members</label>
        <div id="tab-content3" class="tab-content" align="center">
            <?php
			session_start();
            include 'connect.php';
			
			//update average scores
			//get verified nominees
			$verifiedNomineesQuery = mysqli_query($con, "SELECT pid FROM nomination WHERE verified=1");
			//loop through nominees
			while($row4 = mysqli_fetch_array($verifiedNomineesQuery)){
				//get scores
				$nomineeScoresQuery = mysqli_query($con, "SELECT score FROM gcscoring WHERE pid='{$row4['pid']}' AND sessionid='{$_SESSION['sessionid']}'");
				
				//compute average
				$sum = 0;
				$ct = 0;
				
				//if nominee has no scores
				if(mysqli_num_rows($nomineeScoresQuery) == 0)
				{
					mysqli_query($con, "UPDATE nomination SET averageScore='0' WHERE pid='{$row4['pid']}' AND sessionid='{$_SESSION['sessionid']}'");
				}
				else{
					while($row5 = mysqli_fetch_array($nomineeScoresQuery)){
						$ct++;
						$sum = $sum + $row5['score'];
					}
					$average = $sum/$ct;
					
					mysqli_query($con, "UPDATE nomination SET averageScore='{$average}' WHERE pid='{$row4['pid']}' AND sessionid='{$_SESSION['sessionid']}'");
				}
				
				
			}


			//get table data excluding gc scores
			//verified nominees only
            $table_data = mysqli_query($con, "SELECT nominatorName, nomineeName, ranking, newlyAdmitted, gtanominee.pid, averageScore FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid INNER JOIN gtanominator ON gtanominator.nominatorLogin=nomination.nominatorLogin WHERE sessionid=\"{$_SESSION['sessionid']}\" AND verified=1 ORDER BY {$_SESSION['method']}");
			
			//get gc members in current session
			$gc_members = mysqli_query($con, "SELECT gcName, gcmember.gcLogin FROM gcmember INNER JOIN sessiongc ON gcmember.gcLogin=sessiongc.gcLogin WHERE sessionid=\"{$_SESSION['sessionid']}\" ORDER BY gcName ASC");

			//build table
			echo '<h4 style="padding-bottom:15px;">Verified Nominees</h4>';
			echo '<form action="" method="POST">';
			echo '<br><input type="submit" name = methodRank value="Sort by Ranking">';
			echo '<input type="submit" name = methodAverage value="Sort by Average Score">';
            echo "<table border='1'>
                    <tr>
                    <th>Nominator</th>
                    <th>Nominee</th>
					<th>Ranking</th>
					<th>Existing or New</th>";
            //add headers for each gc member in session
			while($row = mysqli_fetch_array($gc_members)){
				echo "<th>" . $row['gcName'] . "</th>";
				echo "<th>Comment</th>";
			}
			echo "<th>Average</th>";
			echo "</tr>";

            while ($row1 = mysqli_fetch_array($table_data)) {
				$sum = 0;
				$ct = 0;
                echo "<tr>";
                echo "<td>" . $row1['nominatorName'] . "</td>";
                //echo "<td>" . $row1['nomineeName'] . "</td>";	
				//popup with nominee information
				$nomineeURL = "nomineeInfo.php?pid=" . $row1['pid'] . "&sessionid=" . $_SESSION['sessionid'];
				echo "<td>" . "<a href=\"{$nomineeURL}\" target=\"_blank\">" . $row1['nomineeName'] . "</a>" . "</td>";
				echo "<td>" . $row1['ranking'] . "</td>";
				//replace newlyAdmitted int
				if($row1['newlyAdmitted'] == 1){
					echo "<td>New</td>";
				}
				else{
					echo "<td>Existing</td>";
				}
				
				//reset fetch position
				mysqli_data_seek($gc_members, 0);
				//loop through each gc member for each nominee
				while($row2 = mysqli_fetch_array($gc_members))
				{
					//if there is a score for that gc member and nominee, print
					$score = mysqli_query($con, "SELECT score, comment FROM gcscoring WHERE gcLogin='{$row2['gcLogin']}' AND pid='{$row1['pid']}'");
					if(mysqli_num_rows($score) == 1){
						$row3 = mysqli_fetch_array($score);
						//$sum = $sum + $row3['score'];
						//$ct++;
						echo "<td>" . $row3['score'] . "</td>";
						echo "<td>" . $row3['comment'] . "</td>";
					}
					//else if user's cells is empty, allow score and comment input in cells owned by logged in user
					else if($_SESSION["user"] == $row2['gcLogin'])
					{
						//inputs labeled as score or comment cocatenated with pid
						echo'<td><input type="text" name="s' . $row1['pid'] . '" placeholder="Score"></td><td><input type="text" name="c' . $row1['pid'] . '" placeholder="Comment"></td>';
					}
					//else leave cells empty
					else{
						echo "<td></td><td></td>";
					}
				}
				/* //average
				if($ct != 0){
					//$average = $sum/$ct;
				}
				else{
					$average = 0;
				} */
				//average
				
				echo "<td>" . round($row1['averageScore'], 2) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
			//submit button
			echo '<input type="submit" name="button" value="Submit Scores">';
			echo "</form>";
			
			//submit button behavior
			if(isset($_POST['button'])){
				foreach($_POST as $Field=>$Value){
					if($Value != ""){
						if($Field[0] === 's'){
						$scorePid = substr($Field, 1);
						mysqli_query($con, "INSERT INTO gcscoring (gcLogin, pid, sessionid, score) VALUES ('{$_SESSION['user']}', '$scorePid', '{$_SESSION['sessionid']}', '$Value')");
						}
						else if($Field[0] === 'c'){
							mysqli_query($con, "UPDATE gcscoring SET comment='$Value' WHERE pid='$scorePid' AND gcLogin='{$_SESSION['user']}' AND sessionid='{$_SESSION['sessionid']}'");
						}
					}
					
					header("Refresh:0");
				}
			}
			
			//sorting button behavior
			if(isset($_POST['methodRank'])){
				$_SESSION['method'] = "nominatorName ASC, ranking ASC";
				header("Refresh:0");
			}
			else if(isset($_POST['methodAverage'])){
				$_SESSION['method'] = "averageScore DESC";
				header("Refresh:0");
			}
			
			//unverified or unresponding nominees
			$incompleteQuery = mysqli_query($con, "SELECT nomineeName, responded, verified, gtanominee.pid FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid WHERE sessionid='{$_SESSION['sessionid']}' AND (responded=0 OR verified=0) ORDER BY nomineeName ASC");
			
			
			echo '<h4 style="padding-bottom:15px;">Incomplete Nomination</h4>
				<table border="1">
					<th>Nominee</th>
					<th>Reason</th>
					</tr>';
					
			//loop through nominees
			while($incomplete = mysqli_fetch_array($incompleteQuery)){
				$reason = "Failed to respond";
				if($incomplete['responded']){
					$reason = "Unverified";
				}
				$nomineeURL = "nomineeInfo.php?pid=" . $incomplete['pid'] . "&sessionid=" . $_SESSION['sessionid'];
				echo "<td>" . "<a href=\"{$nomineeURL}\" target=\"_blank\">" . $incomplete['nomineeName'] . "</a>" . "</td>";
				echo '<td>' . $reason . '</td></tr>';
			}
					
			//TODO: add submit button for scoring changes
			
            mysqli_close($con);
            ?>
            </table>
        </div>
    </li>
</ul>
