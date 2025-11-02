
<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] =="admin") {
    header("Location: login.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <?php

    include 'teacher_css.php'

    ?>

</head>
<body class="body-admindashboard">
    
        <?php

    include 'teacher_sidebar.php'
    
        ?>

        <center>
            <section class="content-admin">
                <h2>Teacher Dashboard</h2>
            </section>
        </center>

</body>
</html>