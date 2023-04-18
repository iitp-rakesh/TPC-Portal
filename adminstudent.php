<?php
include 'dp.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student and Company Tabs</title>
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

        /* Style search bar */
        .search form {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 4px;
        }

        .search input[type="text"] {
            width: 100%;
            padding: 8px 14px;
            margin: 6px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        .search button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search button:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="adminstudent.php">Student</a>
        <a href="admincompany.php">Company</a>
        <a href="adminalumni.php">Alumni</a>
        <form method="post" action="updatepassword.php">
            <input type="text" hidden name="admin" value="admin">
            <?php
            $_SESSION['page'] = "admin";
            $_SESSION['email'] = "admin";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <center>
        <h1>Admin Panel</h1><br>
    </center>
    <h2>Student Table</h2>

    <div class="search">
        <form method="post">
            <input type="text" placeholder="Student Name" onkeyup="filterTable(0, 'student_table')" name="student_name">
            <input type="text" placeholder="Email" onkeyup="filterTable(1, 'student_table')" name="email">
            <input type="text" placeholder="Age" onkeyup="filterTable(2, 'student_table')" name="age">
            <input type="text" placeholder="Mobile" onkeyup="filterTable(3, 'student_table')" name="mobile">
            <input type="text" placeholder="Specialisation" onkeyup="filterTable(4, 'student_table')" name="specialisation">
            <input type="text" placeholder="Semester" onkeyup="filterTable(5, 'student_table')" name="semester">
            <input type="text" placeholder="10th Percentage" onkeyup="filterTable(6, 'student_table')" name="tenth_percentage">
            <input type="text" placeholder="12th Percentage" onkeyup="filterTable(7, 'student_table')" name="twelfth_percentage">
            <input type="text" placeholder="CPI" onkeyup="filterTable(8, 'student_table')" name="cpi">
            <input type="text" placeholder="Batch Year" onkeyup="filterTable(9, 'student_table')" name="batch_year">
            <input type="text" placeholder="Placed" onkeyup="filterTable(10, 'student_table')" name="placed">
            <button class="search" type="submit" name="search_submit">Search</button>
        </form>
    </div>
    <?php

    // Query the database for student data
    $sql = "SELECT * FROM students";

    // If search button is clicked
    if (isset($_POST['search_submit'])) {
        $student_name = $_POST['student_name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $mobile = $_POST['mobile'];
        $specialisation = $_POST['specialisation'];
        $semester = $_POST['semester'];
        $tenth_percentage = $_POST['tenth_percentage'];
        $twelfth_percentage = $_POST['twelfth_percentage'];
        $cpi = $_POST['cpi'];
        $batch_year = $_POST['batch_year'];
        $placed = $_POST['placed'];

        $sql = "SELECT * FROM students WHERE name LIKE '%$student_name%' AND email LIKE '%$email%' AND age LIKE '%$age%' AND Mobile LIKE '%$mobile%' AND specialisation LIKE '%$specialisation%' AND semester LIKE '%$semester%' AND percentage10 LIKE '%$tenth_percentage%' AND percentage12 LIKE '%$twelfth_percentage%' AND CPI >= '$cpi' AND year LIKE '%$batch_year%' AND placed LIKE '%$placed%' ";
    }
    $result = mysqli_query($conn, $sql);

    // Display the student data in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table id='student_table'>";
        echo "<tr><th onclick=\"sortTable(0,'student_table')\">Name</th><th onclick=\"sortTable(1,'student_table')\">Email</th><th onclick=\"sortTable(2,'student_table')\">Age</th><th onclick=\"sortTable(3,'student_table')\">Mobile</th><th onclick=\"sortTable(4,'student_table')\">Specialisation</th><th onclick=\"sortTable(5,'student_table')\">Semester</th><th onclick=\"sortTable(6,'student_table')\">10th Percentage</th><th onclick=\"sortTable(7,'student_table')\">12th Percentage</th><th onclick=\"sortTable(8,'student_table')\">CPI</th><th onclick=\"sortTable(9,'student_table')\">Batch Year</th><th onclick=\"sortTable(10,'student_table')\">Placed</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['Mobile']; ?></td>
                <td><?php echo $row['specialisation']; ?></td>
                <td><?php echo $row['semester']; ?></td>

                <td><?php echo $row['percentage10']; ?></td>
                <td><?php echo $row['percentage12']; ?></td>
                <td><?php echo $row['CPI']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['placed']; ?></td>
            </tr>
    <?php
        }
        echo "</table>";
    } else {
        echo "No student data found.";
    }
    // Close the database connection
    mysqli_close($conn);
    ?>
    </div>
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