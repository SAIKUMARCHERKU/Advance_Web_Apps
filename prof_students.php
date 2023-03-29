<?php
session_start();
if (!isset($_SESSION['prof_id'])) {
    header('Location: login.php');
    exit;
} else {
}



// include database connection file
include 'inc/config.php';

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

        <div class="form-block">
            <div class="form-row">
                <div class="form-col-12">
                    <div class="form-title">
                        <h3>Registered Students</h3>
                    </div>
                    <div class="table-responsive">
                        <table id="mytable" class="data-table">
                            <thead>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Posting Date</th>
                                <th>View</th>
                                <!-- <th>Edit</th>
                                <th>Delete</th> -->
                            </thead>
                            <tbody>

                                <?php

$prof_id= $_SESSION['prof_id'];

                        $sql = "SELECT FirstName,LastName,EmailId,ContactNumber,Photo,Address,PostingDate,id from students where professor=$prof_id";
                        //Prepare the query:
                        $query = $connection->prepare($sql);
                        //Execute the query:
                        $query->execute();
                        //Assign the data which you pulled from the database (in the preceding step) to a variable.
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        // For serial number initialization
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            //In case that the query returned at least one record, we can echo the records within a foreach loop:
                            foreach ($results as $result) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo htmlentities($cnt); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->FirstName); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->LastName); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->EmailId); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->ContactNumber); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->Address); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($result->PostingDate); ?>
                                    </td>
                                    <td><a href="prof_view.php?id=<?php echo htmlentities($result->id); ?>"><button
                                                class="btn btn-primary btn-xs">View</button></a></td>
                                    <!-- <td><a href="update.php?id=<?php echo htmlentities($result->id); ?>"><button
                                                class="btn btn-primary btn-xs">Edit</button></a></td>

                                    <td><a href="index.php?del=<?php echo htmlentities($result->id); ?>"><button
                                                class="btn btn-danger btn-xs"
                                                onClick="return confirm('Do you really want to delete');">Delete</span></button></a>
                                    </td> -->
                                </tr>


                                <?php
                                // for serial number increment
                                $cnt++;
                            }
                        } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>