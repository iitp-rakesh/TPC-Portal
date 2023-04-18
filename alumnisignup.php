<!DOCTYPE html>
<html lang="en">

<head>
    <title>Alumni Signup</title>
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
        button,
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        h2{
            color: white;
            text-align: center;
        }
        form{
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h2>Alumni Sign Up</h2>
    </div>
    <center>
        <form method="post" id="alumnisignup">
            <label>Name:</label>
            <input type="text" name="name" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required><br><br>

            <label>Company Name:</label>
            <input type="text" name="company_name" required><br><br>

            <label>Position:</label>
            <input type="text" name="position" required><br><br>

            <label>CTC (in LPA):</label>
            <input type="decimal" name="ctc" required><br><br>

            <label>Area of Work:</label>
            <input type="text" name="area" required><br><br>

            <label>Location:</label>
            <input type="text" name="location" required><br><br>

            <label>Working Tenure (in Years):</label>
            <input type="decimal" name="tenure" required><br><br>

            <label>CPI:</label>
            <input type="decimal" name="cpi" required><br><br>

            <input type="submit" name="submit" value="Sign Up">
        </form>
        <br>
        <div>
            Already have an Account
            <a href="home.php"><button>Sign In</button></a>
    </center>
    </div>
    <br>

    <?php
    // Check if the submit button was clicked
    if (isset($_POST['submit'])) {
        // Establish a connection to the MySQL database
        include 'dp.php';

        // Retrieve user data from the registration form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $company_name = $_POST['company_name'];
        $position = $_POST['position'];
        $area = $_POST['area'];
        $location = $_POST['location'];
        $tenure = $_POST['tenure'];
        $cpi = $_POST['cpi'];
        $ctc = $_POST['ctc'];


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
            $sql = "INSERT INTO alumni (email, password,name, CPI,  company_name,ctc,  area,position, location, working_tenure ) VALUES ( '$email', '$password','$name','$cpi', '$company_name',  '$ctc', '$area', '$position','$location', '$tenure')";
            if (mysqli_query($conn, $sql)) {
                echo "\nUser registered successfully. You can now Sign In";
                header("Location: alumnihomepage.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    <?php include 'footer.php'; ?>

</body>
<script>
    function resetForm() {
        document.getElementById("alumnisignup").reset();
    }
</script>

</html>