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
        <h2>Alumni Table</h2>
        <div class="search">
            <form method="post">
                <input type="text" placeholder="Name" onkeyup="filterTable(0, 'alumni_table')" name="alumni_name">
                <input type="text" placeholder="CPI" onkeyup="filterTable(1, 'alumni_table')" name="cpi">
                <input type="text" placeholder="Company Name" onkeyup="filterTable(2, 'alumni_table')" name="company_name">
                <input type="text" placeholder="CTC" onkeyup="filterTable(3, 'alumni_table')" name="ctc">
                <input type="text" placeholder="Area" onkeyup="filterTable(4, 'alumni_table')" name="area">
                <input type="text" placeholder="Position" onkeyup="filterTable(5, 'alumni_table')" name="position">
                <input type="text" placeholder="Location" onkeyup="filterTable(6, 'alumni_table')" name="location">
                <input type="text" placeholder="Working Tenure" onkeyup="filterTable(7, 'alumni_table')" name="working_tenure">
                <button class="search" type="submit" name="search_submit">Search</button>
            </form>
        </div>
        <?php
        // Query the database for student data
        $sql = "SELECT * FROM alumni";
        if (isset($_POST['search_submit'])) {
            $alumni_name = $_POST['alumni_name'];
            $cpi = $_POST['cpi'];
            $company_name = $_POST['company_name'];
            $ctc = $_POST['ctc'];
            $area = $_POST['area'];
            $position = $_POST['position'];
            $location = $_POST['location'];
            $working_tenure = $_POST['working_tenure'];

            $sql = "SELECT * FROM alumni WHERE name LIKE '%$alumni_name%' AND CPI >= '$cpi' AND company_name LIKE '%$company_name%' AND ctc >= '$ctc' AND area LIKE '%$area%' AND position LIKE '%$position%' AND location LIKE '%$location%' AND working_tenure LIKE '%$working_tenure%' ";
        }
        $result = mysqli_query($conn, $sql);

        // Display the student data in a table
        if (mysqli_num_rows($result) > 0) {
            echo "<table id='alumni_table'>";
            echo "<tr><th onclick=\"sortTable(0,'alumni_table')\">Name</th><th onclick=\"sortTable(1,'alumni_table')\">CPI</th><th onclick=\"sortTable(2,'alumni_table')\">Company Name</th><th onclick=\"sortTable(3,'alumni_table')\">CTC(in LPA)</th><th onclick=\"sortTable(4,'alumni_table')\">Area</th><th onclick=\"sortTable(5,'alumni_table')\">Position</th><th onclick=\"sortTable(6,'alumni_table')\">Location</th><th onclick=\"sortTable(7,'alumni_table')\">Working Tenure</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['CPI']; ?></td>
                    <td><?php echo $row['company_name']; ?></td>
                    <td><?php echo $row['ctc']; ?></td>
                    <td><?php echo $row['area']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['working_tenure']; ?></td>

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