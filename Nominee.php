<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
    <li style="text-align:center;">
        <input type="radio" name="tabs" id="tab2" checked/>
        <label for="tab2">Nominee</label>
        <div id="tab-content2" class="tab-content">
		<?php
		session_start();
		include 'connect.php';
		
		//check if past deadline
		$deadlineQuery = mysqli_query($con, "SELECT nomineeResponseDeadline FROM session WHERE sessionid='{$_SESSION['sessionid']}'");
		$deadlineResult = mysqli_fetch_array($deadlineQuery);
		
		if($deadlineResult['nomineeResponseDeadline'] < date("Y-m-d H:i:s"))
		{
			echo "Past Nominee Response Deadline!";
		}
		mysqli_close($con);
		?>
            <form action="submitNomineeForm.php" method="POST">
                <div style="width:50%; float:left;">
                    <!-- <p style="padding-bottom:15px;">
                        <input type="text" name="nomineeName" placeholder="Name" id="nominee2name" value=""
                               style="height:40px;width:400px;">
                    </p> -->
                    <!-- <p style="padding-bottom:15px;">
                        <input type="text" name="nomineePid" placeholder="PID" id="nominee2pid" value=""
                               style="height:40px;width:400px;">
                    </p> -->
                    <!-- <p style="padding-bottom:15px;">
                        <input type="text" name="nomineeEmail" placeholder="Email" id="nominee2email" value=""
                               style="height:40px;width:400px;">
                    </p> -->
                    <p style="padding-bottom:15px;">
                        <input type="text" name="nomineePhone" placeholder="Phone Number" id="nominee2phone" value=""
                               style="height:40px;width:400px;">
                    </p>
                    <!-- <p style="padding-bottom:15px;">
                        <select name="isNomineePhdStudent" style="height:40px;width:400px;">
                            <option selected disabled>Are you currently a PhD CS student?</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </p> -->
                    <!-- <p style="padding-bottom:15px;">
                        <select name="isNomineeNewlyAdmitted" style="height:40px;width:400px;">
                            <option selected disabled>Are you newly admitted?</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </p> -->
                    <p style="padding-bottom:15px;">
                        <input type="number" name="numberOfSem" min="0"
                               placeholder="Number of semesters as a graduate student" id="nominee2semesters" value=""
                               style="height:40px;width:400px;">
                    </p>
                    <!-- <p style="padding-bottom:15px;">
                        <input type="number" name="nomineeRank" min="0"
                               placeholder="What is your rank?" id="nominee2semesters" value=""
                               style="height:40px;width:400px;">
                    </p> -->
                    <p style="padding-bottom:15px;">
                        <select name="isNomineePassedSpeak" style="height:40px;width:400px;">
                            <option selected disabled>Have you passed the SPEAK Test?</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            <option value="2">Graduated from a US institution</option>
                        </select>
                    </p>

                    <p style="padding-bottom:15px;">
                        <input type="number" name="numOfSemAsGTA" min="0"
                               placeholder="Number of semesters as a GTA (including summers)" id="nominee2semestersgta"
                               value="" style="height:40px;width:400px;">
                    </p>

                </div>
                <div style="width:50%; float:right;">
                    <p style="padding-bottom:15px;">
                        <textarea name="coursesCompleted"
                                  placeholder="List of graduate-level courses completed, and the letter grade"
                                  id="nominee2coursesgrades" value="" style="height:60px; width:400px;"></textarea>
                    </p>
                    <p style="padding-bottom:15px;">
                        <input type="number" name="coursesGPA" min="0" placeholder="GPA for above courses"
                               id="nominee2coursesgpa" value="" style="height:40px;width:400px;">
                    </p>
                    <p style="padding-bottom:15px;">
                        <textarea name="publications"
                                  placeholder="List of publications - Please provide citations for each publication"
                                  id="listofpublications" value="" style="height:60px; width:400px;"></textarea>
                    </p>
                    <!-- <p style="padding-bottom:15px;">
                        <input type="text" name="nominatorName" placeholder="Nominator Name" id="nominator2name"
                               value="" style="height:40px;width:400px;">
                    </p> -->
                    <p style="padding-bottom:15px;">
                        <input type="text" name="advisorName" placeholder="Name of current PhD advisor"
                               id="currentphdadvisor" value="" style="height:40px;width:400px;">
                    </p>

                    <p style="padding-bottom:15px;">
                        <textarea name="previousAdvisors" placeholder="Name and time period of previous PhD advisors"
                                  id="previousadvisors" value="" style="height:60px; width:400px;"></textarea>
                    </p>
                </div>
                <div style="padding-top:450px;">
                    <p style="padding-bottom:15px;">
                        <input name="submitNomineeForm" type="submit"
                               style="height:40px;width:400px; color:white; background:black; border:0px;"></input>
                    </p>
                </div>
            </form>
        </div>
    </li>
</ul>
