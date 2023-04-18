<!DOCTYPE html>
<html>

<head>
    <title>Alumni List</title>
    <style>
        /* Reset default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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
            margin-top: 20px;
        }

        #search {
            display: flex;
            padding: 10px;
            justify-content: center;
            margin: 5px 10px;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="welcome_page.php">Home</a>
        <a href="student_info.php">Profile</a>
        <a href="alumni_list.php">Alumni</a>
        <a href="student_applied.php">Applied Jobs</a>
        <form method="post" action="updatepassword.php">
            <input type="text" hidden name="admin" value="admin">
            <?php 
             include 'dp.php';
            $_SESSION['page']="students";
            $email = $_SESSION['email'];
            $_SESSION['email']="$email";
            ?>
        <a href="updatepassword.php">Change Password</a></form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <?php
    // Connect to the database
   

    // Get the company ID from the session
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Get the list of applied students for this company
    $query = "SELECT * FROM alumni";
    $result = $conn->query($query);
    ?>
    <h1>Alumnui List</h1>
    <div id="search">
        <input type="text" placeholder="Student Name" onkeyup="filterTable(0, 'student-applied')">
        <input type="text" placeholder="Email" onkeyup="filterTable(1, 'student-applied')">
        <input type="text" placeholder="Company Name" onkeyup="filterTable(2, 'student-applied')">
        <input type="text" placeholder="CTC" onkeyup="filterTable(3, 'student-applied')">
        <input type="text" placeholder="Position" onkeyup="filterTable(4, 'student-applied')">
        <input type="text" placeholder="CPI" onkeyup="filterTable(5, 'student-applied')">
        <input type="text" placeholder="Area" onkeyup="filterTable(6, 'student-applied')">
        <input type="text" placeholder="Location" onkeyup="filterTable(7, 'student-applied')">
        <input type="text" placeholder="Location" onkeyup="filterTable(8, 'student-applied')">
    </div>
    <table id="student-applied">
        <thead>
            <tr>
                <th onclick="sortTable(0, 'student-applied')">Student Name</th>
                <th onclick="sortTable(1, 'student-applied')">Email</th>
                <th onclick="sortTable(2, 'student-applied')">Company Name</th>
                <th onclick="sortTable(3, 'student-applied')">CTC(in LPA)</th>
                <th onclick="sortTable(4, 'student-applied')">Position</th>
                <th onclick="sortTable(5, 'student-applied')">CPI</th>
                <th onclick="sortTable(6, 'student-applied')">Area</th>
                <th onclick="sortTable(7, 'student-applied')">Location</th>
                <th onclick="sortTable(8, 'student-applied')">Working Tenure</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['ctc']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['CPI']; ?></td>
                    <td><?php echo $row['area']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['working_tenure']; ?></td>

                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <?php
    // Close the database connection
    $conn->close();
    ?>
    <script>
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

        function filterTable(n, tableid) {
            console.log(n, tableid);
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementsByTagName("input")[n];
            filter = input.value.toUpperCase();
            table = document.getElementById(tableid);
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                console.log(i);
                td = tr[i].getElementsByTagName("td")[n];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>