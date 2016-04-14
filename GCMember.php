<link rel="stylesheet" type="text/css" href="DBHomeStyle.css">
<h1>GTAMS <span>GTA Management System</span></h1>
<ul class="tabs">
    <li>
        <input type="radio" name="tabs" id="tab3" checked/>
        <label for="tab3">GC Members</label>
        <div id="tab-content3" class="tab-content" align="center">
            <?php
            include 'connect.php';

            $result = mysqli_query($con, "SELECT * FROM gtanominee");

            echo "<table border='1'>
                    <tr>
                    <th>Name</th>
                    <th>NewAdmission</th>
                    </tr>";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['nomineeName'] . "</td>";
                echo "<td>" . $row['newlyAdmitted'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($con);
            ?>
            </table>
        </div>
    </li>
</ul>
