
<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] !=="teacher") {
    header("Location: login.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <?php

    include 'teacher_css.php'

    ?>
     <style>
    .teacher_profile_info {
        display: flex;
        }
     .teacher_profile_details {
        margin-bottom: 20px;
        display: flex;
        flex-direction: row;
        gap: 100px;
        }
    .teacher_profile_details_item {
        margin-left: 50px;
        color: white;
        background-color: #0476f8ff;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 200px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    .teacher_profile_details_item a {
        text-decoration: none;
        color: white;
        }
    .nav-title-admin a {
        color: white;
        text-decoration: none;
    }
    </style> 

</head>
<body class="body-admindashboard">
    
        <?php

    include 'teacher_sidebar.php'
    
        ?>

        <center>
            <section class="content-admin">
                <h2>Teacher Dashboard</h2>
            </section>
             <section class="teacher_profile_info">   
                <div class="teacher_profile_details">
                   <div class="teacher_profile_details_item">
                    <h3> <a href="mycourses.php"> Number of Courses Assigned </a></h3>
                    <p> 5 </p>
                  </div> 
                  <div class="teacher_profile_details_item">
                    <h3> <a href="mystudents.php"> Number of Students Enrolled </a></h3>
                    <p> 120 </p>   
                </div>
            </section>
        </center>

</body>
</html>