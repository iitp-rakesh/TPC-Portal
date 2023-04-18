<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student and Company Tabs</title>
    <style>
        .navbar {
            overflow: hidden;
            background-color: #333;
            font-family: Arial, sans-serif;
        }

        .navbar a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.logout {
            float: right;
        }

        /* Style the tab buttons */
        .tab {
            display: inline-block;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            border-radius: 4px 4px 0 0;
            padding: 10px 20px;
            cursor: pointer;
            user-select: none;
        }

        /* Style the active tab button */
        .tab.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 0 0 4px 4px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        th.asc:after,
        th.desc:after {
            content: " ";
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
        }

        th.asc:after {
            border-bottom: 5px solid white;
        }

        th.desc:after {
            border-top: 5px solid white;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="alumnihomepage.php">Home</a>
        <form method="post" action="updatepassword.php">
            <input type="text" hidden name="admin" value="admin">
            <?php
              include 'dp.php';
            $_SESSION['page'] = "alumni";
            $email = $_SESSION['email'];
            $_SESSION['email'] = "$email";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h1>Student and Company Tabs</h1>

    <!-- Tab buttons -->
    <div>
        <button class="tab active" onclick="openTab(event, 'student')">Student</button>
        <button class="tab" onclick="openTab(event, 'company')">Company</button>
    </div>

    <!-- Student tab content -->
    <div id="student" class="tabcontent" style="display: block;">
        <h2>Student Table</h2>
        <?php
      
        // Query the database for student data
        $sql = "SELECT * FROM students";
        $result = mysqli_query($conn, $sql);

        // Display the student data in a table
        if (mysqli_num_rows($result) > 0) {
            echo "<table id='student_table'>";
            echo "<tr><th onclick=\"sortTable(0,'student_table')\">Name</th><th onclick=\"sortTable(1,'student_table')\">CPI</th><th onclick=\"sortTable(2,'student_table')\">Specialisation</th><th onclick=\"sortTable(3,'student_table')\">Placed</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["CPI"] . "</td><td>" . $row["specialisation"] . "</td><td>" . $row["placed"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No student data found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    <!-- Company tab content -->
    <div id="company" class="tabcontent">
        <h2>Company Table</h2>
        <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', 'Rakesh@9204', 'tpc');
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query the database for company data
        $sql = "SELECT * FROM company";
        $result = mysqli_query($conn, $sql);

        // Display the company data in a table
        if (mysqli_num_rows($result) > 0) {
            echo "<table id='company_table'>";
            echo "<tr>
        <th onclick='sortTable(0,\"company_table\")'>Company Name</th>
        <th onclick='sortTable(1,\"company_table\")'>Role</th>
        <th onclick='sortTable(2,\"company_table\")'>CTC (in LPA)</th>
        <th onclick='sortTable(3,\"company_table\")'>Min. CPI</th></tr>";


            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["company_name"] . "</td><td>" . $row["roles"] . "</td><td>" . $row["ctc"] . "</td><td>" . $row["minimum_cpi"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No company data found.";
        }


        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    <!-- Script to switch between tabs -->
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tab content
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Deactivate all tab buttons
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the clicked tab content and activate the clicked tab button
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function sortTable(n, tableid) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById(tableid);
            switching = true;
            dir = "asc"; // Set the sorting direction to ascending

            // Remove arrow from all other headers
            var headers = table.getElementsByTagName("th");
            for (i = 0; i < headers.length; i++) {
                if (i != n) {
                    headers[i].classList.remove("asc", "desc");
                }
            }

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }

            // Add arrow to clicked header
            var header = headers[n];
            if (dir == "asc") {
                header.classList.remove("desc");
                header.classList.add("asc");
            } else if (dir == "desc") {
                header.classList.remove("asc");
                header.classList.add("desc");
            }
        }
    </script>
</body>

</html>