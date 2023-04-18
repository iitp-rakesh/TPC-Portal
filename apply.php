<?php
// Connect to the database
include 'dp.php';

// Get the student and company IDs from the form data
$student_id = $_POST['student_id'];
$job_id = $_POST['job_id'];

$company = "SELECT company_id FROM company_credentials WHERE email=(SELECT email FROM company WHERE jobid=" . $job_id . ")";
$company_result= $conn->query($company);
$company_row = $company_result->fetch_assoc();
$company_id = $company_row['company_id'];
// Insert the data into the student_applied table
$query = "INSERT INTO student_applied (student_id, company_id, job_id) VALUES ($student_id, $company_id, '$job_id')";

try {
  $result = $conn->query($query);
  // Close the database connection
  $conn->close();

  // Display success message and go back to previous page
  echo "Successfully registered. Redirecting to Home Page .....";
  header("Refresh: 1; URL=$_SERVER[HTTP_REFERER]");
  exit();
} catch (mysqli_sql_exception $ex) {
  // Check if the error is caused by a duplicate key
  if ($ex->getCode() === 1062) {
    // Print already applied message and go back to previous page
    echo "Already Applied. Redirecting to Home Page .....";
    header("Refresh: 1; URL=$_SERVER[HTTP_REFERER]");
    exit();
  } else {
    // Print error message and go back to previous page
    echo "Error: " . $ex->getMessage();
    header("Refresh: 1; URL=$_SERVER[HTTP_REFERER]");
    exit();
  }
}
?>
