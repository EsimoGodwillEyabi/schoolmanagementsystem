<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
elseif($_SESSION['usertype'] !=="admin") {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
      <?php
       
       include 'admin_css.php'

      ?>

    <style>
       .hadmission1,
       .hadmission {
        font-size: 20px;
       }
       .flex_container {
        display: flex;
       flex-direction: row; 
        }

        .admission {
            display: flex;
            background-color: #4CAF50;
            color: white;
            padding-right: 20px;
            text-align: center;
            border-radius: 5px;
            margin: 40px;
        }
    </style>


</head>
<body class="body-admindashboard">

       <header>

         <nav class="nav-admindashboard">
            <div>
                <h1 class="nav-title-admin">Admin Dashboard</h1>
            </div>
            <div class="nav-links">
               <ul>
                    <li><a  class="logout-box" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

       <main class="main-admindashboard">

        <aside class="sidebar-admin">
            <ul>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="add_student.php">Add Student</a></li>
                <li><a href="view_student.php">View Students</a></li>
                <li><a href="add_teacher.php">Add Teacher</a></li>
                <li><a href="view_teacher.php">View Teacher</a></li>  
                <li><a href="add_course.php">Add Course</a></li>
                <li><a href="view_course.php">View Course</a></li>
                <li><a href="add_class.php">Add Class</a></li>
                <li><a href="view_class.php">View Class</a></li>
            </ul>
        </aside>

     <section class="content-admin">
            <h2>Admin Dashboard</h2>

        <div class = "flex_container">
         <div>
            <div class="admission">
                 <h1 class="hadmission1"> 50 </h1>
                <h1 class="hadmission"> Number Of Admissions </h1>
            </div>

             <div class="admission">
                 <h1 class="hadmission1"> 50 </h1>
                <h1 class="hadmission"> Number Of Students </h1>
             </div>
         <div>
         <div>
             <div class="admission">
                 <h1 class="hadmission1"> 50 </h1>
                <h1 class="hadmission"> Number Of Teachers </h1>
            </div>

            <div class="admission">
                 <h1 class="hadmission1"> 50 </h1>
                <h1 class="hadmission"> Number Of Classes </h1>
            </div>
         
        </div>
      </section>
    </main>

</body>
</html>