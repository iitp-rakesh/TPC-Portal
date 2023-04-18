<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
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

        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-bottom: 10px;
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
        <a href="welcome_page.php">Home</a>
        <a href="student_info.php">Profile</a>
        <a href="alumni_list.php">Alumni</a>
        <a href="student_applied.php">Applied Jobs</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <center>
        <h1>Update Profile</h1>
    </center>
    <?php
    // Connect to the database
    include 'dp.php';
    $email = $_SESSION['email'];

    // Query the database to get the user details
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = $conn->query($query);
    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the update form
        echo "<center>";
        echo "<form method='post' action='update_process.php'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<label for='name'>Name:</label>";
        echo "<input type='text' name='name' value='" . $row['name'] . "'><br>";
        echo "<label for='email'>Email:</label>";
        echo "<input type='text' name='email' value='" . $row['email'] . "' readonly><br>";
        echo "<label for='password'>Current Password:</label>";
        echo "<input type='password' name='password'><br>";
        echo "<label for='age'>Age:</label>";
        echo "<input type='text' name='age' value='" . $row['age'] . "'><br>";
        echo "<label for='Mobile'>Mobile:</label>";
        echo "<input type='text' name='Mobile' value='" . $row['Mobile'] . "'><br>";
        echo "<label for='specialisation'>Specialisation:</label>";
        echo "<input type='text' name='specialisation' value='" . $row['specialisation'] . "'><br>";
        echo "<label for='semester'>Semester:</label>";
        echo "<input type='text' name='semester' value='" . $row['semester'] . "'><br>";
        echo "<label for='percentage10'>10th Percentage:</label>";
        echo "<input type='text' name='percentage10' value='" . $row['percentage10'] . "'><br>";
        echo "<label for='percentage12'>12th Percentage:</label>";
        echo "<input type='text' name='percentage12' value='" . $row['percentage12'] . "'><br>";
        echo "<label for='CPI'>CPI:</label>";
        echo "<input type='text' name='CPI' value='" . $row['CPI'] . "'><br>";
        echo "<label for='year'>Year:</label>";
        echo "<input type='text' name='year' value='" . $row['year'] . "'><br>";
        echo "<label for='placed'>Placed(YES/NO):</label>";
        echo "<input type='text' name='placed' value='" . $row['placed'] . "'><br>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
        echo "</center>";
    } else {
        echo "<p>Error: Could not retrieve user details.</p>";
    }
    // Close the database connection
    $conn->close();
    ?>
</body>

</html>