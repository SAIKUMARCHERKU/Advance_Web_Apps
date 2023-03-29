<?php
include 'inc/config.php';
session_start();
if (!isset($_SESSION['prof_id'])) {
    header('Location: login.php');
    exit;
} else {
}
include('inc/header.php');
?>
<div class="page-wrapper">
    <div class="left-bar">

    <ul>
    <li><a href="prof_students.php">Students</a>
            <li><a href="logout.php">Logout</a>

            </li>
        </ul>
    </div>
    <div class="form-section">
        <?php
$userid = $_GET['id'];
$sql = "SELECT StudentId,FirstName,LastName,dob,gender,yearofstudy,department,course,course,professor,EmailId,ContactNumber,Photo,Address,password,grade,PostingDate,id from students where id=:uid";
$query = $connection->prepare($sql);
$query->bindParam(':uid', $userid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $result) {

?>



        <div class="form-title">
            <h3>Student Info </h3>
        </div>


        <div class="form-row">
            <div class="form-col-4"></div>
            <div class="form-col-6">
                <div class="form-row white-bg">
                    <div class="form-col-6"><label class="form-label">Student ID</label>
                        <?php echo htmlentities($result->StudentId); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">First Name</label>
                        <?php echo htmlentities($result->FirstName); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Last Name</label>
                        <?php echo htmlentities($result->LastName); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Date of Birth</label>
                        <?php echo htmlentities($result->dob); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Gender</label>
                        <?php echo htmlentities($result->gender); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Year of study</label>
                        <?php echo htmlentities($result->yearofstudy); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Department</label>
                        <?php echo htmlentities($result->department); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Course</label>
                        <?php
        $sql_courses = "SELECT corse_id, corse_name from courses where corse_id = $result->course";
        $query_courses = $connection->prepare($sql_courses);
        $query_courses->execute();
        $results_courses = $query_courses->fetchAll(PDO::FETCH_OBJ);
        if ($query_courses->rowCount() > 0) {
            foreach ($results_courses as $result_course) {
                ?>

                        <?php echo htmlentities($result_course->corse_name); ?>
                        <?php

            }
        } ?>
                    </div>

                    <div class="form-col-6"><label class="form-label">Professor</label>
                        <?php
        $sql_profs = "SELECT prof_id, prof_name from professors where prof_id = $result->professor";
        $query_profs = $connection->prepare($sql_profs);
        $query_profs->execute();
        $results_profs = $query_profs->fetchAll(PDO::FETCH_OBJ);
        if ($query_profs->rowCount() > 0) {
            foreach ($results_profs as $result_prof) {
                ?>

                        <?php echo htmlentities($result_prof->prof_name); ?>
                        <?php

            }
        } ?>
                    </div>

                    <div class="form-col-6"><label class="form-label">Email id</label>
                        <?php echo htmlentities($result->EmailId); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Contactno</label>
                        <?php echo htmlentities($result->ContactNumber); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Address</label>
                        <?php echo htmlentities($result->Address); ?>
                    </div>
                    <div class="form-col-6"><label class="form-label">Grade</label>

                    <form name="insertrecord" method="post">
                        <?php

        $selection = array( 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E+', 'E');
        echo '<select name="grade" class="form-field">
      <option value="">Select</option>';

        foreach ($selection as $selection) {
            $selected = ($result->grade == $selection) ? "selected " : "";
            echo '<option ' . $selected . ' value="' . $selection . '">' . $selection . '</option>';
        }

        echo '</select>';

                    ?>
                        <input class="btn btn-primary btn-xs" type="submit" name="update" value="Update">
                    </form>
                    </div>


                </div>
            </div>
            <?php }
} ?>
            <div class="row" style="margin-top:1%">
            <?php
            // include database connection file
//include '../inc/config.php';
            if (isset($_POST['update'])) {
                // Get the userid
                $userid = intval($_GET['id']);
                // Posted Values
                $grade = $_POST['grade'];
            
                // Query for Updation
                $sql = "update students set grade=:sgrade where id=:uid";
                //Prepare Query for Execution
                $query = $connection->prepare($sql);
                // Bind the parameters
                $query->bindParam(':sgrade', $grade, PDO::PARAM_STR);
            
                $query->bindParam(':uid', $userid, PDO::PARAM_STR);
                // Query Execution
                $query->execute();
                // Mesage after updation
                echo "<script>alert('Record Updated successfully');</script>";
                // Code for redirection
                echo "<script>window.location.href='prof_students.php'</script>";
            }
            ?>

            </div>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

        </div>