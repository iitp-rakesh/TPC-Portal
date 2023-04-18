<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        input[type="radio"]{
            width: fit-content;
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
            margin-top: 10px;
        }
        .r{
            width: 80px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h2>Student Sign Up</h2>
    </div>
    <center>
        <form method="post">
            <label>Student Name:</label>
            <input type="text" name="first_name" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required><br><br>

            <label>Age:</label>
            <input type="text" name="age" required><br><br>

            <label>Mobile Number:</label>
            <input type="tel" name="mobile" required><br><br>

            <label>Specialisation:</label>
            <input type="text" name="specialisation" required><br><br>

            <label>Semester:</label>
            <input type="number" name="semester" required><br><br>

            <label>10th Percentage</label>
            <input type="decimal" name="percentage10" required><br><br>

            <label>12th Percentage</label>
            <input type="decimal" name="percentage12" required><br><br>

            <label>CPI</label>
            <input type="decimal" name="cpi" required><br><br>

            <label>Batch</label>
            <input type="number" name="year" required><br><br>

            <label>Placed?</label>
            <input type="radio" id="yes" name="placed" value="YES">
            <label class="r" for="yes">YES</label>
            <input type="radio" id="no" name="placed" value="NO">
            <label class="r" for="no">NO</label><br>

            <input type="submit" name="submit" value="Sign Up">
        </form>
        <br>
        Already have an Account
        <a href="login.php"><button>Sign In</button></a>
        <br>
    </center>
    <?php
    // Check if the submit button was clicked
    if (isset($_POST['submit'])) {
        // Establish a connection to the MySQL database
        include 'dp.php';

        // Retrieve user data from the registration form
        $first_name = $_POST['first_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $age = $_POST['age'];
        $mobile = $_POST['mobile'];
        $specialisation = $_POST['specialisation'];
        $semester = $_POST['semester'];
        $percentage10 = $_POST['percentage10'];
        $percentage12 = $_POST['percentage12'];
        $cpi = $_POST['cpi'];
        $year = $_POST['year'];
        $placed = $_POST['placed'];

        // Validate password strength
        $uppercase = preg_match('/[A-Z]/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $number    = preg_match('/\d/', $password);
        $special   = preg_match('/[^a-zA-Z\d]/', $password);
        $flag = 1;
        if (!$uppercase || !$lowercase || !$number || !$special || strlen($password) < 8) {
            echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
            $flag = 0;
        }
        // Check if the passwords match
        if ($flag == 1) {
            if ($password != $confirm_password) {
                echo "Passwords do not match";
                exit();
            }
            // Encrypt the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO students(name,email,password,age,Mobile,specialisation,semester,percentage10,percentage12,CPI,year,placed)
            VALUES ('$first_name', '$email', '$password','$age','$mobile','$specialisation','$semester','$percentage10','$percentage12','$cpi','$year','$placed')";
            if (mysqli_query($conn, $sql)) {
                echo "\nUser registered successfully. You can now Sign In";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</body>

</html>