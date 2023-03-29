
    <?php
    include('inc/config.php');
session_start();
if (!isset($_SESSION['prof_id'])) {
    header('Location: index.php');
    exit;
} else {
    // Show users the page!
}
    include('inc/header.php');
?>


<div class="page-wrapper">
<div class="left-bar">

<ul>
    <li><a href="prof_students.php">Student</a>
            <li><a href="logout.php">Logout</a>

            </li>
        </ul>


</div>
<div class="form-section">
    <h1>Welcome to Student Management System</h1>
</div>
</div>

</body>

</html>