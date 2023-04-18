<?php
include 'dp.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Company List</title>
    <style>
        /* Reset default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Set body font and background color */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* Style navbar */
        .navbar {
            overflow: hidden;
            background-color: #333;
            font-size: 16px;
        }

        .navbar a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.logout {
            float: right;
        }

        #d {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 10px;
            width: 300px;
            margin: 10px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .card h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .card p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #666;
        }

        .apply-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: auto;
            margin-left: auto;
            transition: background-color 0.3s ease;
        }

        .apply-button:hover {
            background-color: #39843b;
        }

        /* Style search bar */
        .search-bar {
            margin: 10px;
            display: flex;
            justify-content: center;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 200px;
            max-width: 100%;
            margin-right: 10px;
            font-size: 16px;
        }

        .search-bar button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #ddd;
            color: black;
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
            $_SESSION['page'] = "students";
            $email = $_SESSION['email'];
            $_SESSION['email'] = "$email";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <center>
        <h1>Applied Offers</h1>
    </center>
    <div class="search-bar">
        <form method="post">
            <input type="text" name="search_company_name" placeholder="Company Name">
            <input type="text" name="search_min_cpi" placeholder="Minimum CPI">
            <input type="text" name="search_ctc" placeholder="Min CTC">
            <input type="text" name="search_role" placeholder="Role">
            <button type="submit" name="search_submit">Search</button>
        </form>
    </div>
    <?php
    // Connect to the database
    // Query to get current user details
    $email = $_SESSION['email'];
    if ($email == null) {
        header("Location: home.php");
    }
    $query1 = "select * from students where email='$email'";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
    $id = $row1['id'];
    // Query the database to get the list of companies
    $applied_company = "select job_id from student_applied where student_id=$id";
    $query = "SELECT * FROM company WHERE jobid IN ($applied_company)";

    // Check if search form is submitted
    if (isset($_POST['search_submit'])) {
        $search_company_name = $_POST['search_company_name'];
        $search_min_cpi = $_POST['search_min_cpi'];
        $search_ctc = $_POST['search_ctc'];
        $search_role = $_POST['search_role'];

        // Build the search query
        $search_query = "SELECT * FROM company WHERE ";
        $conditions = "jobid IN ($applied_company)";

        if (!empty($search_company_name)) {
            $conditions .= " AND company_name LIKE '%$search_company_name%'";
        }

        if (!empty($search_min_cpi)) {
            $conditions .= " AND minimum_cpi >= '$search_min_cpi'";
        }

        if (!empty($search_ctc)) {
            $conditions .= " AND ctc >= '$search_ctc'";
        }

        if (!empty($search_role)) {
            $conditions .= " AND roles LIKE '%$search_role%'";
        }

        $search_query .= $conditions;
        $query = $search_query;
    }


    $result = $conn->query($query);
    // Check if the query was successful
    echo "<div id='d'>";
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display the company details in a card view
            echo "<div class='card'>";
            echo "<h2>" . $row['company_name'] . "</h2>";
            echo "<p>Minimum CPI: " . $row['minimum_cpi'] . "</p>";
            echo "<p>Role: " . $row['roles'] . "</p>";
            echo "<p>CTC: " . $row['ctc'] . "</p>";
            echo "<p>Interview Mode: " . $row['interview_mode'] . "</p>";
            echo "<p>Interview Type: " . $row['interview_type'] . "</p>";
            echo "<p>Recruitment Since Year: " . $row['recruitment_since_year'] . "</p>";
            echo "<form method='post' action='apply.php'>";
            echo "<input type='hidden' name='student_id' value='" . $row1['id'] . "'>";
            echo "<input type='hidden' name='role' value='" . $row['roles'] . "'>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No companies found.</p>";
    }
    echo "</div>";
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>