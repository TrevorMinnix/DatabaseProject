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

			//get pending nominee info from database
			$unresponsiveNomineeQuery = mysqli_query($con, "SELECT nomineeName, gtanominee.pid FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid WHERE sessionid='{$_SESSION['sessionid']}' AND responded=0 AND verified=0 AND nominatorLogin='{$_SESSION['user']}'");
			$verifiableNomineeQuery = mysqli_query($con, "SELECT nomineeName, gtanominee.pid FROM gtanominee INNER JOIN nomination ON gtanominee.pid=nomination.pid WHERE sessionid='{$_SESSION['sessionid']}' AND responded=1 AND verified=0 AND nominatorLogin='{$_SESSION['user']}'");
			
			//list unresponsive nominees
			echo '<h4 style="padding-bottom:15px;">Pending Response</h4>';
			
			while($nominee = mysqli_fetch_array($unresponsiveNomineeQuery)){
				echo "<a href='nomineeInfo.php?pid={$nominee['pid']}&sessionid={$_SESSION['sessionid']}' target='_blank'>";
				echo "{$nominee['nomineeName']}<br></a>";
			}
			
			echo '<br><h4 style="padding-bottom:15px;">Pending Verification</h4>';
			
			while($nominee = mysqli_fetch_array($verifiableNomineeQuery)){
				echo "<a href='verifyNominee.php?pid={$nominee['pid']}' target='_blank'>";
				echo "{$nominee['nomineeName']}</a><br>";
			}
			
            mysqli_close($con);
            ?>
            </table>
        </div>
    </li>
</ul>
