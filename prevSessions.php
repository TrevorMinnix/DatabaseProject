<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<style>
	.inv{
		display: none
	}
</style>
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
    <li>
        <input type="radio" name="tabs" id="tab3" checked/>
        <label for="tab3">Previous Sessions</label>
        <div id="tab-content3" class="tab-content" align="center">
		<select id="target">
            <option value="">Choose Session</option>
            <?php
				session_start();
				include 'connect.php';
			
				//old sessions to be displayed in drop down menu
				$sessionQuery = mysqli_query($con, "SELECT sessionid FROM session WHERE currentlyActive=0");
				while($oldSession = mysqli_fetch_array($sessionQuery))
				{
					echo "<option value='{$oldSession['sessionid']}'>{$oldSession['sessionid']}</option>";
				}
			?>
        </select>

        <div id="content_1" class="inv">Content 1</div>
        <div id="content_2" class="inv">Content 2</div>
        <div id="content_3" class="inv">Content 3</div>
		<?php
			//session table
			//reset fetch position
				mysqli_data_seek($sessionQuery, 0);
			while($oldSession = mysqli_fetch_array($sessionQuery))
			{
			//div for drop down menu
			echo "<div id='{$oldSession['sessionid']}' class='inv'>";
			
				//update average scores
			//get verified nominees
			$verifiedNomineesQuery = mysqli_query($con, "SELECT pid FROM nomination WHERE verified=1");
			//loop through nominees
			while($row4 = mysqli_fetch_array($verifiedNomineesQuery)){
				//get scores
				$nomineeScoresQuery = mysqli_query($con, "SELECT score FROM gcscoring WHERE pid='{$row4['pid']}' AND sessionid='{$oldSession['sessionid']}'");
				
				//compute average
				$sum = 0;
				$ct = 0;
				
				//if nominee has no scores
				if(mysqli_num_rows($nomineeScoresQuery) == 0)
				{
					mysqli_query($con, "UPDATE nomination SET averageScore='0' WHERE pid='{$row4['pid']}' AND sessionid='{$oldSession['sessionid']}'");
				}
				else{
					while($row5 = mysqli_fetch_array($nomineeScoresQuery)){
						$ct++;
						$sum = $sum + $row5['score'];
					}
					$average = $sum/$ct;
					
					mysqli_query($con, "UPDATE nomination SET averageScore='{$average}' WHERE pid='{$row4['pid']}' AND sessionid='{$oldSession['sessionid']}'");
				}
				
				
			}


			//get table data excluding gc scores
			//verified nominees only
            $table_data = mysqli_query($con, "SELECT nominatorName, nomineeName, ranking, newlyAdmitted, gtanominee.pid, averageScore FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid INNER JOIN gtanominator ON gtanominator.nominatorLogin=nomination.nominatorLogin WHERE sessionid=\"{$oldSession['sessionid']}\" AND verified=1 ORDER BY {$_SESSION['method']}");
			
			//get gc members in current session
			$gc_members = mysqli_query($con, "SELECT gcName, gcmember.gcLogin FROM gcmember INNER JOIN sessiongc ON gcmember.gcLogin=sessiongc.gcLogin WHERE sessionid=\"{$oldSession['sessionid']}\" ORDER BY gcName ASC");

			//build table
			echo '<h2>Verified Nominees</h2>';
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
				$nomineeURL = "nomineeInfo.php?pid=" . $row1['pid'] . "&sessionid=" . $oldSession['sessionid'];
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
			echo "</form>";
			
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
			$incompleteQuery = mysqli_query($con, "SELECT nomineeName, responded, verified, gtanominee.pid FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid WHERE sessionid='{$oldSession['sessionid']}' AND (responded=0 OR verified=0) ORDER BY nomineeName ASC");
			
			
			echo '<h2>Incomplete Nomination</h2>
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
				$nomineeURL = "nomineeInfo.php?pid=" . $incomplete['pid'] . "&sessionid=" . $oldSession['sessionid'];
				echo "<td>" . "<a href=\"{$nomineeURL}\" target=\"_blank\">" . $incomplete['nomineeName'] . "</a>" . "</td>";
				echo '<td>' . $reason . '</td></tr>';
			}
			}
			
			echo "</div>";
		?>

        <script>
            document
                .getElementById('target')
                .addEventListener('change', function () {
                    'use strict';
                    var vis = document.querySelector('.vis'),   
                        target = document.getElementById(this.value);
                    if (vis !== null) {
                        vis.className = 'inv';
                    }
                    if (target !== null ) {
                        target.className = 'vis';
                    }
            });
        </script>
			
            <?php
            mysqli_close($con);
            ?>
        </div>
    </li>
</ul>