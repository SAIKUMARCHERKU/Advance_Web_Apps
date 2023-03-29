
    <?php
    include('inc/config.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
} else {
    // Show users the page!
}
    include('inc/header.php');
?>


<div class="page-wrapper">
<div class="left-bar">

<?php
    include('inc/nav.php');
?>

</div>
<div class="form-section">
    <h1>Welcome to Student Management System</h1>
</div>
</div>

</body>

</html>