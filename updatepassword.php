<?php
include 'dp.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px #999;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    $table = $_SESSION['page'];
    $email = $_SESSION['email'];
    //input for current password and new password
    echo "Password must contain 1 uppercase,1 Lowercase,1 number and 1 special character.";
    echo "<form action='updatepassword.php' method='post'>
    <label for='currentpassword'>Current Password</label>
    <input type='password' name='currentpassword' id='currentpassword' required><br>
    <label for='newpassword'>New Password</label>
    <input type='password' name='newpassword' id='newpassword' required>
    <input type='submit' value='Change Password'>";
    
    //update password
    if (isset($_POST['currentpassword']) && isset($_POST['newpassword'])) {
        $currentpassword = $_POST['currentpassword'];
        $newpassword = $_POST['newpassword'];
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $query = "SELECT * FROM $table WHERE email='$email'";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($currentpassword, $row['password'])) {
                $query = "UPDATE $table SET password='$newpassword' WHERE email='$email'";
                $result = $conn->query($query);
                echo "<script>alert('Password changed successfully')</script>";
                header("Location: home.php"); // move this outside the if block
                exit;
            } else {
                echo "<script>alert('Current password is incorrect')</script>";
            }
        } else {
            echo "<script>alert('Error: Could not retrieve user details')</script>";
        }
    }
    ?>
</body>

</html>