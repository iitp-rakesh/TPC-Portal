<?php
// Connect to the database
include 'dp.php';
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $mobile = $_POST['Mobile'];
    $specialisation = $_POST['specialisation'];
    $semester = $_POST['semester'];
    $percentage10 = $_POST['percentage10'];
    $percentage12 = $_POST['percentage12'];
    $cpi = $_POST['CPI'];
    $year = $_POST['year'];
    $placed = $_POST['placed'];
    $password = $_POST['password'];

    // Query the database to get the user details
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Set the session variable
    $_SESSION['email'] = $email;

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Query the database to update the user details
            $query = "UPDATE students SET name = '$name', age = '$age', Mobile = '$mobile', specialisation = '$specialisation', semester = '$semester', percentage10 = '$percentage10', percentage12 = '$percentage12', CPI = '$cpi', year = '$year', placed = '$placed' WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            // Check if the query executed successfully
            if ($result) {
                // Redirect to the welcome page
                header("Location: welcome_page.php");
                exit();
            } else {
                // Display an error message
                echo "Error: Could not update user details.";
            }

            header("Location: welcome_page.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User Not Found";
    }

    // Close the database connection
    $conn->close();
}
