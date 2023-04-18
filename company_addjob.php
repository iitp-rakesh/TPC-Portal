<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            width: 250px;
            margin-bottom: 10px;
            text-align: left;
        }

        input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-bottom: 10px;
        }

        button,
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        h2 {
            color: white;
            text-align: center;
        }

        form {
            align-items: center;
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
            include 'dp.php';
            $_SESSION['page'] = "company_credentials";
            $email = $_SESSION['email'];
            $_SESSION['email'] = "$email";
            ?>
            <a href="updatepassword.php">Change Password</a>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h2>ADD JOB</h2>
    <center>
        <form method="post" action="addjob.php">

            <label>Minimun CPI:</label>
            <input type="number" name="min_cpi" required><br><br>

            <label>Role Offered:</label>
            <input type="text" name="role" required><br><br>

            <label>CTC(in LPA):</label>
            <input type="number" name="ctc" required><br><br>

            <label>Interview Mode(Offline/Online):</label>
            <input type="text" name="mode" required><br><br>

            <label>Interview Type(Written/Interview):</label>
            <input type="text" name="type" required><br><br>

            <label>Recruitment since which year in IIT Patna:</label>
            <input type="number" name="year" required><br><br>

            <input type="submit" name="submit" value="ADD">
        </form>
    </center>
    <?php
    
    $email = $_SESSION['email'];
    $company = "select * from company_credentials where email='$email'";
    $result = mysqli_query($conn, $company);
    $row = mysqli_fetch_assoc($result);
    $company_name = $row['name'];
    // Check if the submit button was clicked
    if (isset($_POST['submit'])) {
        $min_cpi = $_POST['min_cpi'];
        $role = $_POST['role'];
        $ctc = $_POST['ctc'];
        $mode = $_POST['mode'];
        $type = $_POST['type'];
        $year = $_POST['year'];
        //insert into table
        $sql = "INSERT INTO company (company_name,minimum_cpi, roles, ctc, interview_mode, interview_type, recruitment_since_year, email) VALUES ('$company_name','$min_cpi', '$role', '$ctc', '$mode', '$type', '$year', '$email')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header('Location: companyhomepage.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // Close the database connection
        mysqli_close($conn);
    }
    ?>

</body>

</html>