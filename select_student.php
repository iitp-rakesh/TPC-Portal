<?php
include 'dp.php';
$job_id=$_POST['job_id'];
$student_id=$_POST['student_id'];
//delete row of job_id
$query="DELETE FROM student_applied WHERE job_id='$job_id' and student_id=$student_id";
$result=mysqli_query($conn,$query);
if($result){
    echo "Student Selected";
    //update student placed to yes
    $queryx="UPDATE students SET placed='YES' WHERE id='$student_id'";
    $resulty=mysqli_query($conn,$queryx);

    header("Refresh: 1; URL=companyhomepage.php");
    exit();
}
else{
    echo "Error";
}
?>