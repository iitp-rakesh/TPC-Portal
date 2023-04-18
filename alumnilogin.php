 
 <?php

    // Establish a connection to the MySQL database
    include 'dp.php';

    // Retrieve user data from the login form
    $email = $_POST['alumni-username'];
    $password = $_POST['alumni-password'];

    // Retrieve user data from the database
    $sql = "SELECT * FROM alumni WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // Set the session variable
    $_SESSION['email'] = $email;

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            echo "Login successful";
            header("Location: alumnihomepage.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User Not Found";
    }

    // Close the database connection
    mysqli_close($conn);

    ?>
