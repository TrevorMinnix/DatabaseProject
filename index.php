<?php
include("config.php");

?>
<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<body>

<div id="form-main">
    <div id="form-div">
        <form class="form" id="form1" action="login.php" method="POST">

            <p class="username">
                <input name="username" type="text" class="validate[required] feedback-input" placeholder="Username" id="username" />
            </p>

            <p class="password">
                <input name="password" type="text" class="validate[required] feedback-input" id="password" placeholder="Password" />
            </p>

            <p class="usertype">
                <select name="usertype" class="validate[required]  feedback-input" id="usertype" placeholder="User Type">
                    <option value="nominator_user">Nominator</option>
                    <option value="gc_user">GC Member</option>
                    <option value="admin_user">Admin</option>
                </select>
            </p>


            <div class="submit">
                <input type="submit" value="LOGIN" id="LOGIN" name="LOGIN" />
                <div class="ease"></div>
            </div>
        </form>
    </div>

</body>

