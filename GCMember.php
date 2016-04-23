<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
    <li>
        <input type="radio" name="tabs" id="tab3" checked/>
        <label for="tab3">GC Members</label>
        <div id="tab-content3" class="tab-content" align="center">
            <?php
			session_start();
            include 'connect.php';


			//get table data excluding gc scores
            $table_data = mysqli_query($con, "SELECT nominatorName, nomineeName, ranking, newlyAdmitted, gtanominee.pid FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid INNER JOIN gtanominator ON gtanominator.nominatorLogin=nomination.nominatorLogin WHERE sessionid=\"{$_SESSION['sessionid']}\" ORDER BY nominatorName ASC, ranking ASC");
			
			//get gc members in current session
			$gc_members = mysqli_query($con, "SELECT gcName, gcmember.gcLogin FROM gcmember INNER JOIN sessiongc ON gcmember.gcLogin=sessiongc.gcLogin WHERE sessionid=\"{$_SESSION['sessionid']}\" ORDER BY gcName ASC");

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
                //echo "<td>" . $row1['nomineeName'] . "</td>";	//TODO: add popup with nominee information
				$nomineeURL = "nomineeInfo.php?pid=" . $row1['pid'];
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
						$sum = $sum + $row3['score'];
						$ct++;
						echo "<td>" . $row3['score'] . "</td>";
						echo "<td>" . $row3['comment'] . "</td>";
					}
					//else if user's cells is empty, allow score and comment input in cells owned by logged in user
					else if($_SESSION["user"] == $row2['gcLogin'])
					{
						echo"<td>field here</td><td>field here</td>";	//TODO: add fields to update scores in table
					}
					//else leave cells empty
					else{
						echo "<td></td><td></td>";
					}
				}
				//average
				if($ct != 0){
					$average = $sum/$ct;
				}
				else{
					$average = 0;
				}
				
				echo "<td>" . $average . "</td>";
                echo "</tr>";
            }
            echo "</table>";

			//TODO: add submit button for scoring changes
			
            mysqli_close($con);
            ?>
            </table>
        </div>
    </li>
</ul>
