<?php
include 'dp.php';
$job_id=$_POST['job_id'];
//delete row of job_id
$query="DELETE FROM company WHERE jobid='$job_id'";
$result=mysqli_query($conn,$query);
if($result){
    echo "Job Deleted";
    header("Refresh: 1; URL=companyhomepage.php");
    exit();
}
else{
    echo "Error";
}
//close session
mysqli_close($conn);
?>