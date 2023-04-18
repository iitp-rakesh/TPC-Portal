<?php
// Connect to the database
include 'dp.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Company Home Page</title>
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
            margin-top: 50px;
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

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="companyhomepage.php">Home</a>
        <a href="company_addjob.php">Add Job</a>
        <a href="jobs_offered.php">Jobs Offered</a>
        <form method="post" action="updatepassword.php">
            <input type="text" hidden name="admin" value="admin">
            <?php
            $_SESSION['page'] = "company_credentials";
            $email = $_SESSION['email'];
            $_SESSION['email'] = "$email";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h1>Applied Students</h1>
    <div id="search">
        <input type="text" placeholder="Student Name" onkeyup="filterTable(0, 'student-applied')">
        <input type="text" placeholder="Email" onkeyup="filterTable(1, 'student-applied')">
        <input type="text" placeholder="Mobile" onkeyup="filterTable(2, 'student-applied')">
        <input type="text" placeholder="Specialisation" onkeyup="filterTable(3, 'student-applied')">
        <input type="text" placeholder="Role" onkeyup="filterTable(4, 'student-applied')">
        <input type="text" placeholder="CPI" onkeyup="filterTable(5, 'student-applied')">
        <input type="text" placeholder="10th Percentage" onkeyup="filterTable(6, 'student-applied')">
        <input type="text" placeholder="12th Percentage" onkeyup="filterTable(7, 'student-applied')">
        <input type="text" placeholder="Semester" onkeyup="filterTable(8, 'student-applied')">
        <input type="text" placeholder="Batch Year" onkeyup="filterTable(9, 'student-applied')">
    </div>
    <table id="student-applied">
        <thead>
            <tr>
                <th onclick="sortTable(0, 'student-applied')">Student Name</th>
                <th onclick="sortTable(1, 'student-applied')">Email</th>
                <th onclick="sortTable(2, 'student-applied')">Mobile</th>
                <th onclick="sortTable(3, 'student-applied')">Specialisation</th>
                <th onclick="sortTable(4, 'student-applied')">Role</th>
                <th onclick="sortTable(5, 'student-applied')">CPI</th>
                <th onclick="sortTable(6, 'student-applied')">10th Percentage</th>
                <th onclick="sortTable(7, 'student-applied')">12th Percentage</th>
                <th onclick="sortTable(8, 'student-applied')">Semester</th>
                <th onclick="sortTable(9, 'student-applied')">Batch Year</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Get the company email from the session
            $email = $_SESSION['email'];
            $_SESSION['email'] = $email;
            $sql = "SELECT * FROM company_credentials WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $company_name = $row['name'];
            $id = $row['company_id'];
            $query = "SELECT * FROM student_applied WHERE company_id = $id";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                $student_id = $row['student_id'];
                $job_id = $row['job_id'];
                $job_details_query = "SELECT roles FROM company WHERE jobid=$job_id";
                $job_details_result = $conn->query($job_details_query);
                $job_details = $job_details_result->fetch_assoc();

                $student_info_query = "SELECT * FROM students WHERE id='$student_id'";
                $student_info_result = $conn->query($student_info_query);
                $student_info = $student_info_result->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $student_info['name']; ?></td>
                    <td><?php echo $student_info['email']; ?></td>
                    <td><?php echo $student_info['Mobile']; ?></td>
                    <td><?php echo $student_info['specialisation']; ?></td>
                    <td><?php echo $job_details['roles']; ?></td>
                    <td><?php echo $student_info['CPI']; ?></td>
                    <td><?php echo $student_info['percentage10']; ?></td>
                    <td><?php echo $student_info['percentage12']; ?></td>
                    <td><?php echo $student_info['semester']; ?></td>
                    <td><?php echo $student_info['year']; ?></td>
                    <!-- // form for select button -->
                    <td>
                        <form action="select_student.php" method="POST">
                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                            <input type="hidden" name="company_id" value="<?php echo $id; ?>">
                            <input type="submit" name="select" value="Select">
                        </form>

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