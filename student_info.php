<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <style>
        /* Reset default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Styling for the navigation bar */
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

        /* Styling for the page content */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        #xyz p {
            margin: 5px;
            width: 400px;
            font-size: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #ccc;
        }

        #xyz {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        form {
            text-align: center;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type=submit]:hover {
            background-color: #3e8e41;
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
            $_SESSION['page'] = "students";
            $email = $_SESSION['email'];
            $_SESSION['email'] = "$email";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h1>My Profile</h1>
    <?php
    // Assume that the user ID is stored in a session variable called $_SESSION['user_id']
    // Connect to the database
    $email = $_SESSION['email'];
    // Query the database to get the user details
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = $conn->query($query);
    // Check if the query was successful
    echo "<div id='xyz'>";
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the user details
        echo "<p>Name: " . $row['name'] . "</p>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>Age: " . $row['age'] . "</p>";
        echo "<p>Mobile: " . $row['Mobile'] . "</p>";
        echo "<p>Specialisation: " . $row['specialisation'] . "</p>";
        echo "<p>Semester: " . $row['semester'] . "</p>";
        echo "<p>10th Percentage: " . $row['percentage10'] . "</p>";
        echo "<p>12th Percentage: " . $row['percentage12'] . "</p>";
        echo "<p>CPI: " . $row['CPI'] . "</p>";
        echo "<p>Year: " . $row['year'] . "</p>";
        echo "<p>Placed: " . $row['placed'] . "</p>";
        // Display the update button
        echo "<form method='post' action='update.php'>";
        echo "<input type='hidden' name='email' value='" . $row['email'] . "'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "<p>Error: Could not retrieve user details.</p>";
    }
    echo "</div>";
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>