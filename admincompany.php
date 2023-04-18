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
            $_SESSION['page']="admin";
            $_SESSION['email']="admin";
            ?>
        <a href="updatepassword.php">Change Password</a></form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <center>
    <h1>Admin Panel</h1><br></center>
    <h2>Company Table</h2>
    <div class="search">
        <form method="post">
            <input type="text" placeholder="Company Name" onkeyup="filterTable(0, 'company_table')" name="company_name">
            <input type="text" placeholder="Role" onkeyup="filterTable(1, 'company_table')" name="role">
            <input type="text" placeholder="CTC" onkeyup="filterTable(2, 'company_table')" name="ctc">
            <input type="text" placeholder="CPI" onkeyup="filterTable(3, 'company_table')" name="cpi">
            <input type="text" placeholder="Interview Mode" onkeyup="filterTable(4, 'company_table')" name="interview_mode">
            <input type="text" placeholder="Interview Type" onkeyup="filterTable(5, 'company_table')" name="interview_type">
            <input type="text" placeholder="Year" onkeyup="filterTable(6, 'company_table')" name="year">
            <input type="submit" name="search_company" value="Search">
        </form>

    </div>
    <?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', 'Rakesh@9204', 'tpc');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the database for company data
    $sql = "SELECT * FROM company";
    if (isset($_POST['search_company'])) {
        $company_name = $_POST['company_name'];
        $role = $_POST['role'];
        $ctc = $_POST['ctc'];
        $cpi = $_POST['cpi'];
        $interview_mode = $_POST['interview_mode'];
        $interview_type = $_POST['interview_type'];
        $year = $_POST['year'];

        $sql = "SELECT * FROM company WHERE company_name LIKE '%$company_name%' AND roles LIKE '%$role%' AND ctc >= '$ctc' AND minimum_cpi >= '$cpi' AND interview_mode LIKE '%$interview_mode%' AND interview_type LIKE '%$interview_type%' AND recruitment_since_year LIKE '%$year%' ";
    }
    $result = mysqli_query($conn, $sql);

    // Display the company data in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table id='company_table'>";
        echo "<tr>
        <th onclick='sortTable(0,\"company_table\")'>Company Name</th>
        <th onclick='sortTable(1,\"company_table\")'>Role</th>
        <th onclick='sortTable(2,\"company_table\")'>CTC (in LPA)</th>
        <th onclick='sortTable(3,\"company_table\")'>Min. CPI</th>
        <th onclick='sortTable(4,\"company_table\")'>InterView Mode</th>
        <th onclick='sortTable(5,\"company_table\")'>Interview Type</th>
        <th onclick='sortTable(6,\"company_table\")'>Recruitment Since Year</th>
        </tr>";


        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $row["company_name"] . "</td>
                <td>" . $row["roles"] . "</td>
                <td>" . $row["ctc"] . "</td>
                <td>" . $row["minimum_cpi"] . "</td>
                <td>" . $row["interview_mode"] . "</td>
                <td>" . $row["interview_type"] . "</td>
                <td>" . $row["recruitment_since_year"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No company data found.";
    }
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